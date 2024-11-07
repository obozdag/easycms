<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if(isset($message)){
		echo $message;
	}else{
?>
		<form class="edit_form" id="edit_guest_book" name="edit_guest_book" method="post" action="<?php echo base_url(); ?>index.php/webadmin/edit_guest_book">
			<fieldset>
				<legend>Ziyaretçi Defteri Düzenleme</legend>
					<p class="input">
						<label for="id">Kayıt No</label>
						<input type="text" id="id" name="id" value="<?php echo $guest_book->id; ?>" />
					</p>
					<p class="input">
						<span class="block"><input type="checkbox" id="publish" name="publish" value="1" <?php if($guest_book->publish) { echo 'checked="checked"'; } ?> /><label for='publish'> Yayın</label></span>
					</p>
					<p class="input">
						<span class="block"><label class="block" for='name'>Ad Soyad</label><input class="all" type="text" id="name" name="name" value="<?php echo $guest_book->name; ?>" /></span>
					</p>
					<p class="input"><label class="block" for='email'>Email</label><input class="all" type="text" id="email" name="email" value="<?php echo $guest_book->email; ?>" /></p>
					<p class="input"><label class="block" for='created'>Tarih</label><input class="all" type="text" id="created" name="created" value="<?php echo date('d-m-Y H:i:s', strtotime($guest_book->created)); ?>" /></p>
					<p class="input"><label class="block" for='message'>Mesaj</label><textarea id="message" name="message" rows="10" cols="70"><?php echo $guest_book->message; ?></textarea></p>
					<p class="input"><label class="block" for='update_guest_book'>&nbsp;</label><button type="submit" id="update_guest_book" name="update_guest_book" value="1">Kaydet</button></p>
			</fieldset>
		</form>
<?php
	}
?>
