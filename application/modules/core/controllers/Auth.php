<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller { 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 18:10:45
	**/

	function __construct(){
		parent::__construct();

		if($this->session->userdata('isLogin')){
			redirect('core/dashboard');
		}

		$this->load->model('m_auth');
		$this->load->library('form_validation');
	}

	public function index(){
		// Info halaman
		$data['title']	= "Log in";
		$data['description'] = '';
		$data['asset']	= base_url('assets')."/";

		// Pesan
		$data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('login[username]', 'Username', 'required|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('login[password]', 'Password', 'required');

		if($this->form_validation->run() == true){
			$dataLogin = $this->input->post('login');

			$login = $this->m_auth->masuk($dataLogin);

			if(!empty($login)){
				$this->session->set_userdata(array(
					'isLogin'	=> TRUE,
    	        	'user_id' 	=> $login['user_id'],
        	    	'uname'		=> $dataLogin['username'],
        	    	'nama'		=> $login['nama_user'],
        	    	'group_key' => $login['key_name']
				));
				redirect('core/dashboard');
			}else{
				$data['message'] = "Login failed!";
			}
		}else{
			// Pesan validasi
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->load->view('masuk',$data);
	}

}