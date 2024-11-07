<?php
namespace App\Models;

use CodeIgniter\Model;

class PlaceModel extends Model 
{
	protected $table      = "place";
	protected $returnType = 'App\Entities\Place';
	protected $child      = 'subcategory';

	protected $allowedFields = [
		'name',
		'pageID',
		'typeID',
		'htmlBegin',
		'htmlEnd',
		'onHomepage',
		'onContent',
		'onSubcategory',
		'publish',
		'order',
		'inserted',
		'modified',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'id'             => 'text',
		'name'           => 'text',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'      => ['title' => 'id', 'type' => 'text'],
		'order'   => ['title' => 'order', 'type' => 'text'],
		'type'    => ['title' => 'type', 'type' => 'text'],
		'name'    => ['title' => 'name', 'type' => 'text'],
		'publish' => ['title' => 'publish', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
	];

	public function findAll(?int $limit = null, int $offset = 0)
	{
		$builder = $this->builder();
		$builder->select('placeType.name as type, place.*');
		$builder->join('placeType', 'place.typeID = placeType.id');

		return parent::findAll($limit, $offset);		
	}
}
