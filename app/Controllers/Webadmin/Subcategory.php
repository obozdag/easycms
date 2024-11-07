<?php
namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class Subcategory extends Main
{
	protected function rules($function = null)
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.subcategoryID', 'rules' => 'required'];
		}

		$rules['name']        = ['label' => 'Webadmin.subcategoryName', 'rules' => 'required|is_unique[subcategory.name, id, {id}]'];
		$rules['placeID']     = ['label' => 'Webadmin.place', 'rules' => 'required'];
		$rules['categoryID']  = ['label' => 'Webadmin.category', 'rules' => 'required'];
		
		return $rules;
	}

	protected function make($function = 'insert')
	{
		$subcategory = new \App\Entities\Subcategory();

		if (in_array($function, array('edit', 'copy'))) {
			$subcategory->id       = $this->request->getPost('id');
			$subcategory->modified = date('Y-m-d H:i:s');
		} else {
			$subcategory->inserted = date('Y-m-d H:i:s');
			$subcategory->modified = date('Y-m-d H:i:s');
		}

		$subcategory->categoryID    = (int) $this->request->getPost('categoryID');
		$subcategory->placeID       = (int) $this->request->getPost('placeID');
		$subcategory->name          = $this->request->getPost('name');
		$subcategory->htmlBegin     = $this->request->getPost('htmlBegin');
		$subcategory->htmlEnd       = $this->request->getPost('htmlEnd');
		$subcategory->onHomepage    = (int) $this->request->getPost('onHomepage');
		$subcategory->onSubcategory = (int) $this->request->getPost('onSubcategory');
		$subcategory->onContent     = (int) $this->request->getPost('onContent');
		$subcategory->order         = (int) $this->request->getPost('order');
		$subcategory->publish       = (int) $this->request->getPost('publish');

		return $subcategory;
	}

	protected function select_options()
	{
		$options = '<option value="">Lütfen kategori seçiniz.</option>';
		$category_id 	= $this->input->post('category_id');

		if ($category_id)
		{
			$subcategory_array = $this->{$this->class_name.'_model'}->row_array(TRUE, array('where' => array('category_id' => $category_id)));

			if (count($subcategory_array))
			{
				$options = '';

				foreach($subcategory_array as $id => $name)
				{
					$options .= '<option value="'.$id.'">'.$name.'</option>';
				}
			}
		}

		echo $options;
	}
}
