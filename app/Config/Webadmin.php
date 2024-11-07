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

public $webadminCSSFiles = array(
	'bootstrap' => '/_assets/bootstrap/css/bootstrap.min.css',
	'/_assets/font-awesome/css/font-awesome.css',
	'/_assets/fonts/fonts.css',
	'/static/fkl_cms/webadmin.css'
	);

public $webadminJsFiles = array(
	'/_assets/jquery/jquery.js',
	'/_assets/jquery/jquery.validate.js',
	'bootstrap' => '/_assets/bootstrap/js/bootstrap.bundle.min.js',
	'/static/fkl_cms/webadmin.js'
	);

public $addClassSubcategory = false;
public $captchaWords = 'fklavye, codeigniter, website, search';
public $contentInfoPlace = '';
public $contentSubcategoryID = 3;
public $countVisit = true;
public $countVisitor = true;
public $defaultLanguage = 'tr';
public $editorUrl = '_editor/';
public $enableProfiler = false;
public $loginContentID = 41;
public $metaDescription = 'Almanyada Hayat';
public $metaKeywords = 'Almanyada Hayat';
public $showCounter = false;
public $showGoogleAnalytics = true;
public $signupContentID = 42;
public $websiteEmail = 'support@fklavye.net';
public $websiteName = 'fklavye';
public $websiteTitle = 'Almanyada Hayat';
public $websiteTitleShort = 'Almanyada Hayat';

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