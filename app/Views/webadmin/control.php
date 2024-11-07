<?php helper('form'); ?>
<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title"><?php echo $classTitle.' '.lang('Webadmin.search'); ?></h5>
	</div>
	<div class="card-body">
		<form action="<?= '/webadmin/'.$className; ?>" id="searchOptions" method="post" accept-charset="utf-8">
			<?php echo csrf_field() ?>
			<?php foreach ($searchFields as $field => $type) : ?>
				<div class="mb-3<?php echo empty($searchOptions['id']) ? '' : ' selected-control'; ?>">
					<?php
					switch ($type) {
						case 'text':
							$data = [
								'type'        => 'text',
								'name'        => 'search'.$field,
								'id'          => 'search'.$field,
								'placeholder' => lang('Webadmin.'.$field),
								'value'       => isset($searchOptions[$field]) ? $searchOptions[$field] : '',
								'class'       => 'form-control',
							];
							echo form_input($data);
							break;
						case 'dropdown':
							$data = [
								'class' => 'form-label',
							];
							echo form_label(lang('Webadmin.'.$field), 'search'.$field, $data);

							$data = [
								'name'     => 'search'.$field,
								'id'       => 'search'.$field,
								'class'    => 'form-select',
								'options'  => ${$field.'Array'},
								'selected' => isset($searchOptions[$field]) ? $searchOptions[$field] : '',
							];
							echo form_dropdown($data);
					}
					?>
				</div>
			<?php endforeach; ?>
			<div class="mb-3">
				<input type="submit" class="btn btn-primary" name="submitSearch" value="<?= lang('Webadmin.search') ?>" />
			</div>
		</form>
	</div>
</div>