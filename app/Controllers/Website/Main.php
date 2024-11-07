<?php 
namespace App\Controllers\Website;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use App\Models\LanguageModel;
use App\Models\PlaceModel;
use App\Models\SubcategoryModel;

class Main extends BaseController
{
	public $data;
	public $message;
	public $className;
	public $classTitle;

	public $contentModel;
	public $languageModel;
	public $placeModel;
	public $subcategoryModel;

	public $subDir;
	public $subPath;
	public $contName;
	public $contURL;
	public $contPath;
	public $classModel;
	public $modelPath;
	public $viewPath;

	public function __construct()
	{
		$this->contentModel     = new ContentModel();
		$this->languageModel    = new LanguageModel();
		$this->placeModel       = new PlaceModel();
		$this->subcategoryModel = new SubcategoryModel();

		$this->data['headView'] = 'website/head';
		$this->data['footView'] = 'website/foot';
		
		$this->setClassInfo();
		$this->getLanguage();
	}

	protected function setClassInfo()
	{
		// Subdirectory Ex: webadmin
		$this->subDir		= 'website';
		
		// Subdirectory Path Ex: webadmin/
		$this->subPath		= $this->subDir.'/';
		
		// Controller Name Ex: webadmin/content
		$this->contName	= $this->subPath.$this->className;
		
		// Controller URL Ex: /webadmin/content/
		$this->contURL		= '/'.$this->contName.'/';
		
		// Controller Path Ex: webadmin/content/
		$this->contPath	= $this->contName.'/';
		
		// Class Model Name Ex: content_model
		$this->classModel	= $this->className.'_model';
		
		// Class Model Path Ex: webadmin/content_model
		$this->modelPath	= $this->subPath.$this->classModel;
		
		// View Path Ex: webadmin/content/
		$this->viewPath	= $this->subPath.$this->className.'/';
		
		// List Sort On Ex: name
		// $this->sort_on		= $this->session->userdata('sort_on');
		// $this->sort_order	= $this->session->userdata('sort_order');

		$this->data['subDir']     = $this->subDir;
		$this->data['subPath']    = $this->subPath;
		$this->data['className']  = $this->className;
		$this->data['contName']   = $this->contName;
		$this->data['contURL']    = $this->contURL;
		$this->data['contPath']   = $this->contPath;
		$this->data['classModel'] = $this->classModel;
		$this->data['modelPath']  = $this->modelPath;
		$this->data['viewPath']   = $this->viewPath;

		// $this->data['sort_on'] 		= $this->sort_on;
		// $this->data['sort_order'] 	= $this->sort_order;
	}

	protected function getLanguage()
	{
		helper('cookie');

		// if (get_cookie('languageID') == 1) set_cookie('languageID', 2);

		$this->data['languageID'] = get_cookie('languageID', TRUE);

		if ( ! $this->data['languageID'])
		{
			$this->data['languageID'] = $this->checkLanguage(getenv('defaultLanguage'));
			$this->setLangCookie();
		}

		if ( ! $this->data['languageID'])
		{
			$this->data['languageID'] = $this->checkLanguage();
			$this->setLangCookie();
		}
	}

	protected function setLanguage()
	{
		$languageID = $this->request->uri->getSegment(3);

		$languages = $this->languageModel->find($languageID);

		if ($languages->num_rows() > 0)
		{
			$this->data['languageID'] = $languageID;
		}
		else
		{
			$this->data['languageID'] = $this->checkLanguage();
		}

		$this->setLangCookie();
		
		return ;
	}

	protected function checkLanguage($languageID = NULL)
	{
		if ($languageID)
		{
			$languages = $this->languageModel->where('id', $languageID)->find();

			if ($languages)
			{
				return $languageID;
			}
		}

		$languageID = $this->languageModel->first()->id;

		return $languageID;
	}

	protected function setLangCookie()
	{
		$cookie = array(
		   'name'     => 'languageID',
		   'value'    => (string)$this->data['languageID'],
		   'path' 	  => '/',
		   'expire'   => strtotime('+7 days'),
		   );
		set_cookie($cookie);
	}

	protected function setMessage($message, $type = 'danger')
	{
		$this->message[$type][] = $message;

		return;
	}
}
