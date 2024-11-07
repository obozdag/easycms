<?php
namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class Place extends Main
{
	protected function rules($function = null)
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.placeID', 'rules' => 'required'];
		}

		$rules['name']   = ['label' => 'Webadmin.placeName', 'rules' => 'required|is_unique[place.name,id,{id}]'];
		$rules['typeID'] = ['label' => 'Webadmin.placeType', 'rules' => 'required'];
		$rules['pageID'] = ['label' => 'Webadmin.page', 'rules' => 'required'];

		return $rules;
	}

	protected function make($function = 'insert')
	{
		$entity = new \App\Entities\Place();

		if (in_array($function, array('edit', 'copy'))) {
			$entity->id       = $this->request->getPost('id');
			$entity->modified = date('Y-m-d H:i:s');
		} else {
			$entity->inserted = date('Y-m-d H:i:s');
			$entity->modified = date('Y-m-d H:i:s');
		}

		$entity->pageID        = (int) $this->request->getPost('pageID');
		$entity->typeID        = (int) $this->request->getPost('typeID');
		$entity->name          = $this->request->getPost('name');
		$entity->htmlBegin     = $this->request->getPost('htmlBegin');
		$entity->htmlEnd       = $this->request->getPost('htmlEnd');
		$entity->onHomepage    = (int) $this->request->getPost('onHomepage');
		$entity->onSubcategory = (int) $this->request->getPost('onSubcategory');
		$entity->onContent     = (int) $this->request->getPost('onContent');
		$entity->order         = (int) $this->request->getPost('order');
		$entity->publish       = (int) $this->request->getPost('publish');

		return $entity;
	}
}
