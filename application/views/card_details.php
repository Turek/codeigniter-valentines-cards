<h1><?php print $card[0]->name; ?></h1>
<p><?php print $card[0]->description; ?></p>

<?php  if (!empty($message)) { print '<div class="message ' . $message['status'] . '">' . $message['message'] . '</div>'; } ?>

<?php print form_open(); ?>
	<div class="field<?php if (form_error('from')) { print ' error'; } ?>">
		<?php print form_label('E-mail from', 'from'); ?>
		<?php print form_input(array('name' => 'from', 'id' => 'from', 'type' => 'text', 'value' => @$post['from'], 'autofocus' => '', 'required' => '')); ?>
	</div>
	<div class="field<?php if (form_error('to')) { print ' error'; } ?>">
		<?php print form_label('E-mail to:', 'to'); ?>
		<?php print form_input(array('name' => 'to', 'id' => 'to', 'type' => 'text', 'value' => @$post['to'], 'autofocus' => '', 'required' => '')); ?>
	</div>
	<div class="submit">
		<input type="submit" name="submit" value="Send card" />
	</div>
<?php form_close(); ?>
