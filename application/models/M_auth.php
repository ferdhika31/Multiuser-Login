<?php if ( ! defined('BASEPATH')) exit('Alag siah!');

class M_auth extends CI_Model {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 18:23:35
	**/

	function __construct(){
		parent::__construct();
		$this->user = 'user';
		$this->user_group = 'user_group';
	}

	public function masuk($login=array()){
		$query = $this->db->join($this->user_group,$this->user_group.'.user_group_id='.$this->user.'.user_group_id');
		$query = $this->db->get_where($this->user,array('username'=>$login['username'],'password'=>md5($login['password'])));
		$query = $query->result_array();
		
		if($query){
			return $query[0];	
		}
	}

	public function ambilSatuUser($where=array()){
		$query = $this->db->join($this->user_group,$this->user_group.'.user_group_id='.$this->user.'.user_group_id');
		$query = $this->db->get_where($this->user,$where);
		$query = $query->result_array();
		
		if($query){
			return $query[0];	
		}
	}
}