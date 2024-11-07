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
					<?php echo form_label('Email', 'email'); ?>
					<?php echo form_input('email', (isset($row->email)) ? $row->email : set_value('email'), 'id="email" class="form-control"'); ?>
					<?php echo form_hidden('old_email', (isset($row->email)) ? $row->email : '', 'id="old_email"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Ad', 'first_name'); ?>
					<?php echo form_input('first_name', (isset($row->first_name)) ? $row->first_name : set_value('first_name'), 'id="first_name" class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Soyad', 'last_name'); ?>
					<?php echo form_input('last_name', (isset($row->last_name)) ? $row->last_name : set_value('last_name'), 'id="last_name" class="form-control"'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Kullanıcı Grubu', 'groups');?>
					<?php echo form_multiselect('groups[]', $user_group_array, (isset($row->groups)) ? array_keys($row->groups) : $this->input->post('groups'), 'id="groups" class="form-control"'); ?>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="1" id="publish" name="publish" <?php echo ((isset($row->publish)) ? $row->publish : set_value('on_subcategory')) ? 'checked="checked"' : ''; ?>>
							Yayın
						</label>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-default" type="submit" name="submit_save" value="<?php echo ($function == 'copy') ? 'insert' : $function; ?>" >Kaydet</button>
		<button class="btn btn-default cancel" type="submit" name="submit_save" value="cancel" >İptal</button>
	</form>
	<?php endif; ?>
</div>
