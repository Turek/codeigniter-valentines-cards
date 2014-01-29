<?php

/**
 * Contains all the methods needed by application.
 *
 * @author T.Turczynski
 */

class Cards extends CI_Model
{
	private $query = '';
	private $cards_table = 'cards';
	private $cards_sent_table = 'cards_sent';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function getCards($sort = 'name', $order = 'desc', $limit = 9, $offset = 0)
	{
		// some default values
		$sort_fields = array('name');

		// check if all the values are correct
		if (!in_array($sort, $sort_fields))
		{
			$sort = 'name';
		}

		// Set order.
		if ($order != 'desc')
		{
			$order = 'asc';
		}

		// if everything is set properly, grab entries from database
		$where = array(
			'visible' => 1,
		);

		// initialize db query
		$this->db->select('*');
		$this->db->from($this->cards_table);
		$this->db->where($where);
		$this->db->order_by($sort, $order);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	} 

	public function loadCard($card_id)
	{
		// initialize db query
		$this->db->select('*');
		$this->db->from($this->cards_table);
		$this->db->where(array('card_id' => $card_id));
		$query = $this->db->get();
		return $query->result();
	} 

	public function loadMessage($hash)
	{
		// initialize db query
		$this->db->select('*');
		$this->db->from($this->cards_sent_table);
		$this->db->where(array('hash' => $hash));
		$query = $this->db->get();
		return $query->result();
	} 

	public function generateHash($string)
	{
		return md5($string . uniqid($this->cards_table) . time());
	}

	public function saveEntry($from, $to, $message, $hash, $card_id)
	{
		$data = array(
			'email_from' => $from,
			'email_to' => $to,
			'hash' =>  $hash,
			'card_id' =>  $card_id,
			'message' =>  $message,
			'date_added' => date("Y-m-d H:i:s"),
			'addr_added' => $this->input->ip_address(),
		);
		$insert = $this->db->insert($this->cards_sent_table, $data);
		if ($insert)
		{
			return (int)$this->db->insert_id();
		}
		return FALSE;
	}

	public function sendEmail($from, $to, $message, $hash)
	{
		require_once(PATH_PHPMAILER);
		$mailobj = new PhpMailer();
		$url = site_url('/card/' . $hash);

		if (defined('ERR_MAIL_METHOD') && ERR_MAIL_METHOD == 'SMTP')
		{
			$mailobj->IsSMTP();
			$mailobj->SMTPAuth = TRUE;
			$mailobj->Host = SMTP_HOST;
			$mailobj->Port = SMTP_PORT;
			$mailobj->Username = SMTP_USER;
			$mailobj->Password = SMTP_PASS;
		}
		$mailobj->CharSet = 'utf-8';

		//$mailobj->Sender = ERR_MAIL_SENDER;
		$mailobj->SetFrom(ERR_MAIL_FROM, ERR_MAIL_FROM_NAME);
		$mailobj->AddAddress(ERR_MAIL_TO);
		$mailobj->Subject = $from . ' sends you a card.';
		$mailobj->AltBody = "To view the message, please use an HTML compatible email viewer!";
		$mailobj->MsgHTML($message . '<br /><a href="' . $url . '">open message</a>');
		$status = $mailobj->Send();

		if($status)
		{
			$return = TRUE;
		}
		else
		{
			$return = FALSE;
		}
		$mailobj->ClearAddresses();
		$mailobj->ClearAttachments();

		return $return;
	}
}
