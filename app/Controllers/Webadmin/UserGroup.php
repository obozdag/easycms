<?php namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class UserGroup extends Main
{
	public function insert()
	{
		$user_group_id = $this->uri->segment(4);
		$this->data['user_group_permission_array'] 		= $this->user_group_permission_model->user_group_permission_array();
		$this->data['user_groups_permissions_array'] 	= $this->user_group_permission_model->user_groups_permissions_array();

		parent::insert();
	}

	public function edit()
	{
		$user_group_id = $this->uri->segment(4);
		$this->data['user_group_permission_array'] 		= $this->user_group_permission_model->row_array();
		$this->data['user_groups_permissions_array'] 	= $this->user_group_permission_model->user_groups_permissions_array(NULL, array('where' => array('group_id' => $user_group_id)));

		parent::edit();
	}

	protected function rules($function = 'insert')
	{
		if ($function == 'insert')
		{
			$this->form_validation->set_rules('name', 'Kullanıcı Grubu Adı', 'required|trim|is_unique[user_group.name]');
		}
		else
		{
			$this->form_validation->set_rules('id', 'Kullanıcı Grubu No', 'required|trim');
			$this->form_validation->set_rules('name', 'Kullanıcı Grubu Adı', 'required|trim');

			if ($this->input->post('name') != $this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Kullanıcı Grubu Adı', 'required|is_unique[user_group.name]');
			}
		}

		$this->form_validation->set_rules('permissions[]', 'İzinler', 'trim');
		$this->form_validation->set_rules('publish', 'Yayın', 'trim');
	}

	protected function make($function = 'insert')
	{
		$this->new_row = new stdClass();

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

		$this->new_row->name 			= $this->input->post('name');
		$this->new_row->order 			= (int) $this->input->post('order');
		$this->new_row->publish 		= $this->input->post('publish');
		$this->new_row->permissions 	= $this->input->post('permissions');
	}

	public function delete()
	{
		$this->fkl_auth->check_perm($this->cont_uri.__FUNCTION__);

		$id = $this->uri->segment(4);

		if($id)
		{
			$this->load->model($this->sub_path.'user_model');
			$count = $this->user_model->count(array('where' => array('user.user_group_id' => $id)));

			if($count == 0)
			{
				$delete_result = $this->{$this->model_name}->delete($id);
				$message = ($delete_result) ? '<p class="alert alert-success">' . $id . ' numaralı kayıt silindi.</p>' : '<p class="alert alert-danger">Hata! Kayıt silinemedi.</p>';
			}
			else
			{
				$message = '<p class="alert alert-danger">Bu gruptaki tüm kullanıcılar silinmeden kullanıcı grubu silinemez.</p>';
			}
		}
		else
		{
			$message = '<p class="alert alert-danger">'.$this->lang->line('webadmin_check_no').'</p>';
		}

		$this->session->set_flashdata('message', $message);

		redirect($this->cont_path.'get');
	}
}
