<div class="content">
	<div class="sb_top">
		<h2 class="product-title"><?php echo $this->lang->line('auth_signup_title'); ?></h2>
	</div>
	<div class="signup">
		<div class="box col-1-3">
			<p>Please fill in the form to signup.</p>
		</div>
		<div class="box col-2-3">
			<?php if (isset($message) AND !empty($message))	echo '<div class="message">' . $message . '</div>'; ?>

			<form method="post" action="/website/signup" name="insert_form" id="insert_form" class="webauth">
				<fieldset>
					<p>
						<label for="first_name">First Name*</label><br />
						<?php echo form_input('first_name', set_value('first_name')); ?>
					</p>
					<p>
						<label for="last_name">Last Name*</label><br />
						<?php echo form_input('last_name', set_value('last_name')); ?>
					</p>
					<p>
						<label for="email">Email*</label><br />
						<?php echo form_input('email', set_value('email')); ?>
					</p>
					<p>
						<label for="company">Company</label><br />
						<?php echo form_input('company', set_value('company')); ?>
					</p>
					<p>
						<label for="phone">Phone</label><br />
						<?php echo form_input('phone', set_value('phone')); ?>
					</p>
					<p>
						<label for="password">Password*</label><br />
						<?php echo form_password('password', set_value('password')); ?>
					</p>
					<p>
						<label for="password_confirm">Password Confirm*</label><br />
						<?php echo form_password('password_confirm', set_value('password_confirm')); ?>
					</p>
					<p>
						<button type="submit" name="submit_save" value="insert" >Sign Up</button>
						<button class="cancel" type="submit" name="submit_save" value="cancel" >Cancel</button>
					</p>
					<p>*<small> signed fields are required.</small></p>

					<ul class="links">
						<li><a href="/webadmin/auth/login">Giriş</a></li>
					</ul>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<br clear="all">