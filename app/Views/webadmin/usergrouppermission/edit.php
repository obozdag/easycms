<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if(isset($message) && ! empty($message))	echo $message; ?>

<?php if (isset($rows)) $row = $rows->row(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo $class_title.' '.(($function == 'edit') ? 'Düzenleme (No: '.$row->id.')' : 'Ekleme'); ?></h2>
	</div>
	<div class="panel-body">
	<?php if ($function == 'insert' OR $rows->num_rows() > 0): ?>
		<?php echo form_open('webadmin/'.$class_name.'/'.(($function == 'edit') ? 'edit' : 'insert'), 'class="form edit_form"'); ?>
		<?php if (isset($row->id)): ?>
			<input type="hidden" name="id" value="<?= $row->id ?>">
		<?php endif; ?>
			<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Kaynak Adı', 'name'); ?>
					<?php echo form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name" class="form-control"'); ?>
					<?php echo form_hidden('old_name', (isset($row->name)) ? $row->name : ''); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Açıklama', 'title'); ?>
					<?php echo form_input('title', (isset($row->title)) ? $row->title : set_value('title'), 'id="title" class="form-control"'); ?>
				</div>
			</div>
		</div>
		<button class="btn btn-default" type="submit" name="submit_save" value="<?php echo ($function == 'copy') ? 'insert' : $function; ?>" >Kaydet</button>
		<button class="btn btn-default cancel" type="submit" name="submit_save" value="cancel" >İptal</button>
	</form>
	<?php endif; ?>
</div>
