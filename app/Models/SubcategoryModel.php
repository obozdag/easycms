<?php
namespace App\Models;

use CodeIgniter\Model;

class SubcategoryModel extends Model
{
	protected $table      = 'subcategory';
	protected $returnType = 'App\Entities\Subcategory';
	protected $child      = 'content';
	
	protected $create_statement = <<<CREATE_STATEMENT
	CREATE TABLE "fkl_subcategory" (
		"id"	integer NOT NULL,
		"categoryID"	int NOT NULL,
		"placeID"	int NOT NULL,
		"name"	varchar(255) NOT NULL,
		"htmlBegin"	text NOT NULL,
		"htmlEnd"	text NOT NULL,
		"onHomepage"	tinyint(1) NOT NULL DEFAULT '0',
		"onSubcategory"	tinyint(1) NOT NULL DEFAULT '0',
		"onContent"	tinyint(1) NOT NULL DEFAULT '0',
		"order"	int NOT NULL DEFAULT '1',
		"publish"	tinyint(1) NOT NULL DEFAULT '1',
		"inserted"	timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		"modified"	datetime DEFAULT NULL,
		PRIMARY KEY("id" AUTOINCREMENT)
	)
	CREATE_STATEMENT;

	protected $allowedFields = [
		'name',
		'categoryID',
		'placeID',
		'htmlBegin',
		'htmlEnd',
		'onHomepage',
		'onSubcategory',
		'onContent',
		'order',
		'publish',
		'inserter',
		'modifier',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'id'         => 'text',
		'name'       => 'text',
		'placeID'    => 'dropdown',
		'categoryID' => 'dropdown',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'             => ['title' => 'id', 'type' => 'text'],
		'order'          => ['title' => 'order', 'type' => 'text'],
		'categoryName'   => ['title' => 'category', 'type' => 'text'],
		'placeName'      => ['title' => 'place', 'type' => 'text'],
		'name'           => ['title' => 'name', 'type' => 'text'],
		'onHomepage'     => ['title' => 'onHomepage', 'type' => 'checkbox'],
		'onSubcategory'  => ['title' => 'onSubcategory', 'type' => 'checkbox'],
		'onContent'      => ['title' => 'onContent', 'type' => 'checkbox'],
		'publish'        => ['title' => 'publish', 'type' => 'checkbox'],
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
		$builder->select('placeType.name as placeType, place.name as placeName, place.id as placeID, category.name as categoryName, subcategory.*');
		$builder->join('place', 'subcategory.placeID = place.id');
		$builder->join('placeType', 'place.typeID = placeType.id');
		$builder->join('category', 'subcategory.categoryID = category.id');

		return parent::findAll($limit, $offset);		
	}
}
