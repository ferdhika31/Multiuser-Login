<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_userpage extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-24 21:05:54
	**/

	function __construct(){
		parent::__construct();
		$this->user_page = 'user_page';
	}

	public function getAll($ord='asc'){
		$query = $this->db->order_by('user_page_id',$ord);
		$query = $this->db->get($this->user_page);
        $query = $query->result_array();

        return $query;
	}

	public function getAllPer($awal="",$akhir=""){
		// $query = $this->db->order_by('user_page_id',$ord);
		$query = $this->db->get($this->user_page,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function getOneBy($where=array()){
		$query = $this->db->get_where($this->user_page,$where);
        $query = $query->result_array();

        if(!empty($query)){
        	return $query[0];
        }
	}

	public function tambah($data=array()){
		$query = $this->db->insert($this->user_page,$data);
		return $query;
	}
	
	public function ubah($data=array(),$idna=array()){
		$query = $this->db->update($this->user_page,$data,$idna);
		return $query;	
	}

	public function hapus($where=array()){
		$query = $this->db->delete($this->user_page,$where);
		return $query;
	}
}