<?php

namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class Category extends Main
{
	protected function rules($function = null)
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.categoryID', 'rules' => 'required'];
		}

		$rules['name']  = ['label' => 'Webadmin.categoryName', 'rules' => 'required|is_unique[category.name,id,{id}]'];

		return $rules;
	}

	protected function make($function = 'insert')
	{
		$category = new \App\Entities\Category();

		if (in_array($function, array('edit', 'copy'))) {
			$category->id       = $this->request->getPost('id');
			$category->modified = date('Y-m-d H:i:s');
		} else {
			$category->inserted = date('Y-m-d H:i:s');
			$category->modified = date('Y-m-d H:i:s');
		}

		$category->name      = $this->request->getPost('name');
		$category->htmlBegin = $this->request->getPost('htmlBegin');
		$category->htmlEnd   = $this->request->getPost('htmlEnd');
		$category->order     = (int) $this->request->getPost('order');
		$category->publish   = (int) $this->request->getPost('publish');

		return $category;
	}
}