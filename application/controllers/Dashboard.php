<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Dashboard extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 19:22:13
	**/

	function __construct(){
		parent::__construct();

	}

	public function index(){
		// Identitas halaman
		$this->global_data['active_menu'] = "dashboard";
		$this->global_data['title'] = "Dashboard";
		$this->global_data['description'] = "Dashboard";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Dashboard',
			'link'	=> site_url('dashboard')
		);

		$this->tampilan('dashboard');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth','refresh');
	}

}