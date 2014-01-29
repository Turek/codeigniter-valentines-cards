<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cards');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index($type="")
	{
		$data = array(
			'title' => 'Test page',
		);
		$this->template('global/front_page', $data);
	}

	public function cards_list()
	{
		$this->form_validation->set_rules('card', 'Card', 'required|callback_valid_card');
		$data = array();

		// Validate the form first.
		if ($this->form_validation->run() == TRUE)
		{
			redirect('/card/' . $this->input->post('card'), 'location', 301);
			exit;
		}
		else
		{
			$data += array(
				'message' => array('status' => 'error', 'message' => validation_errors()),
			);
		}

		$cards = $this->cards->getCards();
		$data += array(
			'title' => 'Front page',
			'cards' => $cards,
		); 
		$this->template('cards_list', $data);
	}

	public function card_details($card_id)
	{
		$data = array();
		$card = $this->cards->loadCard($card_id);

		if (empty($card))
		{
			$this->error('Card does not exist.');
			// To display error template and not process anything else
			// it needs to return something.
			return TRUE;
		}

		$this->form_validation->set_rules('from', 'E-mail from', 'required|valid_email|max_length[150]');
		$this->form_validation->set_rules('to', 'E-mail to', 'required|valid_email|max_length[150]');

		// Validate the form first.
		if ($this->form_validation->run() == TRUE)
		{
			$post = $this->input->post();
			// Generate unique hash.
			$hash = $this->cards->generateHash($post['from'] . $post['to']);
			// Save to database.
			$message = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
			$return = $this->cards->saveEntry($post['from'], $post['to'], $message, $hash, $card[0]->card_id);
			// Send e-mail.
			if ($return !== FALSE)
			{
				$email = $this->cards->sendEmail($post['from'], $post['to'], $message, $hash);
				if ($email !== FALSE)
				{
					redirect('/card/' . $hash, 'location', 301);
					exit;
				}
			}
			$this->error('Error sending email.');
			// To display error template and not process anything else
			// it needs to return something.
			return TRUE;
		}
		else
		{
			$data += array(
				'message' => array('status' => 'error', 'message' => validation_errors()),
				'post' =>  $this->input->post(),
			);
		}

		$data += array(
			'title' => 'Front page',
			'card' => $card,
		); 
		$this->template('card_details', $data);
	}

	public function card_message($hash)
	{
		$data = array();
		$message = $this->cards->loadMessage($hash);

		if (empty($message))
		{
			$this->error('Message does not exist.');
			// To display error template and not process anything else
			// it needs to return something.
			return TRUE;
		}

		$card = $this->cards->loadCard($message[0]->card_id);
		$data += array(
			'title' => 'Your message',
			'card' => $card,
			'message' => $message,
			'meta_title' => $card[0]->name,
			'meta_image' => base_url() . $card[0]->image,
			'meta_description' => $message[0]->message,
		); 
		$this->template('card_message', $data);
	}


	public function error($message)
	{
		$data = array(
			'title' => 'Error',
			'error' => $message,
		); 
		$this->template('global/error', $data);
	}

	public function valid_card($card_id)
	{
		$card = $this->cards->cardExist($card_id);
		if (empty($card))
		{
			$this->form_validation->set_message('valid_card', 'Card does not exist.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
