<!DOCTYPE html>
<html>
<head>
	<?= view($headView) ?>
</head>
<body>
	<header class="fixed-top">
		<?= view($headerView) ?>
	</header>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php if($leftView) echo view($leftView); ?>
				</div>
				<div class="col-md-9">
					<?= view($centerView) ?>
				</div>
			</div>
		</div>
	</main>
	<footer class="fixed-bottom">
		<?= view($footerView) ?>
		<?= view($footView) ?>
	</footer>
</body>
</html>
