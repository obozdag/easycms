<?php
namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model 
{
	protected $table      = 'content';
	protected $returnType = 'App\Entities\Content';

	protected $create_statement = <<<CREATE_STATEMENT
	CREATE TABLE "fkl_content" (
		"id"	integer NOT NULL,
		"languageID"	int NOT NULL DEFAULT '1',
		"subcategoryID"	int NOT NULL,
		"mainContentID"	int NOT NULL,
		"name"	varchar(255) NOT NULL,
		"summary"	text NOT NULL,
		"text"	longtext NOT NULL,
		"onHomepage"	tinyint(1) NOT NULL DEFAULT '0',
		"onSubcategory"	tinyint(1) NOT NULL DEFAULT '0',
		"onContent"	tinyint(1) NOT NULL DEFAULT '1',
		"onSearch"	tinyint(1) NOT NULL DEFAULT '1',
		"commentForm"	tinyint(1) DEFAULT '0',
		"commentList"	tinyint(1) DEFAULT '0',
		"info"	tinyint(1) DEFAULT '0',
		"order"	int NOT NULL DEFAULT '1',
		"publish"	tinyint(1) NOT NULL DEFAULT '1',
		"inserter"	int NOT NULL,
		"inserted"	datetime NOT NULL,
		"modified"	datetime NOT NULL,
		"modifier"	int NOT NULL,
		PRIMARY KEY("id" AUTOINCREMENT)
	)
	CREATE_STATEMENT;

	protected $allowedFields = [
		'languageID',
		'subcategoryID',
		'mainContentID',
		'name',
		'summary',
		'text',
		'onHomepage',
		'onSubcategory',
		'onContent',
		'onSearch',
		'commentForm',
		'commentList',
		'info',
		'order',
		'publish',
		'inserter',
		'modifier',
		'inserted',
		'modified',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'content.id'    => 'text',
		'content.name'  => 'text',
		'languageID'    => 'dropdown',
		'placeID'       => 'dropdown',
		'subcategoryID' => 'dropdown',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'              => ['title' => 'id', 'type' => 'text'],
		'languageName'    => ['title' => 'language', 'type' => 'text'],
		'subcategoryName' => ['title' => 'subcategory', 'type' => 'text'],
		'name'            => ['title' => 'name', 'type' => 'text'],
		'onHomepage'      => ['title' => 'onHomepage', 'type' => 'checkbox'],
		'onSubcategory'   => ['title' => 'onSubcategory', 'type' => 'checkbox'],
		'onContent'       => ['title' => 'onContent', 'type' => 'checkbox'],
		'publish'         => ['title' => 'publish', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
		'browse',
	];

	public function findAll(?int $limit = null, int $offset = 0)
	{
		$builder = $this->builder();
		$builder->select('language.name as languageName, subcategory.name as subcategoryName, content.*');
		$builder->join('language', 'content.languageID = language.id');
		$builder->join('subcategory', 'content.subcategoryID = subcategory.id');

		return parent::findAll($limit, $offset);		
	}
}
