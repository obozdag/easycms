<?php 
namespace App\Controllers\Website;

use App\Controllers\Website\Main;

class Content extends Main
{
	public function __construct()
	{
		$this->className  = strtolower(__CLASS__);
		$this->classTitle = lang('Content');

		parent::__construct();
	}

	public function index(string $id)
	{
		$page      = 'onContent';
		$contentID = $id;

		$content = $this->contentModel
			->where([
				'content.id'      => $contentID,
				'content.publish' => true,
				])
			->findAll();

		if ( ! $content) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$places = $this->placeModel
			->where([
				'place.'.$page  => true,
				'place.publish' => true,
				])
			->findAll();

		foreach ($places as $place) {
			if ($place->type == 'main') {
				$subcategories = $this->subcategoryModel
					->where([
						'subcategory.id'       => $content[0]->subcategoryID,
						'subcategory.placeID'  => $place->id,
						'subcategory.'.$page   => true,
						'subcategory.publish'  => true,
						])
					->findAll();

				foreach ($subcategories as $subcategory) {
					$subcategory->contents = $content;
				}
			} else {
				$subcategories = $this->subcategoryModel
					->where([
						'subcategory.placeID' => $place->id,
						'subcategory.'.$page  => true,
						'subcategory.publish' => true,
						])
					->findAll();

				foreach ($subcategories as $subcategory) {
					$subcategory->contents = $this->contentModel
						->where([
							'subcategoryID'  => $subcategory->id,
							'languageID'     => $this->data['languageID'],
							'content.'.$page => true,
							])
						->findAll();
				}
			}

			$place->subcategories = $subcategories;
		}

		$this->data['places'] = $places;
		$this->data['websiteConfig'] = config('Website');

		return view('website/content', $this->data);
	}
}