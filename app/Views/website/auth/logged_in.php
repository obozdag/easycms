<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="logged-in">
	<?php if (isset($message) AND !empty($message))	echo '<div class="message">' . $message . '</div>'; ?>

	<?php echo form_open('website/auth/logout', 'id="login-form" class="login-form"'); ?>
		<div class="message">
			<p><?php echo $this->lang->line('logged_in_as'); ?></p>
			<p><b><?php echo $this->session->userdata('user_email'); ?></b></p>
			<p><?php echo form_submit('submit_logout', $this->lang->line('auth_logout_label'), 'id="submit-logout"'); ?></p>
		</div>
	</form>
</div>