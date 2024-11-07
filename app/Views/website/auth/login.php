<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<?php if (isset($message) AND !empty($message))	echo '<div class="message">' . $message . '</div>'; ?>

	<?php echo form_open('website/auth/login', 'id="login-form" class="login-form"', array('login' => 'true')); ?>
		<fieldset>
			<p>
				<?php echo form_input('email', set_value('email'), 'placeholder="'.$this->lang->line('auth_email_label').'"'); ?>
			</p>
			<p>
				<?php echo form_password('password', set_value('password'), 'placeholder="'.$this->lang->line('auth_password_label').'"'); ?>
			</p>
			<p>
				<?php echo form_submit('submit_login', $this->lang->line('auth_login_label'), 'id="submit_login"'); ?>
			</p>
			<ul class="links">
				<li><?php echo anchor('website/auth/signup', $this->lang->line('auth_signup_label')); ?></li>
			</ul>
		</fieldset>
	<?php echo form_close(); ?>
