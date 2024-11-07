<?php
namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model 
{
	protected $table      = 'category';
	protected $returnType = 'App\Entities\Category';
	protected $child      = 'subcategory';

	protected $create_statement = <<<CREATE_STATEMENT
	CREATE TABLE "fkl_category" (
		"id"	integer NOT NULL,
		"name"	varchar(255) NOT NULL,
		"htmlBegin"	text NOT NULL,
		"htmlEnd"	text NOT NULL,
		"order"	int NOT NULL DEFAULT '1',
		"publish"	tinyint(1) NOT NULL DEFAULT '1',
		"inserted"	timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		"modified"	datetime DEFAULT NULL,
		PRIMARY KEY("id" AUTOINCREMENT)
	)
	CREATE_STATEMENT;

	protected $allowedFields = [
		'name',
		'htmlBegin',
		'htmlEnd',
		'order',
		'publish',
		'inserted',
		'modified',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'id'   => 'text',
		'name' => 'text',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'      => ['title' => 'id', 'type' => 'text'],
		'order'   => ['title' => 'order', 'type' => 'text'],
		'name'    => ['title' => 'name', 'type' => 'text'],
		'publish' => ['title' => 'publish', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
	];
}
