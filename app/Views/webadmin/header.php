<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
	<div class="container">
		<a class="navbar-brand" href="/webadmin"><img src="/media/images/website.ico" alt="fklavye"> <?= lang('Webadmin.adminPanel') ?></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mx-auto">
				<li class="nav-item"><a class="nav-link" href="/webadmin/subcategory"><?= lang('Webadmin.subcategory') ?></a></li>
				<li class="nav-item"><a class="nav-link" href="/webadmin/content"><?= lang('Webadmin.content') ?></a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?= lang('Webadmin.other') ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/webadmin/category"><?= lang('Webadmin.category') ?></a>
						<a class="dropdown-item" href="/webadmin/language"><?= lang('Webadmin.language') ?></a>
						<a class="dropdown-item" href="/webadmin/page"><?= lang('Webadmin.page') ?></a>
						<a class="dropdown-item" href="/webadmin/place"><?= lang('Webadmin.place') ?></a>
						<a class="dropdown-item disabled" href="/webadmin/user"><?= lang('Webadmin.user') ?></a>
						<a class="dropdown-item disabled" href="/webadmin/usergroup"><?= lang('Webadmin.userGroup') ?></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/webadmin/setting"><?= lang('Webadmin.setting') ?></a>
						<a class="dropdown-item disabled" href="/webadmin/home/backup"><?= lang('Webadmin.backup') ?></a>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto">
				<li class="nav-item"><a class="nav-link active" href="/webadmin"><?= lang('Webadmin.homepage') ?></a></li>
				<li class="nav-item"><a class="nav-link" href="/webadmin/visit"><?= lang('Webadmin.visitReport') ?></a></li>
				<li class="nav-item"><a class="nav-link" href="/" target="_blank"><?= lang('Webadmin.websiteHomepage') ?></a></li>
				<li class="nav-item"><a class="nav-link" href="/logout"><?= lang('Webadmin.logout') ?></a></li>
				<li class="nav-item"><a class="nav-link disabled"><?= auth()->user()->email ?></a></li>
			</ul>
			<?php if ($session->get('email')): ?><span class="badge bg-secondary"><?= $session->get('email') ?></span><?php endif ?>
		</div>
	</div>
</nav>
