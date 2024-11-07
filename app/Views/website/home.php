<!DOCTYPE html>
<html lang="<?= setting()->get('website.defaultLanguage') ?>">
	<head>
		<?php echo view($headView); ?>
	</head>
	<body class="homeView">
		<?php
		foreach($places as $place) {
			echo $place->htmlBegin;

			foreach($place->subcategories as $subcategory) {
				if ($place->type == 'main') {
					echo $subcategory->htmlBegin;
				}

				foreach($subcategory->contents as $content) {
					$output = '';

					if ($place->type == 'main') {
						$output .= $content->summary;
					} else {
						$output .= $content->text;
					}

					echo $output;
				}

				if ($place->type == 'main') {
					echo $subcategory->htmlEnd;
				}
			}

			echo $place->htmlEnd;
		}
		
		echo view($footView);
		?>
	</body>
</html>