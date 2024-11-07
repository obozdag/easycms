<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box">
	<h2><?php echo $class_title.(($count_all) ? ' ('.(($count_where) ? $count_where.'/' : '' ).$count_all.')' : ''); ?></h2>

	<?php if(isset($message) && !empty($message))	echo '<div class="message">'.$message.'</div>'; ?>

	<form class="list_form" id="list_form" name="list_form" method="post" action="<?php echo base_url('webadmin/'.$class_name); ?>">
		<div class="col-1-2">
			<fieldset>
				<button name="insert_button" name="insert_button" type="submit" class="insert_button" formaction="<?php echo site_url('webadmin/'.$class_name.'/insert'); ?>" >Ekle</button>
			</fieldset>
		</div>
		<div id="liste" class="col-1">
			<?php	if($rows->num_rows() > 0): ?>
			<table class="list" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="t_right" style="width:3em;">Sr</th>
						<th class="t_right" style="width:3em;">No</th>
						<th class="t_right" style="width:3em;"><small>Sıra</small></th>
						<th style="width:7em;"><small>Kategori</small></th>
						<th style="width:7em;"><small>Yer</small></th>
						<th>Ad</th>
						<th style="width:3em;"><small>Ana Sayfada</small></th>
						<th style="width:3em;"><small>Alt Kategoride</small></th>
						<th style="width:3em;"><small>İçerikte</small></th>
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
					<tr class="<?php echo $odd_even; ?>">
						<td class="t_right"><?php echo $counter; ?></td>
						<td class="t_right"><?php echo $row->id; ?></td>
						<td class="t_right"><small><?php echo $row->order; ?></small></td>
						<td><?php echo form_dropdown('category_id', $category_array, (isset($row->category_id)) ? $row->category_id : set_value('category_id'), 'id="category_id_'.$row->id.'"'); ?></td>
						<td>
							<?php echo form_dropdown('place_id', $place_array, (isset($row->place_id)) ? $row->place_id : set_value('place_id'), 'id="place_id_'.$row->id.'"'); ?>
						</td>
						<td>
							<?php echo form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name_'.$row->id.'"'); ?>
							<?php echo form_hidden('old_name', (isset($row->name)) ? $row->name : '', 'id="old_name_'.$row->id.'"'); ?>
						</td>
						<td><input type="checkbox" class="check" title="Ana Sayfada" name="on_homepage" value="<?php echo $row->id; ?>" <?php echo ($row->on_homepage) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td><input type="checkbox" class="check" title="Alt Kategoride" name="on_subcategory" value="<?php echo $row->id; ?>" <?php echo ($row->on_subcategory) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td><input type="checkbox" class="check" title="İçerikte" name="on_content" value="<?php echo $row->id; ?>" <?php echo ($row->on_content) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td><input type="checkbox" class="check" title="Yayın" name="publish" value="<?php echo $row->id; ?>" <?php echo ($row->publish) ? $checked='checked="checked"': $checked=''; ?> /></td>
						<td class="commands">
							<button name="id" type="submit" class="save_button" formaction="<?php echo site_url('webadmin/'.$class_name.'/save'); ?>" value="<?php echo $row->id; ?>" >Kaydet</button>
							<button name="id" type="submit" class="delete_button" formaction="<?php echo site_url('webadmin/'.$class_name.'/delete'); ?>" value="<?php echo $row->id; ?>" >Sil</button>
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
