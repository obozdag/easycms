<?php 
namespace App\Controllers\Website;

use App\Controllers\Website\Main;

class Subcategory extends Main
{
	public function __construct()
	{
		$this->className 	= strtolower(__CLASS__);
		$this->classTitle	= lang('Subcategory');

		parent::__construct();
	}

	public function index(string $id)
	{
		$page          = 'onSubcategory';
		$subcategoryID = $id;

		$subcategory = $this->subcategoryModel
			->where([
				'subcategory.id'      => $subcategoryID,
				'subcategory.publish' => true,
				])
			->findAll();

		if ( ! $subcategory) {
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
							'subcategory.id'       => $subcategoryID,
							'subcategory.placeID'  => $place->id,
							'subcategory.'.$page   => true,
							'subcategory.publish'  => true,
							])
						->findAll();
	
					foreach ($subcategories as $subcategory) {
						$subcategory->contents = $this->contentModel
							->where([
								'subcategoryID'  => $subcategoryID,
								'languageID'     => $this->data['languageID'],
								'content.'.$page => true,
								])
							->findAll();
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
								'subcategoryID'  => $subcategoryID,
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
	
			return view('website/subcategory', $this->data);

			// foreach ($places as $place) {
			// if ($place->type == 'main') {
			// 	$subcategories = $this->subcategoryModel->where('placeID', $place->id)->where('subcategory.'.$page_type, 1)->where('subcategory.id', $subcategoryID)->findAll();

			// 	if (empty($subcategories)) {
			// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			// 	}

			// 	foreach ($subcategories as $subcategory) {
			// 		$subcategory->contents = $this->contentModel->where('subcategoryID', $subcategory->id)->where('content.'.$page_type, 1)->where('languageID', $this->data['languageID'])->findAll();
			// 	}
			// } else {
			// 	$subcategories = $this->subcategoryModel->where('subcategory.placeID', $place->id)->where('subcategory.'.$page_type, 1)->findAll();

			// 	foreach ($subcategories as $subcategory) {
			// 		$subcategory->contents = $this->contentModel->where('subcategoryID', $subcategory->id)->where('content.'.$page_type, 1)->where('languageID', $this->data['languageID'])->findAll();
			// 	}
			// }

			// $place->subcategories = $subcategories;
		// }
	}
}
