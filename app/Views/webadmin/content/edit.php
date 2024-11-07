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
		<?php endif; ?>
			<?= csrf_field() ?>
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<?= form_label(lang('Webadmin.language'), 'languageID', ['class' => 'form-label']) ?>
						<?= form_dropdown('languageID', $languageIDArray, (isset($row->languageID)) ? $row->languageID : set_value('languageID'), 'id="languageID" class="form-select"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.category'), 'categoryID', ['class' => 'form-label']) ?>
						<?= form_dropdown('categoryID', $categoryIDArray, (isset($row->categoryID)) ? $row->categoryID : set_value('categoryID'), 'id="categoryID" class="form-select"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.subcategory'), 'subcategoryID', ['class' => 'form-label']) ?>
						<?= form_dropdown('subcategoryID', $subcategoryIDArray, (isset($row->subcategoryID)) ? $row->subcategoryID : set_value('subcategoryID'), 'id="subcategoryID" class="form-select"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.order'), 'order', ['class' => 'form-label']) ?>
						<?= form_input('order', (isset($row->order)) ? $row->order : set_value('order'), 'id="order" class="form-control"') ?>
					</div>
					<div class="mb-3">
						<?= form_label(lang('Webadmin.mainContentID'), 'mainContentID', ['class' => 'form-label']) ?>
						<?= form_input('mainContentID', set_value('mainContentID', $row->mainContentID ?? (($function == 'copy' AND isset($row->id)) ? $row->id : '') ?? ''), 'id="mainContentID" class="form-control"') ?>
						<div class="form-text"><?= lang('Webadmin.mainContentIDDesc') ?></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('info', 1, (isset($row->info) ? $row->info : '')) ?>
							<?= form_label(lang('Webadmin.contentInfo'), 'info', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.contentInfoDesc') ?></div>
						</div>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('commentForm', 1, (isset($row->commentForm) ? $row->commentForm : '')) ?>
							<?= form_label(lang('Webadmin.commentForm'), 'commentForm', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.commentFormDesc') ?></div>
						</div>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<?= form_checkbox('commentList', 1, (isset($row->commentList) ? $row->commentList : '')) ?>
							<?= form_label(lang('Webadmin.commentList'), 'commentList', ['class' => 'form-label']) ?>
							<div class="form-text"><?= lang('Webadmin.commentListDesc') ?></div>
						</div>
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
			<div class="mb-3">
				<?= form_label($classTitle.' '.lang('Webadmin.name'), 'name', ['class' => 'form-label']) ?>
				<?= form_input('name', (isset($row->name)) ? $row->name : set_value('name'), 'id="name" class="form-control" autofocus') ?>
				<?= form_hidden('old_name', (isset($row->name)) ? $row->name : '') ?>
			</div>
			<div class="mb-3">
				<?= form_label(lang('Webadmin.contentText'), 'text', ['class' => 'form-label']); ?>
				<textarea name="text" id="text" rows="14" class="form-control editor"><?= set_value('text', isset($row->text) ? $row->text : '') ?></textarea>
			</div>
			<div class="mb-3">
				<?= form_label(lang('Webadmin.contentSummary'), 'summary', ['class' => 'form-label']); ?>
				<textarea name="summary" id="summary" rows="6" class="form-control editor"><?= set_value('summary', isset($row->summary) ? $row->summary : '') ?></textarea>
			</div>
			<button class="btn btn-primary" type="submit" name="submitSave" value="<?= ($function == 'copy') ? 'insert' : $function; ?>" ><?= lang('Webadmin.save') ?></button>
			<button class="btn btn-secondary cancel" type="submit" name="submitSave" value="cancel" ><?= lang('Webadmin.cancel') ?></button>
		</form>
	<?php endif; ?>
	</div>
</div>