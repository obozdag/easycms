<?php if (isset($message) && ! empty($message))	echo $message; ?>

<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title">
			<?= $classTitle.' '.lang('Webadmin.list') ?>
			<a class="btn btn-light btn-xs pull-right" href="<?= '/webadmin/'.$className.'/insert'; ?>" ><i class="fa fa-plus fa-lg"></i> <?= lang('Webadmin.'.$className); ?> <?= lang('Webadmin.add'); ?></a>
		</h5>
	</div>
	<div class="card-body">
	<?php if (sizeof($rows) > 0): ?>
		<form class="list-group" id="list-form" name="list-form" method="post" action="<?= '/webadmin/'.$className ?>">
			<div class="table-responsive">
				<table class="table table-striped table-sm">
					<thead>
						<tr>
						<?php foreach ($listFields as $key => $field): ?>
							<th><?= lang('Webadmin.'.$field['title']) ?></th>
						<?php endforeach; ?>
							<th class="text-right"><?= lang('Webadmin.commands') ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($rows as $row): ?>
						<tr>
						<?php foreach ($listFields as $key => $field): ?>
							<?php if ($field['type'] == 'text'): ?>
							<td><?= $row->$key ?></td>
							<?php elseif ($field['type'] == 'date') : ?>
							<td><?= date('d-m-Y', strtotime($row->$key)) ?></td>
							<?php elseif ($field['type'] == 'checkbox') : ?>
							<td><input type="checkbox" class="check" name="<?= $key ?>" value="<?= $row->id ?>" <?= ($row->$key) ? 'checked' : '' ?>></td>
							<?php endif; ?>
						<?php endforeach; ?>
							<td class="commands text-right">
								<div class="btn-group">
								<?php foreach ($commands as $command): ?>
									<?php if ($command == 'edit'): ?><a class="btn btn-light btn-sm" href="<?= '/webadmin/'.$className.'/edit/'.$row->id ?>" title="<?= lang('Webadmin.edit') ?>"><i class="fa fa-pencil fa-lg"></i></a><?php endif; ?>
									<?php if ($command == 'copy'): ?><a class="btn btn-light btn-sm" href="<?= '/webadmin/'.$className.'/copy/'.$row->id ?>" title="<?= lang('Webadmin.copy') ?>"><i class="fa fa-copy fa-lg"></i></a><?php endif; ?>
									<?php if ($command == 'delete'): ?><a class="btn btn-light btn-sm delete" href="<?= '/webadmin/'.$className.'/delete/'.$row->id ?>" data-id="<?php echo $row->id; ?>" title="<?= lang('Webadmin.delete') ?>"><i class="fa fa-trash-o fa-lg"></i></a><?php endif; ?>
									<?php if ($command == 'browse'): ?><a class="btn btn-light btn-sm" href="<?= '/website/'.$className.'/'.$row->id ?>" data-id="<?php echo $row->id; ?>" title="<?= lang('Webadmin.browse') ?>" target="_blank"><i class="fa fa-globe fa-lg"></i></a><?php endif; ?>
									<?php if ($command == 'visit'): ?><a class="btn btn-light btn-sm" href="<?= '/'.$row->url ?>" data-id="<?= $row->id; ?>" title="<?= lang('Webadmin.visit') ?>"><i class="fa fa-globe fa-lg"></i></a><?php endif; ?>
								<?php endforeach; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</form>
	<?php endif; ?>
	</div>
	<?php if ($pager->getPageCount() > 1): ?>
	<div class="card-footer">
		<?php echo $pager->links(); ?>
	</div>
	<?php endif; ?>
</div>