<meta charset="utf-8">
<title><?= setting()->get('website.websiteTitle') ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-status-bar" content="#FFE1C4">
<meta name="theme-color" content="#FFE1C4">
<meta name="description" content="<?= setting()->get('website.metaDescription') ?>" />
<meta name="keywords" content="<?= setting()->get('website.metaKeywords') ?>" />

<link type="image/ico" rel="shortcut icon" href="/favicon.ico" />

<?php
	$cssFiles = explode(', ', setting()->get('website.websiteCSSFiles'));

	foreach ($cssFiles as $cssFile)
	{
		echo '<link type="text/css" media="screen" rel="stylesheet" href="'.$cssFile.'" />'."\n";
	}
?>
