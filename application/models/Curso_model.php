<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Curso_model extends CI_Model{

	protected $table_name = 'curso';
	protected $primary_key = 'id';

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function obtener($id) {
		return $this->db->get_where($this->table_name, array($this->primary_key => $id))->row();
	}


	public function obtener_todos($fields = '', $where = array()) {
		$data = array();
		if ($fields != '') {
			$this->db->select($fields);
		}

		if (count($where)) {
			$this->db->where($where);
		}

		$Q = $this->db->get($this->table_name);

		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();

		return $data;
	}

	public function insertar($data) {
		// $data['creado'] = $data['modificado'] = date('Y-m-d H:i:s');

		$success = $this->db->insert($this->table_name, $data);
		if ($success) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function actualizar($data, $id) {
		// $data['modificado'] = date('Y-m-d H:i:s');

		$this->db->trans_start();
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
		$this->db->trans_complete();

		return $this->db->trans_status();

	}

	public function eliminar($id) {
		$this->db->where($this->primary_key, $id);

		return $this->db->delete($this->table_name);
	}

	function existe($key, $value)
	{
		$this->db->where($key, $value);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}
