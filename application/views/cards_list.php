<h1>Welcome</h1>
<p>Please select a card:</p>

<?php  if (!empty($message)) { print '<div class="message ' . $message['status'] . '">' . $message['message'] . '</div>'; } ?>

<?php print form_open(); ?>
<?php
foreach($cards as $key => $card)
{
	print ''
	. '<div class="card">'
		. '<input type="radio" name="card" value="' . $card->card_id . '" id="card' . $card->card_id . '" />'
		. '<label for="card' . $card->card_id . '">' . $card->name . ' <img src="' . $base_url . $card->image . '" width="120" /></label>'
	. '</div>';
}
?>
<div class="submit">
	<input type="submit" name="submit" value="Next step" />
</div>
<?php form_close(); ?>
