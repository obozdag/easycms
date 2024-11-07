<?php
namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model 
{
	protected $table      = 'page';
	protected $returnType = 'App\Entities\Page';
	protected $child      = 'place';

	protected $allowedFields = [
		'name',
		'title',
		'htmlBegin',
		'htmlEnd',
		'order',
		'publish',
		'inserted',
		'modified',
	];

	//Which fields are searchable. Field name and field type
	public $searchFields = [
		'id'             => 'text',
		'name'           => 'text',
		'title'          => 'text',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'               => ['title' => 'id', 'type' => 'text'],
		'name'             => ['title' => 'name', 'type' => 'text'],
		'title'            => ['title' => 'title', 'type' => 'text'],
		'publish'          => ['title' => 'publish', 'type' => 'checkbox'],
	];

	public $commands = [
		'edit',
		'copy',
		'delete',
	];
}
