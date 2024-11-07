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
						<?= form_label($classTitle.' '.lang('Webadmin.name'), 'name', ['class' => 'form-label']) ?>
						<?= form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name" class="form-control" autofocus') ?>
					</div>
					<div class="mb-3">
						<?= form_label($classTitle.' '.lang('Webadmin.title'), 'title', ['class' => 'form-label']) ?>
						<?= form_input('title', (isset($row->title)) ? $row->title : set_value('title'), 'id="title" class="form-control"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.htmlBegin'), 'htmlBegin', ['class' => 'form-label']) ?>
						<?= form_textarea('htmlBegin', (isset($row->htmlBegin)) ? $row->htmlBegin : set_value('htmlBegin'), 'rows="6" class="form-control editor"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.htmlEnd'), 'htmlEnd', ['class' => 'form-label']) ?>
						<?= form_textarea('htmlEnd', (isset($row->htmlEnd)) ? $row->htmlEnd : set_value('htmlEnd'), 'rows="6" class="form-control editor"') ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<?= form_label(lang('Webadmin.order'), 'order', ['class' => 'form-label']) ?>
						<?= form_input('order', (isset($row->order)) ? $row->order : set_value('order'), 'id="order" class="form-control"') ?>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<input type="checkbox" value="1" id="publish" name="publish" <?= ((isset($row->publish)) ? $row->publish : set_value('publish')) ? 'checked="checked"' : '' ?>>
							<?= form_label(lang('Webadmin.publish'), 'publish', ['class' => 'form-label']) ?>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit" name="submitSave" value="<?= ($function == 'copy') ? 'insert' : $function; ?>" ><?= lang('Webadmin.save') ?></button>
			<button class="btn btn-secondary cancel" type="submit" name="submitSave" value="cancel" ><?= lang('Webadmin.cancel') ?></button>
		</form>
	<?php endif ?>
</div>
