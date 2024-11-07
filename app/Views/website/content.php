<!DOCTYPE html>
<html lang="<?= getenv('defaultLocale') ?>">
	<head>
		<?php echo view($headView); ?>
	</head>
	<body class="contentView">
		<?php
		foreach($places as $place) {
			echo $place->htmlBegin;

			foreach($place->subcategories as $subcategory) {
				echo $subcategory->htmlBegin;

				foreach($subcategory->contents as $content) {
					if(isset($content->text)) {
						echo $content->text;
					}

					if ($place->type == 'main' && $content->info) {
						echo '<div class="content-id">'."\n".$content->id."\n".'</div>'."\n";
						echo '<div class="content-inserted">'."\n".date('d-m-Y H:i:s', strtotime($content->inserted))."\n".'</div>'."\n";
					}
				}

				echo $subcategory->htmlEnd;
			}

			echo $place->htmlEnd;
		}

		echo view($footView);
		?>
	</body>
</html>