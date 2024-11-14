<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{

	public $class_name;
	public $class_table;
	public $class_title;

	public function __construct()
	{
		parent::__construct();
	}

	function _select()
	{
	}

	function _join()
	{
	}

	function _order()
	{
		$this->db->order_by('modified DESC');
	}

	function where($db_search_options)
	{
		if (is_string($db_search_options))
		{
			$this->db->where($db_search_options, NULL, FALSE);

			return;
		}

		if (is_array($db_search_options))
		{
			if (isset($db_search_options['like']))
			{
				foreach ($db_search_options['like'] as $key => $val)
				{
					if ($val)
					$this->db->like($key, $val);
				}
			}

			if (isset($db_search_options['where']))
			{
				foreach ($db_search_options['where'] as $key => $val)
				{
					if ($val)
					$this->db->where($key, $val);
				}
			}
		}
	}

	function row_array($select = TRUE, $search_options = NULL, $fields = array('id', 'name'))
	{
		$row_array = array();
		
		if (is_array($select)) $row_array = $select;
		if ($search_options) $this->where($search_options);

		$rows = $this->db
			->select($fields)
			->order_by('name')
			->get($this->class_table);

		if ($rows->num_rows())
		{
			if ($select === TRUE) $row_array[''] = $this->class_title.' seçiniz';

			foreach($rows->result() as $row)
			{
				$row_array[$row->id] = $row->name;
			}
		}

		return $row_array;
	}

	function count($search_options = NULL)
	{
		if ($search_options) $this->where($search_options);

		$this->_join();

		$row_count = $this->db
			->count_all_results($this->class_table);

		return $row_count;
	}

	function get($search_options = NULL, $offset = NULL, $limit = 25, $order_by = NULL)
	{
		$this->_join();
		$this->_select();
		$this->_order();

		if ($search_options) $this->where($search_options);
		if ($order_by == 'name') $this->db->order_by($this->class_table.'.'.$order_by);
		if ($limit) $this->db->limit($limit);
		if ($offset) $this->db->limit($limit, $offset);

		$rows = $this->db
			->get($this->class_table);

		return $rows;
	}

	function insert($row)
	{
		$insert_result = $this->db->insert($this->class_table, $row);

		return $insert_result;
	}

	function update($row, $id)
	{
		$this->db->where('id', $id);

		return $this->db->update($this->class_table, $row);
	}

	function delete($id)
	{
		$this->db->where('id', $id);

		return $this->db->delete($this->class_table);
	}
}
