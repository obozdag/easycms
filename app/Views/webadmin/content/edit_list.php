<div class="box">
	<h2><?php echo $class_title.(($count_all) ? ' ('.(($count_where) ? $count_where.'/' : '' ).$count_all.')' : ''); ?></h2>

	<?php if(isset($message) && !empty($message))	echo '<div class="message">'.$message.'</div>'; ?>

	<form class="list_form" id="list_form" name="list_form" method="post" action="<?php echo base_url('webadmin/'.$class_name.'/edit_list'); ?>">
		<div class="col-1">
			<fieldset>
				<button name="insert_button" type="submit" class="insert_button" formaction="<?php echo site_url('webadmin/'.$class_name.'/insert'); ?>" >Ekle</button>
			</fieldset>
		</div>
		<div id="liste" class="col-1">
			<?php	if($rows->num_rows() > 0): ?>
			<table class="list" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="t-right" style="width:3em;">Sr</th>
						<th class="t-right" style="width:3em;">No</th>
						<th style="width:8em;">Dil</th>
						<th style="width:10em;">Alt Kategori</th>
						<th>Ad</th>
						<th>Özet</th>
						<th>Metin</th>
						<th style="width:3em;">Ana Syfda</th>
						<th style="width:3em;">Alt Ktgde</th>
						<th style="width:3em;">Yayın</th>
						<th style="width:8em;">İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$counter = 0;
				foreach($rows->result() as $row):
					$odd_even = ($counter++ % 2 == 0) ? 'odd' : 'even';
				?>
					<tr class="<?php echo $odd_even; ?>" id="<?php echo $row->id; ?>">
						<td class="t-right"><?php echo $counter; ?></td>
						<td class="t-right"><?php echo $row->id; ?></td>
						<td><?php echo form_dropdown('language_id', $language_array, (isset($row->language_id)) ? $row->language_id : set_value('language_id'), 'id="language_id_'.$row->id.'"'); ?></td>
						<td><?php echo form_dropdown('subcategory_id', $subcategory_array, (isset($row->subcategory_id)) ? $row->subcategory_id : set_value('subcategory_id'), 'id="subcategory_id_'.$row->id.'"'); ?></td>
						<td>
							<?php echo form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name_'.$row->id.'"'); ?>
							<input type="hidden" name="old_name" value="<?php echo (isset($row->name)) ? $row->name : ''; ?>" id="old_name_<?php echo $row->id; ?>" />
						</td>
						<td><?php echo form_textarea('summary', (isset($row->summary)) ? $row->summary : set_value('summary'), 'id="summary_'.$row->id.'"'); ?></td>
						<td><?php echo form_textarea('text', (isset($row->text)) ? $row->text : set_value('text'), 'id="text_'.$row->id.'"'); ?></td>
						<td><input type="checkbox" class="check" title="Ana Sayfada" name="on_homepage" value="<?php echo $row->id; ?>" <?php echo ($row->on_homepage) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td><input type="checkbox" class="check" title="Alt Kategoride" name="on_subcategory" value="<?php echo $row->id; ?>" <?php echo ($row->on_subcategory) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td><input type="checkbox" class="check" title="Yayın" name="publish" value="<?php echo $row->id; ?>" <?php echo ($row->publish) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td class="commands">
							<button name="id" type="submit" class="btn btn-default btn-sm" formaction="<?php echo site_url('webadmin/'.$class_name.'/update'); ?>" value="<?php echo $row->id; ?>" title="Kaydet"><i class="fa fa-save"></i></button>
							<button name="id" type="submit" class="btn btn-default btn-sm" formaction="<?php echo site_url('webadmin/'.$class_name.'/delete'); ?>" value="<?php echo $row->id; ?>" title="Sil"><i class="fa fa-trash-o"></i></button>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links(); ?>
			<?php endif; ?>
		</div>
	</form>
</div>

