<?php 
namespace App\Controllers\Website;

use App\Controllers\Website\Main;

class Search extends Main
{
	public function __construct()
	{
		$this->className  = strtolower(__CLASS__);
		$this->classTitle = lang('Search');

		parent::__construct();
	}

	public function index()
	{
		$webConfig = config('Website');
		$searchStr = $this->request->getVar('search', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

		if ($searchStr) {
			$contents = $this->contentModel
				->where([
					'content.languageID' => $this->data['languageID'],
					'content.placeType'  => 2,
					'content.publish'    => true,
					])
				->like('content.text', $searchStr)
				->findAll();

			if ($contents) {
				print_r($contents[0]->text);
			} else {
				echo lang('Website.noSearchResult');
			}
			$this->data['places']        = $places;
			$this->data['searchStr']     = $searchStr;
			$this->data['websiteConfig'] = config('Website');

			return view('website/search', $this->data);
		} else {
			return 'No results';
		}
	}
}