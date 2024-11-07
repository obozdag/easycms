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
						<?= form_label($classTitle.' '.lang('Webadmin.htmlBegin'), 'htmlBegin', ['class' => 'form-label']) ?>
						<?= form_textarea('htmlBegin', (isset($row->htmlBegin)) ? $row->htmlBegin : set_value('htmlBegin'), 'rows="6" id="htmlBegin" class="form-control editor"') ?>
					</div>
					<div class="mb-3">
						<?= form_label($classTitle.' '.lang('Webadmin.htmlEnd'), 'htmlEnd', ['class' => 'form-label']) ?>
						<?= form_textarea('htmlEnd', (isset($row->htmlEnd)) ? $row->htmlEnd : set_value('htmlEnd'), 'rows="6" id="htmlEnd" class="form-control editor"') ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<?= form_label(lang('Webadmin.place'), 'placeID', ['class' => 'form-label']) ?>
						<?= form_dropdown('placeID', $placeIDArray, (isset($row->placeID)) ? $row->placeID : set_value('placeID'), 'id="placeID" class="form-select"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.category'), 'categoryID', ['class' => 'form-label']) ?>
						<?= form_dropdown('categoryID', $categoryIDArray, (isset($row->categoryID)) ? $row->categoryID : set_value('categoryID'), 'id="categoryID" class="form-select"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.order'), 'order', ['class' => 'form-label']) ?>
						<?= form_input('order', (isset($row->order)) ? $row->order : set_value('order'), 'id="order" class="form-control"') ?>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('onHomepage', 1, (isset($row->onHomepage) ? $row->onHomepage : '')) ?>
							<?= form_label(lang('Webadmin.onHomepage'), 'onHomepage', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.onHomepageDesc') ?></div>
						</div>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('onSubcategory', 1, (isset($row->onSubcategory) ? $row->onSubcategory : '')) ?>
							<?= form_label(lang('Webadmin.onSubcategory'), 'onSubcategory', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.onSubcategoryDesc') ?></div>
						</div>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('onContent', 1, (isset($row->onContent) ? $row->onContent : '')) ?>
							<?= form_label(lang('Webadmin.onContent'), 'onContent', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.onContentDesc') ?></div>
						</div>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('publish', 1, (isset($row->publish) ? $row->publish : '')) ?>
							<?= form_label(lang('Webadmin.publish'), 'publish', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.publishDesc') ?></div>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit" name="submitSave" value="<?= ($function == 'copy') ? 'insert' : $function; ?>" ><?= lang('Webadmin.save') ?></button>
			<button class="btn btn-secondary cancel" type="submit" name="submitSave" value="cancel" ><?= lang('Webadmin.cancel') ?></button>
		</form>
		<?php endif ?>
	</div>
</div>
