<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengaturan extends CI_Model {

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2015-07-02 22:39:05
	**/
	
	function __construct(){
		// parent::__construct();
		// session_start();
		$dt = $this->db->get("pengaturan");
		$i = 1;
		foreach($dt->result() as $d){
			$_SESSION['konfig_app_'.$i] = $d->setting_value;
			$_SESSION[$d->setting_tipe] = $_SESSION['konfig_app_'.$i];
			$i++;
		}

		//ckeditor admin
		// $this->sesi  = $this->session->userdata('isLogin_admin');
		// $this->hak = $this->session->userdata('stat');

		// if($this->sesi != TRUE){
		// 	$_SESSION['ses_admin']="";
		// 	$_SESSION['KCFINDER']=array();
		// 	$_SESSION['KCFINDER']['disabled'] = true;
		// 	$_SESSION['KCFINDER']['uploadURL'] = "../images/konten_upload";
		// }else{
		// 	$_SESSION['ses_admin']="admin";
		// 	$_SESSION['KCFINDER']=array();
		// 	$_SESSION['KCFINDER']['disabled'] = false;
		// 	$_SESSION['KCFINDER']['uploadURL'] = "../images/konten_upload";	
		// 	$_SESSION['KCFINDER']['theme'] = "default";
		// }
	}

	public function ambil(){
		$query = $this->db->get('pengaturan');
		$query = $query->result_array();
		return $query;
	}

	public function ubah($data = array(),$idna=array()){
        $this->db->where($idna);
        $this->db->update('pengaturan',$data);
    }

}