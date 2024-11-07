<?php
namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
	protected $table      = "visit";
	protected $returnType = "object";

	//Which fields will be listed. Field name and field type
	public $searchFields = [
		'id'  => 'text',
		'url' => 'text',
	];

	//Which fields will be listed. Field name and field type
	public $listFields = [
		'id'       => ['title' => 'id', 'type' => 'text'],
		'url'      => ['title' => 'url', 'type' => 'text'],
		'count'    => ['title' => 'count', 'type' => 'text'],
		'inserted' => ['title' => 'firstVisit', 'type' => 'date'], //date('d-m-Y', strtotime($row->inserted))
		'modified' => ['title' => 'lastVisit', 'type' => 'date'],
	];

	public $commands = [
		'delete',
		'visit',
	];
}
