<meta charset="utf-8">

<title><?php echo $webadminConfig->websiteName.' '.lang('Webadmin.adminPanel'); ?></title>

<meta name="description" content="<?php echo $webadminConfig->metaDescription; ?>" />
<meta name="keywords" content="<?php echo $webadminConfig->metaKeywords; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link type="image/ico" rel="shortcut icon" href="/static/easycms/easycms.ico" />
<script type="text/javascript">
	const contUrl = '<?php echo $contUrl ?>';
</script>
<?php
	$cssFiles = explode(', ', setting()->get('webadmin.webadminCSSFiles'));

	foreach ($cssFiles as $cssFile)
	{
		echo '<link type="text/css" media="screen" rel="stylesheet" href="'.$cssFile.'" />'."\n";
	}

	$jsFiles = explode(', ', setting()->get('webadmin.webadminJsFiles'));

	foreach ($jsFiles as $jsFile)
	{
		echo '<script src="'.$jsFile.'"></script>'."\n";
	}
?>
