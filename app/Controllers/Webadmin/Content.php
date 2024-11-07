<?php
namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class Content extends Main
{
	protected function rules($function = 'insert')
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.contentID', 'rules' => 'required'];
		}

		$rules['languageID']    = ['label' => 'Webadmin.languageID', 'rules' => 'required'];
		$rules['subcategoryID'] = ['label' => 'Webadmin.subcategoryID', 'rules' => 'required'];
		$rules['name']          = ['label' => 'Webadmin.contentName', 'rules' => 'required|is_unique[content.name,id,{id}]'];
		$rules['text']          = ['label' => 'Webadmin.contentText', 'rules' => 'required'];

		return $rules;
	}

	protected function rules_old($function = 'insert')
	{
		$validation = service('validation');

		if ($function == 'insert') {
			$validation->setRule('name', 'Webadmin.contentName', 'required|trim|is_unique[content.name]');
		} else {
			$validation->setRule('id', 'Webadmin.contentID', 'required|trim');
			$validation->setRule('name', 'Webadmin.contentName', 'required|trim');

			if ($this->request->getPost('name') != $this->request->getPost('old_name')) {
				$validation->setRule('name', 'Webadmin.contentName', 'required|is_unique[content.name]');
			}
		}

		$validation->setRule('commentForm', 'Webadmin.commentForm', 'trim');
		$validation->setRule('commentList', 'Webadmin.commentList', 'trim');
		$validation->setRule('info', 'Webadmin.contentInfo', 'trim');
		$validation->setRule('languageID', 'Webadmin.language', 'required|trim');
		$validation->setRule('mainContentID', 'Webadmin.mainContentID', 'trim');
		$validation->setRule('onContent', 'Webadmin.onContent', 'trim');
		$validation->setRule('onHomepage', 'Webadmin.onHomepage', 'trim');
		$validation->setRule('onSubcategory', 'Webadmin.onSubcategory', 'trim');
		$validation->setRule('order', 'Webadmin.order', 'trim');
		$validation->setRule('publish', 'Webadmin.publish', 'trim');
		$validation->setRule('subcategoryID', 'Webadmin.subcategory', 'required|trim');
		$validation->setRule('summary', 'Webadmin.contentSummary', 'trim');
		$validation->setRule('text', 'Webadmin.contentText', 'trim');
		$validation->setRule('userGroupID', 'Webadmin.userGroup', 'trim');
	}

	protected function make($function = 'insert')
	{
		$content = new \App\Entities\Content();

		if (in_array($function, array('edit', 'copy'))) {
			$content->id       = $this->request->getPost('id');
			$content->modified = date('Y-m-d H:i:s');
			$content->modifier = (int) $this->session->userID;
		} else {
			$content->inserter = (int) $this->session->userID;
			$content->inserted = date('Y-m-d H:i:s');
			$content->modified = date('Y-m-d H:i:s');
			$content->modifier = (int) $this->session->userID;
		}

		$content->commentForm   = (int) $this->request->getPost('commentForm');
		$content->commentList   = (int) $this->request->getPost('commentList');
		$content->info          = (int) $this->request->getPost('info');
		$content->languageID    = (int) $this->request->getPost('languageID');
		$content->mainContentID = (int) $this->request->getPost('mainContentID');
		$content->name          = $this->request->getPost('name');
		$content->onContent     = (int) $this->request->getPost('onContent');
		$content->onHomepage    = (int) $this->request->getPost('onHomepage');
		$content->onSubcategory = (int) $this->request->getPost('onSubcategory');
		$content->order         = (int) $this->request->getPost('order');
		$content->publish       = (int) $this->request->getPost('publish');
		$content->subcategoryID = $this->request->getPost('subcategoryID');
		$content->summary       = $this->request->getPost('summary');
		$content->text          = $this->request->getPost('text');

		return $content;
	}
}
