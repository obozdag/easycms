<?php
namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model 
{
	protected $table         = "language";
	protected $returnType    = 'App\Entities\Language';

	protected $create_statement = <<<CREATE_STATEMENT
	CREATE TABLE `fkl_language` (
	  `id` integer NOT NULL primary key autoincrement,
	  `name` varchar(255) NOT NULL,
	  `order` int NOT NULL,
	  `publish` tinyint(1) NOT NULL DEFAULT '1',
	  `inserted` datetime NOT NULL,
	  `modified` datetime DEFAULT NULL
	)
	CREATE_STATEMENT;

	protected $allowedFields = [
		'name',
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
		'name'    => ['title' => 'name', 'type' => 'text'],
		'order'   => ['title' => 'order', 'type' => 'text'],
		'publish' => ['title' => 'publish', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
	];
}
