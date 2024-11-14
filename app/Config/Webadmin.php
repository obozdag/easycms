<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Webadmin extends BaseConfig
{
/*
|--------------------------------------------------------------------------
| Webadmin Settings
|--------------------------------------------------------------------------
|
*/

public $addClassSubcategory;
public $captchaWords;
public $contentInfoPlace;
public $contentSubcategoryID;
public $countVisit;
public $countVisitor;
public $defaultLanguage;
public $editorUrl;
public $enableProfiler;
public $loginContentID;
public $metaDescription;
public $metaKeywords;
public $showCounter;
public $showGoogleAnalytics;
public $signupContentID;
public $webadminCSSFiles;
public $webadminJsFiles;
public $websiteEmail;
public $websiteName;
public $websiteTitle;
public $websiteTitleShort;

public $tables_to_backup	= array(
	'fkl_category',
	'fkl_comment',
	'fkl_config',
	'fkl_content',
	'fkl_guest_book',
	'fkl_language',
	'fkl_page',
	'fkl_pages_contents',
	'fkl_pages_places',
	'fkl_pages_subcategories',
	'fkl_place',
	'fkl_place_type',
	'fkl_subcategory',
	'fkl_user',
	'fkl_users_groups',
	'fkl_user_group',
	'fkl_user_groups_permissions',
	'fkl_user_group_permission',
	'fkl_visitor',
	'fkl_visit'
	);
}