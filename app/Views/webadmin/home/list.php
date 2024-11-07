<?php if(isset($message) && ! empty($message))	echo $message; ?>

<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title">
		<?= lang('Webadmin.shortcutsTitle') ?>
		</h5>
	</div>
	<div class="card-body">
		<ul>
			<li><a href="/webadmin/content"><?= lang('Webadmin.content') ?></a></li>
			<li><a href="/webadmin/subcategory"><?= lang('Webadmin.subcategory') ?></a></li>
			<li><a href="/webadmin/category"><?= lang('Webadmin.category') ?></a></li>
			<li><a href="/webadmin/place"><?= lang('Webadmin.place') ?></a></li>
			<li><a href="/webadmin/page"><?= lang('Webadmin.page') ?></a></li>
			<li><a href="/webadmin/language"><?= lang('Webadmin.language') ?></a></li>
			<li><a href="/webadmin/user"><?= lang('Webadmin.user') ?></a></li>
			<li><a href="/webadmin/userGroup"><?= lang('Webadmin.userGroup') ?></a></li>
			<li><a href="/webadmin/config"><?= lang('Webadmin.settings') ?></a></li>
			<li><a href="/logout"><?= lang('Webadmin.logout') ?></a></li>
		</ul>
	</div>
</div>
