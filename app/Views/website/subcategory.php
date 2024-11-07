<!DOCTYPE html>
<html>
	<head>
		<?php echo view($headView); ?>
	</head>
	<body class="subcategory-view">
		<?php
		$parser = \Config\Services::parser();

		foreach($places as $place) {
			echo $place->htmlBegin;

			foreach($place->subcategories as $subcategory) {
				$output = '';

				if ($place->type == 'main') {
					echo '<div class="subcategory" data-subcategory-id="'.$subcategory->id.'">'."\n".$subcategory->htmlBegin."\n";
				} else {
					echo $subcategory->htmlBegin;
				}

				foreach ($subcategory->contents as $content) {
					if ($place->type == 'main') {
						echo '<div class="summary" data-content-id="'.$content->id.'">'."\n".$content->summary."\n".'</div>'."\n";
					} else {
						echo $content->summary;
					}
				}

				if ($place->type == 'main') {
					echo $subcategory->htmlEnd."\n"."\n"."</div>";
				} else {
					echo $subcategory->htmlEnd."\n";
				}

				echo ($place->type == 'main')
				? '<div class="subcategory" data-subcategory-id="'.$subcategory->id.'">'."\n".$parser->setData((array)$subcategory)->renderString($subcategory->htmlBegin)."\n"
				: $parser->setData((array)$subcategory)->renderString($subcategory->htmlBegin)
				;

				foreach($subcategory->contents as $content) {
					echo ($place->type == 'main')
					? '<div class="summary" data-content-id="'.$content->id.'">'."\n".$parser->setData((array)$content)->renderString($content->summary)."\n".'</div>'."\n"
					: $parser->setData((array)$content)->renderString($content->text)
					;
				}

				echo ($place->type == 'main')
				? $parser->setData((array)$subcategory)->renderString($subcategory->htmlEnd)."\n".'</div>'."\n"
				: $parser->setData((array)$subcategory)->renderString($subcategory->htmlEnd)
				;
			}

			echo $place->htmlEnd;
		}
		echo view($footView);
		?>
	</body>
</html>
