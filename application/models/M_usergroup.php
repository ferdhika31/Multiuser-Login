<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_usergroup extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-24 20:49:28
	**/

	function __construct(){
		parent::__construct();
		$this->user_group = 'user_group';
	}

	public function getAll($ord='asc'){
		$query = $this->db->order_by('user_group_id',$ord);
		$query = $this->db->get($this->user_group);
        $query = $query->result_array();

        return $query;
	}

	public function getOneBy($where=array()){
		$query = $this->db->get_where($this->user_group,$where);
        $query = $query->result_array();

        if(!empty($query)){
        	return $query[0];
        }
	}

	public function tambah($data=array()){
		$query = $this->db->insert($this->user_group,$data);
		return $query;
	}

	public function ubah($data=array(),$idna=array()){
		$query = $this->db->update($this->user_group,$data,$idna);
		return $query;	
	}

	public function hapus($where=array()){
		$query = $this->db->delete($this->user_group,$where);
		return $query;
	}
}