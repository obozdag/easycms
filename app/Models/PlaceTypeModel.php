<?php
namespace App\Models;

use CodeIgniter\Model;

class PlaceTypeModel extends Model
{
	protected $table      = 'placeType';
	protected $returnType = 'App\Entities\PlaceType';

	protected $allowedFields = [
		'name',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'id'             => 'text',
		'name'           => 'text',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'      => ['title' => 'id', 'type' => 'text'],
		'name'    => ['title' => 'name', 'type' => 'text'],
		'publish' => ['title' => 'publish', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
	];
}
