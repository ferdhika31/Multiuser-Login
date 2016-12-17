<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 18:08:36
	**/

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('isLogin')){
			redirect('core/auth');
		}

		// Load model
		$this->load->model('m_auth');

		// Var global
		$this->global_data = array();

		// Asset folder
		$this->global_data['asset'] = base_url('assets').'/';

		// akun info
		$this->global_data['akunInfo'] = $this->m_auth->ambilSatuUser(array('user_id'=> $this->session->userdata('user_id')));

		// Path segment 2 setelah path core
		$this->segement_num = 2;
	}

	protected function tampilan($view_name){
		$url_view = $this->uri->segment($this->segement_num); // 2 setelah path core

		$this->load->view('meta',$this->global_data);
        $this->load->view('header',$this->global_data);
        $this->load->view('menu',$this->global_data);

        if(preg_match("/list/i", $view_name)) {
        	if($this->cekView()){
        		$this->load->view($view_name,$this->global_data);
        	}else{
        		$this->load->view('permission',$this->global_data);
        	}
		}else{
			if($this->cekModif() || $url_view=='dashboard'){
        		$this->load->view($view_name,$this->global_data);
        	}else{
        		$this->load->view('permission',$this->global_data);
        	}
		}

		$this->load->view('footer',$this->global_data);
	}

	protected function cekView(){
		$this->load->model(array('m_usergroup','m_userpage'));

		$this->group_key  = $this->session->userdata('group_key');

		$group = $this->m_usergroup->getOneBy(array('key_name'=>$this->group_key));
		
		$adaw = unserialize($group['permission']);


		foreach ($adaw as $type => $coeg) {
			//View
			if($type=='view'){
				foreach ($coeg as $key => $view_eusi) {
					$page = $this->m_userpage->getOneBy(array('user_page_id'=>$view_eusi));
					// $pagearray = array();
					$pagearray[] = $page['page_url'];
				}	
			}else{
				$pagearray[] = array();
			}
		}

		$url_view = $this->uri->segment($this->segement_num); // 2 setelah path core

		if(in_array($url_view, $pagearray)){
			$view = true;
		}else{
			$view = false;
		}
		
		return $view;
	}

	protected function cekModif(){
		$this->load->model(array('m_usergroup','m_userpage'));

		$this->group_key  = $this->session->userdata('group_key');

		$this->group = $this->m_usergroup->getOneBy(array('key_name'=>$this->group_key));

		$adaw = unserialize($this->group['permission']);

		
		foreach ($adaw as $type => $coeg) {
			//Modif
			if($type=='modif'){
				foreach ($coeg as $key => $modif_eusi) {
					$page = $this->m_userpage->getOneBy(array('user_page_id'=>$modif_eusi));
					// $pagearray = array();
					$pagearray_eusi[] = $page['page_url'];
				}	
			}else{
				$pagearray_eusi[] = array();
			}
		}

		$url_view = $this->uri->segment($this->segement_num); // 2 setelah path core

		if(in_array($url_view, $pagearray_eusi)){
			$modif = true;
		}else{
			$modif = false;
		}

		return $modif;
	}

	protected function outputJson($response=array(),$status=200){
		$this->output
		->set_status_header($status)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($response, JSON_PRETTY_PRINT))
		->_display();
		exit();
	}
}