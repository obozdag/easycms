<?php
namespace App\Controllers\Webadmin;

use CodeIgniter\I18n\Time;
use App\Controllers\Webadmin\Main;

class Setting extends Main
{
	protected function rules($function = 'insert')
	{
		$rules = [];

		if ($function == 'edit'){
			$rules['id'] = ['label' => 'Webadmin.settingID', 'rules' => 'required'];
		}

		$rules['class'] = ['label' => 'Webadmin.class', 'rules' => 'required'];
		$rules['key']   = ['label' => 'Webadmin.key', 'rules' => 'required'];

		return $rules;
	}

	protected function make($function = 'insert')
	{
		$row = new \App\Entities\Setting();

      $time = Time::now()->format('Y-m-d H:i:s');

      if ($function == 'insert') {
			$row->created_at = $time;
			$row->updated_at = $time;
      } else {
			$row->updated_at = $time;
			$row->created_at = $time;
      }

		$row->class   = $this->request->getPost('class');
		$row->key     = $this->request->getPost('key');
		$row->value   = $this->request->getPost('value');
		$row->type    = $this->request->getPost('type');
		$row->context = $this->request->getPost('context');

		$this->_check_setting($row);

		return $row;
	}

	protected function _check_setting(&$row)
	{
		if ($row->key == 'defaultLanguage') {
			$row->value = $this->_check_language($row->value);
		}
	}

	protected function _check_language($language = NULL)
	{
		$languageModel = model('webadmin/languageModel');

		if ($language) {
			$languages = $languageModel->get(array('name' => $language));

			if ($languages->numRows() > 0) {
				return $language;
			}
		}

		$languages = $languageModel->get(NULL, NULL, NULL, 'name');

		return $languages->row()->name;
	}

}
