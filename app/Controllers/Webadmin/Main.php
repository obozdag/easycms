<?php
namespace App\Controllers\Webadmin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\SettingModel;
use App\Models\ContentModel;
use App\Models\LanguageModel;
use App\Models\PageModel;
use App\Models\PlaceModel;
use App\Models\PlaceTypeModel;
use App\Models\SubcategoryModel;
use App\Models\VisitModel;

class Main extends BaseController
{
	public $data;
	public $class;
	public $className;
	public $classTitle;

	public $categoryModel;
	public $settingModel;
	public $contentModel;
	public $languageModel;
	public $pageModel;
	public $placeModel;
	public $placeTypeModel;
	public $subcategoryModel;
	public $visitModel;

	public $contUrl;
	public $classModel;
	public $pager;
	public $session;

	public $searchOptions = [];

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		$this->categoryModel      = new CategoryModel();
		$this->settingModel      = new SettingModel();
		$this->contentModel       = new ContentModel();
		$this->languageModel      = new LanguageModel();
		$this->pageModel          = new PageModel();
		$this->placeModel         = new PlaceModel();
		$this->placeTypeModel     = new PlaceTypeModel();
		$this->subcategoryModel   = new SubcategoryModel();
		$this->visitModel         = new VisitModel();

		$this->class              = get_class($this);
		$this->className          = strtolower(str_replace(__NAMESPACE__.'\\', '', get_class($this)));
		$this->contUrl            = '/webadmin/'.$this->className.'/';
		$this->classTitle         = lang('Webadmin.'.$this->className);
		$this->classModel         = $this->className.'Model';
		$this->pager              = \Config\Services::pager();
		$this->session            = session();

		$data = [
			'className'      => $this->className,
			'classTitle'     => $this->classTitle,
			'contUrl'        => $this->contUrl,
			'pager'          => $this->pager,
			'searchOptions' => [],
			'session'        => $this->session,
			'webadminConfig' => config('Webadmin'),
			'editor'         => false,
			'centerView'	  => 'webadmin/list',
			'footView'	     => 'webadmin/foot',
			'footerView'	  => 'webadmin/footer',
			'headView'	     => 'webadmin/head',
			'headerView'	  => 'webadmin/header',
			'leftView'	     => 'webadmin/control',
			'menuView'	     => 'webadmin/menu',
			'editorView'	  => 'webadmin/editor',
		];

		$this->data = $data;

		$this->loadArray();
	}

	protected function make(){}
	
	protected function rules(){}

	protected function initializeSearchOptions()
	{
		if ($this->request->getPost('submitSearch')) {
			foreach ($this->{$this->classModel}->searchFields as $key => $value) {
				var_dump($key, $this->request->getPost(str_replace('search', '', $key)));
				if ( ! empty($this->request->getPost(str_replace('search', '', $key)))) {
					$this->searchOptions[str_replace('search', '', $key)] = $this->request->getPost($key);
				}
			}

			$this->session->set($this->className.'_searchOptions', $this->searchOptions);
		}
	}

	protected function loadArray()
	{
		$this->data['categoryIDArray']    = $this->makeSelect($this->categoryModel->asArray()->select('id, name')->findAll());
		$this->data['languageIDArray']    = $this->makeSelect($this->languageModel->asArray()->select('id, name')->findAll());
		$this->data['placeIDArray']       = $this->makeSelect($this->placeModel->asArray()->select('place.id, place.name')->findAll());
		$this->data['placeTypeArray']     = $this->makeSelect($this->placeTypeModel->asArray()->select('id, name')->findAll());
		$this->data['pageArray']          = $this->makeSelect($this->pageModel->asArray()->select('id, name')->findAll());
		$this->data['subcategoryIDArray'] = $this->makeSelect($this->subcategoryModel->asArray()->select('subcategory.id, subcategory.name')->findAll());
	}

	protected function makeSelect($array)
	{
		$newArray = ['' => ''];

		foreach ($array as $value) {
			$newArray[$value['id']] = $value['name'];
		}

		return $newArray;
	}

	public function index()
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');

		$this->initializeSearchOptions();

		$this->data['rows']         = $this->{$this->classModel}->where($this->searchOptions)->paginate();
		$this->data['searchFields'] = $this->{$this->classModel}->searchFields;
		$this->data['listFields']   = $this->{$this->classModel}->listFields;
		$this->data['commands']     = $this->{$this->classModel}->commands;

		if (sizeof($this->data['rows']) == 0) {
			$this->data['message'] 	= '<div class="alert alert-danger">'.lang('Webadmin.notFound').'</div>';
		}

		$this->data['message'] = $this->session->getFlashData('message') ?? null;

		echo view('webadmin/main', $this->data);
	}

	public function edit(int $id)
	{
		if (! auth()->loggedIn()) return redirect()->to('/login');

		if ($this->request->getPost('submitSave') == 'cancel') {
			return redirect()->to('/webadmin/'.$this->className);
		}

		if ($this->request->getPost('submitSave') == 'edit') {
			if ($this->validate($this->rules('edit'))) {
				$newRow = $this->make('edit');
				$update_result = $this->{$this->classModel}->save($newRow);
				$update_result
					? $this->session->setFlashdata('message', '<div class="alert alert-info">'.lang('Webadmin.modified').' ('.$newRow->id.')</div>')
					: $this->session->setFlashdata('message', '<div class="alert alert-danger">'.lang('Webadmin.not_modified').' ('.$newRow->id.')</div>');

			return redirect()->to('/webadmin/'.$this->className);


			} else {
				$this->data['message'] = '<div class="alert alert-danger">'.$this->validator->listErrors().'</div>';
			}
		}

		$id  = $this->request->getUri()->getSegment(4);
		$row = $this->{$this->classModel}->find($id);

		if (! $row) {
			$this->session->setFlashdata('message', '<div class="alert alert-danger">'.lang('Webadmin.notFound').'</div>');
			
			return redirect()->to('/webadmin/'.$this->className);
		}

		$this->initializeSearchOptions();
		$this->loadArray();
		$data = [
			'row'            => $row,
			'function'       => 'edit',
			'editor'         => true,
			'searchOptions'  => $this->searchOptions,
			'searchFields'   => $this->{$this->classModel}->searchFields,
			'listFields'     => $this->{$this->classModel}->listFields,
			'commands'       => $this->{$this->classModel}->commands,
			'centerView'     => 'webadmin/'. $this->className.'/edit',
		];

		return view('webadmin/main', array_merge($this->data, $data));
	}

	public function insert()
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');

		if ($this->request->getPost('submitSave') == 'cancel') {
			return redirect()->to('/webadmin/'.$this->className);
		}

		$entityName = '\App\Entities\\'.str_replace(__NAMESPACE__.'\\', '', get_class($this));
		$entity = new $entityName;

		if ($this->request->getPost('submitSave') == 'insert') {
			$valid = $this->validateData($this->request->getPost(), $this->rules());
			if ($valid) {
				$newRow = $this->make('insert');
				// $newRow = $entity->fill($this->request->getPost());
				$insert_result = $this->{$this->classModel}->save($newRow);
				$insert_result 
					? $this->session->setFlashdata('message', '<p class="alert alert-info">'.lang('Webadmin.'.$this->className).': '.lang('Webadmin.inserted').'</p>')
					: $this->session->setFlashdata('message', '<p class="alert alert-danger">'.lang('Webadmin.'.$this->className).': '.lang('Webadmin.notInserted').'</p>');

				return redirect()->to('/webadmin/'.$this->className);

			} else {

				$this->data['message'] = '<div class="alert alert-danger">'.$this->validator->listErrors().'</div>';

			}
		}

		$this->initializeSearchOptions();
		$this->loadArray();
		$data = [
			'function'       => 'insert',
			'editor'         => true,
			'searchOptions'  => $this->searchOptions,
			'searchFields'   => $this->{$this->classModel}->searchFields,
			'listFields'     => $this->{$this->classModel}->listFields,
			'commands'       => $this->{$this->classModel}->commands,
			'centerView'     => 'webadmin/'. $this->className.'/edit',
		];

		return view('webadmin/main', array_merge($this->data, $data));
	}

	public function edit_list()
	{
		$this->data['offset']      = $this->uri->segment(4);
		$this->data['count_all']   = $this->{$this->classModel}->count();
		$this->data['count_where'] = $this->{$this->classModel}->count($this->db_searchOptions);
		$config['total_rows']      = $this->data['count_where'];
		$config['base_url']        = site_url($this->contUrl.'get');
		$this->pagination->initialize($config);
		$this->data['rows']        = $this->{$this->classModel}->get($this->db_searchOptions, $this->data['offset'], $this->pagination->per_page);

		if ($this->data['rows']->num_rows() == 0) {
			$this->data['message']  = '<p class="error">'.lang($this->subDir.'_not_found').'</p>';
		}

		$this->loadArray();
		$this->data['function']       = __FUNCTION__;
		$this->data['searchOptions'] = $this->searchOptions;
		$this->data['centerView']    = $this->viewPath.'edit';

		echo view($this->subPath.'main', $this->data);
	}

	public function copy()
	{
		$this->fkl_auth->check_perm($this->contUrl.__FUNCTION__);
		$this->data['where'] = array($this->className.'.id' => $this->uri->segment(4));
		$this->data['rows']  = $this->{$this->classModel}->get(array('where' => $this->data['where']));

		if ($this->data['rows']->num_rows() == 0) {
			$this->data['message'] = '<p class="error">'.lang($this->subDir.'_not_found').'</p>';
		}

		$this->loadArray();
		$this->data['function']      = 'copy';
		$this->data['editor']        = true;
		$this->data['searchOptions'] = $this->searchOptions;
		$this->data['centerView']    = $this->viewPath.'edit';

		echo view($this->subPath.'main', $this->data);
	}

	public function delete(int $id)
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');
		// $this->fkl_auth->check_perm('webadmin/'.$this->class_name.'/delete');

		$id  = $this->request->getUri()->getSegment(4);
		$row = $this->{$this->classModel}->find($id);

		if ($row)
		{
			$child      = $this->{$this->classModel}->child;
			$childModel = $child.'Model';
			$childCount = $child
				? $this->{$childModel}->where(($this->className).'Id', $id)->countAllResults()
				: 0;

			if($childCount == 0)
			{
				$delete_result = $this->{$this->classModel}->delete($id);
				$message = ($delete_result)
					? '<p class="alert alert-info">'.sprintf(lang('Webadmin.'.$this->className).': '.lang('Webadmin.deleted'), $id).'</p>'
					: '<p class="alert alert-danger">'.sprintf(lang('Webadmin.'.$this->className).': '.lang('Webadmin.not_deleted'), $id).'</p>';
			} else {
				$message = '<p class="alert alert-danger">'.sprintf(lang('Webadmin.cantDeleteParent'), lang('Webadmin.'.$this->className), lang('Webadmin.'.$child), lang('Webadmin.'.$this->className)).'</p>';
			}
		} else {
			$message = '<p class="alert alert-danger">'.lang('Webadmin.check_no').'</p>';
		}

		$this->session->setFlashdata('message', $message);

		return redirect()->to('webadmin/'.$this->className);
	}

	public function sort()
	{
		$this->data['sort_class']	= $this->uri->segment(2);
		$this->data['sort_on']		= $this->uri->segment(4);
		$this->data['sort_order']	= 'ASC';
		$sort_class					   = $this->session->userdata('sort_class');
		$sort_on					      = $this->session->userdata('sort_on');

		if (isset($sort_class) AND $this->session->userdata('sort_class') == $this->data['sort_class']) {
			if (isset($sort_on) AND $this->session->userdata('sort_on') == $this->data['sort_on']) {
				$this->data['sort_order'] = ($this->session->userdata('sort_order') == 'ASC') ? 'DESC' : $this->data['sort_order'];
			}
		}

		$this->session->set_userdata('sort_class', $this->data['sort_class']);
		$this->session->set_userdata('sort_on', $this->data['sort_on']);
		$this->session->set_userdata('sort_order', $this->data['sort_order']);
		$this->uri->segments[4] = NULL;
		$this->index();
	}

	public function ajax_update()
	{
		if ($this->request->getPost('id')) {
			if ($this->form_validation->run() == TRUE) {
				$this->make('update');
				$insert_result = $this->{$this->classModel}->update($newRow, $newRow->id);
				$this->data['message'] = ($insert_result) ? '<p class="info">'.lang($this->subDir.'_modified').' ('.$newRow->id.')</p>' : '<p class="error">'.lang($this->subDir.'_not_modified').' ('.$newRow->id.')</p>';
				echo $this->data['message'];
			} else {
				$this->data['message'] = validation_errors();
				echo $this->data['message'];
			}
		}
	}

	public function checkBox(): ?string
	{
		if ( ! auth()->loggedIn()) return redirect()->to('/login');

		$checked = ($this->request->getPost('checked') == 'true') ? 1 : 0;
		$id      = $this->request->getPost('id');
		$name    = $this->request->getPost('name');

		$row = $this->{$this->classModel}->find($id);
		$row->{$name} = $checked;
		$result = $this->{$this->classModel}->save($row);

		if ($result) {
			$message = ($checked) ? sprintf(lang('Webadmin.fieldChecked'), $id, "'".lang('Webadmin.'.$name)."'") : sprintf(lang('Webadmin.fieldUnchecked'), $id, "'".lang('Webadmin.'.$name)."'");
		}
		echo $message;
		
		exit();
	}

	protected function check_edit_unique($field, $table_column)
	{
		list($table, $column) = explode('.', $table_column);
		$value                = $this->request->getPost($column);
		$old_value            = $this->request->getPost('old_'.$column);

		if ($value !== $old_value) {
			$rows = $this->{$this->classModel}->get(array($table_column => $field));

			if ($rows->num_rows() > 0) {
				$this->form_validation->set_message('check_edit_unique', sprintf(lang($this->subDir.'_field_must_unique'), $table_column));

				return FALSE;
			}
		} else {
			return TRUE;
		}
	}
}
