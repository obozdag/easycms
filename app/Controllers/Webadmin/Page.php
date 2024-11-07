<?php
namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class Page extends Main
{
	protected function rules($function = null)
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.pageID', 'rules' => 'required'];
		}

		$rules['name']  = ['label' => 'Webadmin.pageName', 'rules' => 'required|is_unique[page.name,id,{id}]'];
		$rules['title'] = ['label' => 'Webadmin.pageTitle', 'rules' => 'required|is_unique[page.title,id,{id}]'];

		return $rules;
	}

	protected function make($function = 'insert')
	{
		$page = new \App\Entities\Page();

		if (in_array($function, array('edit', 'copy'))) {
			$page->id       = $this->request->getPost('id');
			$page->modified = date('Y-m-d H:i:s');
		} else {
			$page->inserted = date('Y-m-d H:i:s');
			$page->modified = date('Y-m-d H:i:s');
		}

		$page->name      = $this->request->getPost('name');
		$page->title     = $this->request->getPost('title');
		$page->htmlBegin = $this->request->getPost('htmlBegin');
		$page->htmlEnd   = $this->request->getPost('htmlEnd');
		$page->order     = (int) $this->request->getPost('order');
		$page->publish   = (int) $this->request->getPost('publish');

		return $page;
	}
}
