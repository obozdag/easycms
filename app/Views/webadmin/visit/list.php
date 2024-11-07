<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
	$title_where 	= $count_where.'/';
	$title_all 		= $count_all ? ' ('.$title_where.$count_all.')' : '';
	$title 			= $class_title.$title_all;
?>

<?php if(isset($message) && ! empty($message))	echo $message; ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h1 class="panel-title">
			<?php echo $title; ?>
		</h1>
	</div>

	<form class="list_form" id="list_form" name="list_form" method="post" action="<?php echo base_url('webadmin/'.$class_name); ?>">
		<?php	if($rows->num_rows() > 0): ?>
		<table class="table">
				<thead>
					<tr>
						<th class="t_right">Sr</th>
						<th class="t_right">No</th>
						<th>URL</th>
						<th class="text-right">Ziyaret Sayısı</th>
						<th>İlk Ziyaret</th>
						<th>Son Ziyaret</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$counter = isset($offset) ? $offset : 0;
				foreach($rows->result() as $row):
					$odd_even = ($counter++ % 2 == 0) ? 'odd' : 'even';
				?>
					<tr class="<?php echo $odd_even; ?>">
						<td class="t_right"><?php echo $counter; ?></td>
						<td><?php echo $row->id; ?></td>
						<td><?php echo $row->url; ?></td>
						<td class="text-right"><?php echo $row->count; ?></td>
						<td><?php echo date('d-m-Y', strtotime($row->inserted)); ?></td>
						<td><?php echo date('d-m-Y', strtotime($row->modified)); ?></td>
						<td style="width:10em;">
							<div class="btn-group">
								<a class="btn btn-default btn-sm delete" href="<?php echo site_url('webadmin/'.$class_name.'/delete/'.$row->id); ?>" data-id="<?php echo $row->id; ?>" title="Sil"><i class="fa fa-trash-o fa-lg"></i></a>
								<a class="btn btn-default btn-sm" href="<?php echo site_url($row->url); ?>" title="Göster"><i class="fa fa-globe fa-lg"></i></a>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<div class="panel-body">
			<?php echo $this->pagination->create_links(); ?>
		</div>
		<?php endif; ?>
	</form>
</div>
