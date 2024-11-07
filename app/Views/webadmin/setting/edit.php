<?php if(isset($message) && ! empty($message))	echo $message ?>

<div class="card card-default">
	<div class="card-header">
		<h5 class="card-title">
			<?= $classTitle.' '.(($function == 'edit') ? lang('Webadmin.edit').' (ID: '.$row->id.')' : lang('Webadmin.add')) ?>
		</h5>
	</div>
	<div class="card-body">
		<?php if ($function == 'insert' OR isset($row)): ?>
			<form action="<?= '/webadmin/'.$className.'/'.$function.(isset($row->id) ? '/'.$row->id : '') ?>" class="form edit_form" role="form" method="post" accept-charset="utf-8">
			<?php if (isset($row->id)): ?>
				<input type="hidden" name="id" value="<?= $row->id ?>">
			<?php endif ?>
			<?= csrf_field() ?>
				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<?= form_label(lang('Webadmin.class'), 'class', ['class' => 'form-label']) ?>
							<?= form_input('class', (isset($row->class)) ? $row->class : set_value('class'), 'id="class" class="form-control" autofocus') ?>
						</div>
						<div class="mb-3">
							<?= form_label(lang('Webadmin.key'), 'key', ['class' => 'form-label']) ?>
							<?= form_input('key', (isset($row->key)) ? $row->key : set_value('key'), 'id="key" class="form-control"') ?>
						</div>
						<div class="mb-3">
							<?= form_label(lang('Webadmin.value'), 'value', ['class' => 'form-label']) ?>
							<textarea name="value" id="value" rows="6" class="form-control"><?= set_value('value', isset($row->value) ? $row->value : '') ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<?= form_label(lang('Webadmin.type'), 'type', ['class' => 'form-label']) ?>
							<?= form_input('type', (isset($row->type)) ? $row->type : set_value('type'), 'id="type" class="form-control"') ?>
						</div>
						<div class="mb-3">
							<?= form_label(lang('Webadmin.context'), 'context', ['class' => 'form-label']) ?>
							<?= form_input('context', (isset($row->context)) ? $row->context : set_value('context'), 'id="context" class="form-control"') ?>
						</div>
					</div>
				</div>
				<button class="btn btn-primary" type="submit" name="submitSave" value="<?= ($function == 'copy') ? 'insert' : $function; ?>" ><?= lang('Webadmin.save') ?></button>
				<button class="btn btn-secondary cancel" type="submit" name="submitSave" value="cancel" ><?= lang('Webadmin.cancel') ?></button>
			</form>
		<?php endif; ?>
	</div>
</div>
