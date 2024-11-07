<?php
namespace App\Controllers\Website;

use App\Controllers\Website\Main;

class Home extends Main
{
	public function index()
	{
		$page = 'onHomepage';
		$places = $this->placeModel
			->where([
				'place.'.$page  => true,
				'place.publish' => true,
				])
			->findAll();

		foreach ($places as $place) {
			$subcategories = $this->subcategoryModel
				->where([
					'subcategory.'.$page  => true,
					'placeID'             => $place->id,
					'subcategory.publish' => true,
					])
				->findAll();

			foreach ($subcategories as $subcategory) {
				$subcategory->contents = $this->contentModel
					->where([
						'subcategoryID'      => $subcategory->id,
						'content.'.$page     => true,
						'languageID'         => $this->data['languageID'],
						'content.publish'    => true,
						])
					->findAll();
			}

			$place->subcategories = $subcategories;
		}

		$this->data['places'] = $places;
		
		return view('website/home', $this->data);
	}

	public function ajaxContact()
	{
		if ($this->request->getPost('submitContact') && ! $this->request->getPost('message')) {
			$emailResult = $this->emailContactForm();

			if ($emailResult) {
				$this->data['message'] = '<h3 class="alert alert-success">'.lang('Website.contactMessageReceived').'</h3>';
			} else {
				$this->data['message'] = '<h3 class="alert alert-danger">'.lang('Website.contactMessageFailed').'</h3>';
			}

			echo $this->data['message'];
		}
	}

	protected function emailContactForm()
	{
		$name         = $this->request->getPost('name');
		$email        = $this->request->getPost('email');
		$message      = $this->request->getPost('hmessage');
		$date         = date('d-m-Y H:i:s');
		$ip           = $this->request->getIPAddress();
		$emailMessage = "
			<p><b>Ad Soyad:</b> $name</p>\n
			<p><b>Email:</b> $email</p>\n
			<p><b>Mesaj:</b> $message</p>\n
			<p><b>Tarih:</b> $date</p>\n
			<p><b>IP:</b> $ip</p>\n
			";

		$email = \Config\Services::email();
		$email->setFrom(env('email.websiteEmail'), lang('Website.emailFrom'));
		$email->setTo(env('email.websiteEmail'));
		$email->setSubject(env('website.websiteName') .' '. lang('Website.emailSubject'));
		$email->setMessage($emailMessage);

		$result = $email->send();

		return $result;
	}
}
