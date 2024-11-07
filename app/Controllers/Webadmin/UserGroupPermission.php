<?php namespace App\Controllers\Webadmin;

use App\Controllers\Webadmin\Main;

class UserGroupPermission extends Main
{
	protected function rules($function = 'insert')
	{
		if ($function == 'insert')
		{
			$this->form_validation->set_rules('name', 'Grup İzin Adı', "required|trim|is_unique[$this->class_name.name]");
			$this->form_validation->set_rules('title', 'Açıklama', 'trim');
		}
		else
		{
			$this->form_validation->set_rules('id', 'Grup İzin No', 'required|trim');
			$this->form_validation->set_rules('name', 'Grup İzin Adı', 'required|trim');
			$this->form_validation->set_rules('title', 'Açıklama', 'trim');

			if ($this->input->post('name') != $this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Grup İzin Adı', "required|trim|is_unique[$this->class_name.name]");
			}
		}
	}

	protected function make($function = 'insert')
	{
		$this->new_row = new stdClass();

		if (in_array($function, array('edit', 'copy')))
		{
			$this->new_row->id 			= $this->input->post('id');
		}
		else
		{
		}

		$this->new_row->name 			= $this->input->post('name');
		$this->new_row->title 			= $this->input->post('title');
	}

	public function delete()
	{
		$this->fkl_auth->check_perm($this->cont_path.__FUNCTION__);

		$id = $this->uri->segment(4);

		if($id)
		{
			$this->load->model('user_group_permission_model');
			$count = $this->user_group_permission_model->get_user_groups_permissions(array('where' => array('user_groups_permissions.permission_id' => $id)))->num_rows();

			if($count == 0)
			{
				$delete_result = $this->user_group_permission_model->delete($id);
				$message = ($delete_result) ? '<p class="alert alert-success">' . $id . ' numaralı kayıt silindi.</p>' : '<p class="alert alert-danger">Hata! Kayıt silinemedi.</p>';
			}
			else
			{
				$message = '<p class="alert alert-danger">Bu izin gruplara verilmiş. Tüm izinler silinmeden kullanıcı grubu izni silinemez.</p>';
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
