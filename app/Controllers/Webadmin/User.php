<?php
namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;
use CodeIgniter\Shield\Entities\User as Userm;

class User extends Main
{
	public function index() {
		$users = auth()->getProvider();
		$user  = $users->findById(1);
		dd($user->getIdentities());
	}
	protected function rules($function = 'insert')
	{
		if ($function == 'insert')
		{
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
		}
		else
		{
			$this->form_validation->set_rules('id', 'Kullanıcı No', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

			if ($this->input->post('email') != $this->input->post('old_email'))
			{
				$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
			}
		}

		$this->form_validation->set_rules('first_name', 'Ad', 'trim');
		$this->form_validation->set_rules('last_name', 'Soyad', 'trim');
		$this->form_validation->set_rules('publish', 'Yayın', 'trim');
	}

	protected function make($function = 'insert')
	{
		$this->new_row 		= new stdClass();

		if (in_array($function, array('edit', 'copy')))
		{
			$this->new_row->id 			= $this->input->post('id');
			$this->new_row->modified 	= date('Y-m-d H:i:s');
		}
		else
		{
			$this->new_row->inserted	= date('Y-m-d H:i:s');
			$this->new_row->modified 	= date('Y-m-d H:i:s');
		}

		$this->new_row->email 			= $this->input->post('email');
		$this->new_row->first_name 		= $this->input->post('first_name');
		$this->new_row->last_name 		= $this->input->post('last_name');
		$this->new_row->publish 		= (int) $this->input->post('publish');
		$this->new_row->groups 			= $this->input->post('groups');

		if ($this->input->post('password'))
		{
			$this->new_row->password 	= sha1($this->input->post('password'));
		}
	}

	public function delete(int $id)
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');

		$id  = $this->request->getUri()->getSegment(4);
		$row = $this->{$this->classModel}->find($id);

		if ($row)
		{
			$dependent_class_name = 'content';
			$dependent_class_title = 'İçerik';

			$this->load->model('webadmin/'.$dependent_class_name.'_model');
			$dependent_count = $this->{$dependent_class_name.'_model'}->count(array('where' => array($dependent_class_name.'.inserter' => $id)));

			if($dependent_count == 0)
			{
				$delete_result = $this->{$this->class_name.'_model'}->delete($id);
				$message = ($delete_result) ? '<p class="alert alert-success">' . $id . ' numaralı kayıt silindi.</p>' : '<p class="alert alert-danger">Hata! Kayıt silinemedi.</p>';
			}
			else
			{
				$message = '<p class="alert alert-danger">'.$this->class_title.' bağlantılı '.$dependent_class_title.' silinmeden '.$this->class_title.' silinemez.</p>';
			}
		}
		else
		{
			$message = '<p class="alert alert-danger">'.$this->lang->line('webadmin_check_no').'</p>';
		}

		$this->session->set_flashdata('message', $message);

		redirect('webadmin/'.$this->class_name.'/get');
	}
}
