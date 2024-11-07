<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestbook extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('pagination');
		$this->load->helper('form');
	}

	function index()
	{
		if ($this->input->post('submit_guest_book'))
		{
			$guest_book = $this->make_guest_book();
			$this->check_guest_book();

			if ($this->form_validation->run() == FALSE)
			{
				$this->data['message'] = validation_errors();
			}
			else
			{
				$insert_result = $this->website_model->insert_guest_book($guest_book);

				if ($insert_result)
				{
					$this->data['message'] = "<p class='message'>Sayın $guest_book->name mesajınız alındı. Editörün onayından sonra yayınlanacaktır.</p>";
					$this->set_guest_book_time_cookie();
				}
				else
				{
					$this->data['message'] = "<p class='message'>Bir hata oluştu. Mesajınız alınamadı. Lütfen tekrar deneyiniz.</p>";
				}
			}
		}

		$this->make_captcha();
		$where								= 'publish = 1';
		$offset								= $this->uri->segment(3);
		$per_page							= 25;
		$base_url							= '/guestbook';
		$total_rows							= $this->website_model->count_guest_book($where);
		$this->data['guest_book_records']	= $this->website_model->list_guest_book($where, $per_page, $offset);
		
		$center_contents			= array();
		$center_content				= new stdClass();
		$center_content->type_id	= 2;
		$center_content->info		= FALSE;
		$center_content->text		= $this->load->view('website/guestbook', $this->data, true);
		$center_contents[]			= $center_content;

		$config['total_rows']				= $total_rows;
		$config['base_url']					= $base_url;
		$this->pagination->initialize($config);

		$this->set_page($center_contents);
	}

	function set_page($center_contents = NULL)
	{
		$page = 'on_content';

		$places = $this->website_model->get_place($page);

		foreach ($places->result() as $place)
		{
			if ($place->type_id == 2)
			{
				$subcategories = $this->website_model->get_subcategory($place->id, $page);

				foreach ($subcategories->result() as $subcategory)
				{
					// var_dump($subcategory);
					if ($subcategory->name == "System")
						$subcategory->contents = $center_contents;
					else
						$subcategory->contents = NULL;
				}
			}
			else
			{
				$subcategories = $this->website_model->get_subcategory($place->id, $page);

				foreach ($subcategories->result() as $subcategory)
				{
					$subcategory->contents = $this->website_model->get_content($subcategory->id, '', $this->data['language_id'])->result();
				}
			}

			$place->subcategories = $subcategories->result();
		}

		$this->data['places'] = $places;
		$this->load->view('website/content', $this->data);
	}

	function make_captcha()
	{
		$this->load->helper('captcha');
		$this->load->helper('array');
		$vals = array(
			'img_path' => './media/captcha/',
			'img_url' => '/media/captcha/',
			'font_path' => './media/texb.ttf',
			'word' => random_element($this->config->item('captcha_words'))
			);

		$captcha = create_captcha($vals);
		$cap_data = array(
			'captcha_time' => $captcha['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $captcha['word']
			);
		$this->data['captcha_image'] = $captcha['image'];
		$this->website_model->delete_captcha_by_ip($this->input->ip_address());
		return $this->website_model->insert_captcha($cap_data);
	}

	function check_captcha()
	{
		$expiration = time()-7200; // Two hour limit
		$this->website_model->delete_captcha($expiration);

		$captchas = $this->website_model->count_captcha($this->input->post('captcha'), $this->input->ip_address(), $expiration);

		if ($captchas == 0)
		{
			$this->form_validation->set_message('check_captcha', '<p class="message">Lütfen resimde görünen karakterleri doğru yazınız.</p>');
			return false;
		}

		return true;
	}

	function set_guest_book_time_cookie()
	{
		$guestBookTime = date('Y-m-d H:i:s', time());
		$cookie = array(
		   'name'   => 'guestBookTime',
		   'value'  => $guestBookTime,
		   'expire' => '600',
		   'path'  => '/'
		   );
		set_cookie($cookie);
	}

	function check_guest_book_time_cookie()
	{
		$guestBookTime = get_cookie('guestBookTime', TRUE);

		if ($guestBookTime)
		{
			return TRUE;
		}

		return FALSE;
	}

	function make_guest_book()
	{
		$guest_book = new stdClass();
		$guest_book->name = $this->input->post('name');
		$guest_book->email = $this->input->post('email');
		$guest_book->message = $this->input->post('message');
		$guest_book->created = date('Y-m-d H:i:s', time());
		$guest_book->ip = $this->input->ip_address();
		return $guest_book;
	}

	function check_guest_book()
	{
		$this->form_validation->set_rules('name', 'Ad Soyad', 'required');
		$this->form_validation->set_rules('email', 'Eposta', 'required');
		$this->form_validation->set_rules('message', 'Mesaj', 'required');
		$this->form_validation->set_rules('captcha', 'Kod', 'required|callback_check_captcha');
	}

	function email_guest_book($guest_book)
	{
		$name = $guest_book->name;
		$email = $guest_book->email;
		$message = $guest_book->message;
		$date = date('d-m-Y', strtotime($guest_book->created));
		$ip = $guest_book->ip;

		$email_headers = 'Content-Type: text/html; Charset=UTF-8'."\r\n";
		$email_headers .= "From: $email "."\r\n";
		$email_to = $this->config->item('website_email');
		$email_subject = 'Mesaj Formu';
		$email_message = "
			<p><b>Adı Soyadı:</b> $name</p>\n
			<p><b>Eposta:</b> $email</p>\n
			<p><b>IP:</b> $ip</p>\n
			<p><b>Tarih:</b> $date</p>\n
			<p><b>Mesaj:</b> $message</p>\n
		";
		$email_message = wordwrap($email_message, 70);

		return $email_result = mail($email_to, $email_subject, $email_message, $email_headers);
	}

}
