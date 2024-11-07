<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo $class_title; ?> Arama</h2>
	</div>
	<div class="panel-body">
		<form action="<?php echo site_url('webadmin/'.$class_name.'/get')?>" id="search_options" method="post" accept-charset="utf-8">
			<div class="form-group <?php echo empty($search_options['url']) ? '' : 'selected-control'; ?>">
				<?php echo form_label($class_title.' URL', 'search_url'); ?>
				<?php echo form_input('search_url', isset($search_options['url']) ? $search_options['url'] : '' , 'id="search_url" class="form-control"'); ?>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-default" name="submit_search" value="Ara" />
			</div>
		</form>
	</div>
</div>
