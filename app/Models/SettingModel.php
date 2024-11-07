<?php
namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
	protected $table      = "settings";
	protected $returnType = 'App\Entities\Setting';

	protected $create_statement = <<<CREATE_STATEMENT
		CREATE TABLE "fkl_settings" (
			"id"	integer NOT NULL,
			"class"	varchar(255) NOT NULL,
			"key"	varchar(255) NOT NULL,
			"value"	text,
			"type"	varchar(31) NOT NULL DEFAULT 'string',
			"created_at"	datetime NOT NULL,
			"updated_at"	datetime NOT NULL,
			"context" varchar NULL,
			PRIMARY KEY("id" AUTOINCREMENT)
		)
	CREATE_STATEMENT;

	protected $allowedFields = [
		'class',
		'key',
		'value',
		'type',
		'context',
		'created_at',
		'updated_at',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'id'    => 'text',
		'class' => 'text',
		'key'   => 'text',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'    => ['title' => 'id', 'type' => 'text'],
		'class' => ['title' => 'class', 'type' => 'text'],
		'key'   => ['title' => 'key', 'type' => 'text'],
		'type'  => ['title' => 'type', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
	];
}
