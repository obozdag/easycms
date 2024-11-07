<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="box">
	<h2>Ziyaretçi Defteri</h2>
	<?php if(isset($message) && !empty($message))	echo '<div class="message">' . $message . '</div>'; ?>
	<div id="liste">
		<?php	if($guest_books->num_rows() > 0): ?>
		<table class="list" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Kayıt No</th>
					<th>Ad Soyad</th>
					<th>Email</th>
					<th>Mesaj</th>
					<th>Yayın</th>
					<th>İşlem</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach($guest_books->result() as $guest_book){
					($guest_book->publish) ? $checked='checked="checked"': $checked='';
					echo "
						<tr>
							<td>{$guest_book->id}</td>
							<td>{$guest_book->name}</td>
							<td>{$guest_book->email}<br />{$guest_book->created}</td>
							<td>{$guest_book->message}</td>
							<td><input type='checkbox' class='guest_bookPublish' value='{$guest_book->id}' $checked /></td>
							<td>
								<a class='edit' href='/index.php/webadmin/edit_guest_book/{$guest_book->id}'>
									<img class='button' title='Düzenle' alt='Düzenle' src='/css/img_webadmin/edit.png'>
								</a>
								<a class='delete' href='/index.php/webadmin/delete_guest_book/{$guest_book->id}'>
									<img class='button' title='Sil' alt='Sil' src='/css/img_webadmin/delete.png'>
								</a>
							</td>
						</tr>\n";
				}
			?>
			</tbody>
		</table>
		<div class="pages">
			<?php echo $this->pagination->create_links(); ?>
		</div>
		<?php	endif; ?>
	</div>
</div>
