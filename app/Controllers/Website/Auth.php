<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	protected $data;
	private $class_name;
	private $class_title;

	function __construct()
	{
		parent::__construct();

		$this->class_name = strtolower(__CLASS__);
		$this->class_title = 'Web Sitesi Giriş';

		$this->load->model(array(
			'webadmin/user_model',
			'webadmin/config_model'
			));

		$this->config_model->load_config();

		$this->load->library(array(
			'form_validation',
			'fkl_auth'
			));

		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');

		$this->data['class_name'] 	= $this->class_name;
		$this->data['class_title'] 	= $this->class_title;
		$this->data['message'] 		= $this->session->flashdata('message');
		$this->data['head_view'] 	= 'webadmin/head';
		$this->data['header_view'] 	= 'webadmin/header';
		$this->data['left_view'] 	= '';
		$this->data['footer_view'] 	= 'webadmin/footer';
		$this->data['foot_view'] 	= 'webadmin/foot';
	}

	function index()
	{
		$this->login();
	}

	function login()
	{
		if ($this->fkl_auth->logged_in())
		{
			$referer = ($this->session->userdata('referer')) ? $this->session->userdata('referer') : 'website';

			redirect($referer);
		}

		if ($this->input->post('login'))
		{
			if ($this->form_validation->run() == TRUE)
			{
				$email 		= $this->input->post('email');
				$password 	= $this->input->post('password');
				$pass 		= sha1($password);

				$users = $this->user_model->get(array('email' => $email, 'password' => $pass));

				if ($users->num_rows() > 0)
				{
					$user = $users->row();
					$user_data = array(
						'user_id' 		=> $user->id,
						'user_email' 	=> $user->email,
						'user_groups'	=> array_keys($user->groups)
					);

					$this->session->set_userdata($user_data);
					$referer = ($this->session->userdata('referer')) ? $this->session->userdata('referer') : 'website';

					redirect($referer);
				}
				else
				{
					$this->session->set_flashdata('message', '<p class="error">Kullanıcı bulunamadı!</p>');

					redirect('auth/login');
				}
			}
			else
			{
				$this->data['message'] = validation_errors();
			}
		}

		$login_content_id = $this->config->item('login_content_id');

		redirect('website/content/'.$login_content_id);

	}

	function logout()
	{
		$user_data = array(
			'user_id',
			'user_email',
			'user_groups'
		);

		$this->session->unset_userdata($user_data);

		redirect('website/auth/login');
	}

	function insert()
	{
		if($this->input->post('submit_save') == 'cancel')
		{
			$this->login();
			return;
		}

		if($this->input->post('submit_save') == 'insert')
		{
			if($this->form_validation->run() == TRUE)
			{
				$this->make();
				$insert_result = $this->user_model->insert($this->new_row);
				$this->session->set_flashdata('message', ($insert_result) ? '<p class="info">Kayıt eklendi.</p>' : '<p class="error">Hata! Kayıt eklenemedi.</p>');

				redirect('website/auth/login');
			}
			else
			{
				$this->data['message'] = validation_errors();
			}
		}

		$this->data['function'] 		= 'insert';
		$this->data['left_view'] 		= 'website/auth/insert_info';
		$this->data['center_view'] 		= 'website/auth/insert';

		$this->load->view('website/main', $this->data);
	}

	function check_email($email)
	{
		if ($this->user_model->count(array('email' => $email)))
		{
			$this->form_validation->set_message('check_email', 'Bu <b>email</b> adresi zaten kayıtlı.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function make()
	{
		$this->new_row 		= new stdClass();

		$this->new_row->ip_address	 	= $this->input->ip_address();
		$this->new_row->email 			= $this->input->post('email');
		$this->new_row->first_name 		= $this->input->post('first_name');
		$this->new_row->last_name 		= $this->input->post('last_name');
		$this->new_row->company		 	= $this->input->post('company');
		$this->new_row->phone		 	= $this->input->post('phone');
		$this->new_row->password 		= sha1($this->input->post('password'));
		$this->new_row->groups 			= array(1);
	}

}
