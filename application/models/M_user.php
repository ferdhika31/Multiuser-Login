<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_user extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 20:19:47
	**/

	function __construct(){
		parent::__construct();
		$this->user = 'user';
		$this->user_group = 'user_group';
	}

	public function getAllUser(){
		$query = $this->db->where_not_in('username', $this->session->userdata('uname'));
		$query = $this->db->get($this->user);
        $query = $query->result_array();

        return $query;
	}

	public function getAllUserPer($awal="",$akhir=""){
		$query = $this->db->where_not_in('username', $this->session->userdata('uname'));
		$query = $this->db->join($this->user_group, $this->user_group.'.user_group_id='.$this->user.'.user_group_id');
		$query = $this->db->get($this->user,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function getOneUser($kondisi=array()){
		$query = $this->db->where($kondisi);
		$query = $this->db->join($this->user_group, $this->user_group.'.user_group_id='.$this->user.'.user_group_id');
		$query = $this->db->get($this->user);
        $query = $query->result_array();

        if(!empty($query)){
        	return $query[0];
        }
	}

	public function add($data=array()){
		$query = $this->db->insert($this->user,$data);
		$query = $this->db->insert_id();
		return $query;
	}

	public function edit($data=array(),$idna=array()){
		$query = $this->db->update($this->user,$data,$idna);
		return $query;	
	}

	public function remove($where=array()){
		$query = $this->db->delete($this->user,$where);
		return $query;
	}

}