<?php
	// if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1' && $websiteConfig->googleAnalytics)
	// {
	// 	echo '<script type="text/javascript">'.$websiteConfig->googleAnalytics.'</script>'."\n";
	// }

	// if ($this->config->item('show_counter'))
	// {
	// 	echo '<div class="counter">'.(isset($count_online) ? $count_online.':' : '').(isset($count_visitor) ? $count_visitor : '').'</div>'."\n";
	// }

	$jsFiles = explode(', ', setting()->get('website.websiteJsFiles'));

	foreach ($jsFiles as $jsFile)
	{
		echo '<script type="text/javascript" src="'.$jsFile.'"></script>'."\n";
	}
?>
