<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if(isset($message) && ! empty($message))	echo $message; ?>

<?php if (isset($rows)) $row = $rows->row(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo $class_title.' '.(($function == 'edit') ? 'Düzenleme (No: '.$row->id.')' : 'Ekleme'); ?></h2>
	</div>
	<div class="panel-body">
	<?php if ($function == 'insert' OR $rows->num_rows() > 0): ?>
		<?php echo form_open('webadmin/'.$class_name.'/'.(($function == 'edit') ? 'edit' : 'insert'), 'class="form edit_form" autofocus'); ?>
		<?php if (isset($row->id)): ?>
			<input type="hidden" name="id" value="<?= $row->id ?>">
		<?php endif; ?>
			<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Yer Türü', 'type_id'); ?>
					<?php echo form_dropdown('type_id', $place_types, (isset($row->type_id)) ? $row->type_id : set_value('type_id'), 'id="type_id" class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label($class_title.' Adı', 'name'); ?>
					<?php echo form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name" class="form-control"'); ?>
					<?php echo form_hidden('old_name', (isset($row->name)) ? $row->name : '', 'id="old_name"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Başlangıç HTML', 'html_begin'); ?>
					<?php echo form_textarea('html_begin', (isset($row->html_begin)) ? $row->html_begin : set_value('html_begin'), 'rows="6" class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Bitiş HTML', 'html_end'); ?>
					<?php echo form_textarea('html_end', (isset($row->html_end)) ? $row->html_end : set_value('html_end'), 'rows="6" class="form-control"'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Sıra', 'order'); ?>
					<?php echo form_input('order', (isset($row->order)) ? $row->order : set_value('order'), 'id="order" class="form-control"'); ?>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="1" id="on_homepage" name="on_homepage" <?php echo ((isset($row->on_homepage)) ? $row->publish : set_value('on_homepage')) ? 'checked="checked"' : ''; ?>>
							Ana Sayfada
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="1" id="on_subcategory" name="on_subcategory" <?php echo ((isset($row->on_subcategory)) ? $row->publish : set_value('on_subcategory')) ? 'checked="checked"' : ''; ?>>
							Alt Kategoride
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="1" id="on_content" name="on_content" <?php echo ((isset($row->on_content)) ? $row->publish : set_value('on_content')) ? 'checked="checked"' : ''; ?>>
							İçerikte
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="1" id="publish" name="publish" <?php echo ((isset($row->publish)) ? $row->publish : set_value('publish')) ? 'checked="checked"' : ''; ?>>
							Yayın
						</label>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-default" type="submit" name="submit_save" value="<?php echo ($function == 'copy') ? 'insert' : $function; ?>" >Kaydet</button>
		<button class="btn btn-default cancel" type="submit" name="submit_save" value="cancel" >İptal</button>
	</div>	
	</form>
	<?php endif; ?>
</div>
