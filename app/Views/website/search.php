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
				
				if ($place->type == 'main') {
					echo '<h1>'.lang('Website.searchResultHeading').': '.$searchStr.'</h1>';
				 } else {
					echo '';
				 }

				if ($subcategory->contents) {
					foreach($subcategory->contents as $content) {
						if ($place->type == 'main') {
							echo '<p><a href="/website/content/'.$content->id.'">'.character_limiter($content->name, 80).'</a></p>'."\n";
						} else {
							echo ''; // $this->parser->parse_string($content->text, $content, TRUE);
						}
					}
				} else {
					echo ($place->type == 'main') ? '<p>'.lang('Website.noSearchResult').'</p>'."\n" : '';
				}
				echo $subcategory->htmlEnd;
			}

			echo $place->htmlEnd;
		}

		echo view($footView);
		?>
	</body>
</html>