<?php
namespace App\Controllers\Webadmin;

use App\Controllers\BaseController;
use App\Controllers\Webadmin\Main;

class Home extends Main
{
	public function getIndex()
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');

		$this->data['leftView']   = 'webadmin/home/control';
		$this->data['centerView'] = 'webadmin/home/list';

		return view('webadmin/main', $this->data);
	}

	public function backup()
	{
		$this->fkl_auth->check_perm($this->cont_path.__FUNCTION__);

		$this->load->dbutil();

		$prefs = array(
			'tables' 	=> $this->config->item('tables_to_backup'),
			'format'		=> 'zip',
			'add_drop'	=> FALSE
		);

		$backup = $this->dbutil->backup($prefs);

		$this->load->helper('download');
		force_download(date('Y_m_d_H_i_s').'.sql.zip', $backup);
	}
}
