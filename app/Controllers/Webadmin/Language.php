<?php
namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class Language extends Main
{
	protected function rules($function = null)
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.languageID', 'rules' => 'required'];
		}

		$rules['name']  = ['label' => 'Webadmin.languageName', 'rules' => 'required|is_unique[language.name,id,{id}]'];

		return $rules;
	}

	protected function make($function = 'insert')
	{
		$language = new \App\Entities\Language();

		if (in_array($function, array('edit', 'copy'))) {
			$language->id       = $this->request->getPost('id');
			$language->modified = date('Y-m-d H:i:s');
		} else {
			$language->inserted = date('Y-m-d H:i:s');
			$language->modified = date('Y-m-d H:i:s');
		}

		$language->name        = $this->request->getPost('name');
		$language->order       = (int) $this->request->getPost('order');
		$language->publish     = (int) $this->request->getPost('publish');

		return $language;
	}

	public function delete(int $id)
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');

		$id  = $this->request->getUri()->getSegment(4);
		$row = $this->{$this->classModel}->find($id);

		if ($row)
		{
			$contentCount = $this->contentModel->where('languageID', $id)->countAllResults();

			if($contentCount == 0)
			{
				$delete_result = $this->{$this->classModel}->delete($id);
				$message = ($delete_result) ? '<p class="alert alert-info">'.sprintf(lang('Webadmin.deleted'), $id).'</p>' : '<p class="alert alert-danger">'.sprintf(lang('Webadmin.not_deleted'), $id).'</p>';
			}
			else
			{
				$message = '<p class="alert alert-danger">'.lang('Webadmin.cantDeleteSubcategory').'</p>';
			}
		}
		else
		{
			$message = '<p class="alert alert-danger">'.lang('Webadmin.check_no').'</p>';
		}

		$this->session->setFlashdata('message', $message);

		return redirect()->to('webadmin/'.$this->className);
	}
}
