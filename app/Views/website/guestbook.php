<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if(isset($message) && ! empty($message))	echo $message; ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">Ziyaretçi Defteri</h2>
	</div>
	<div class="panel-body">
		<?php echo form_open('/website/guestbook'); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?php echo form_label('Ad Soyad*', 'name'); ?>
						<?php echo form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name" class="form-control"'); ?>
					</div>
					<div class="form-group">
						<?php echo form_label('Email*', 'email'); ?>
						<?php echo form_input('email', (isset($row->email)) ? $row->email : set_value('email'), 'id="email" class="form-control"'); ?>
					</div>
					<div class="form-group">
						<?php echo form_label('Mesaj*', 'message'); ?>
						<?php echo form_textarea('message', (isset($row->message)) ? $row->message : set_value('message'), 'style="height:8em" class="form-control"'); ?>
					</div>
					<div class="form-group">
						<?php echo form_label($captcha_image, 'captcha'); ?>
						<?php echo form_label('Kod*', 'captcha'); ?>
						<?php echo form_input('captcha', (isset($row->captcha)) ? $row->captcha : set_value('captcha'), 'id="captcha" class="form-control"'); ?>
					</div>
				</div>
			</div>
			<button class="btn btn-default" type="submit" name="submit_save">Kaydet</button>
			<button class="btn btn-default cancel" type="submit" name="submit_save" value="cancel" >İptal</button>
		</form>

		<?php if(isset($guest_book_records) && $guest_book_records->num_rows() > 0){ ?>
			<div class="guest_book_list">
				<?php foreach($guest_book_records->result() as $guest_book){ ?>
				<p class="guest_book_info"><span class="guest_book_name"><?php echo $guest_book->name; ?></span><span class="guest_book_date"><?php echo date("d-m-Y H:i:s", strtotime($guest_book->created)); ?></span></p>
				<p class="guest_book_message"><span colspan="2"><?php echo $guest_book->message; ?></span></p>
				<?php } ?>
			</div>
		<?php }
				echo "<div class='pages'>\n";
				echo $this->pagination->create_links();
				echo "</div>\n";
		?>
	</div>
</div>
