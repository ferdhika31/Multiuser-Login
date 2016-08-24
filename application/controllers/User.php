<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class User extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 20:31:06
	**/

	function __construct(){
		parent::__construct();

		$this->load->model("m_user");

		$this->load->library(['pagination','form_validation']);	
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "user";
		$this->global_data['title'] = "User";
		$this->global_data['description'] = "List user";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'List User',
			'link'	=> site_url('user')
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('user/index');
		$config['total_rows'] = count($this->m_user->getAllUser());
		$config['per_page'] = $this->session->userdata('site_list_limit');
		$config['full_tag_open'] = '<div class="box-footer clearfix"><ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_link'] = 'Lanjut &raquo;';
		$config['prev_link'] = '&laquo; Kembali';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 1;
		$config['last_link'] = '<b>Akhir &rsaquo;</b>';
		$config['first_link'] = '<b>&lsaquo; Awal</b>';

		//inisialisasi config pagination
		$this->pagination->initialize($config);

		//buat pagination
		$this->global_data['halaman'] = $this->pagination->create_links();

		// data
		$user = $this->m_user->getAllUserPer($config['per_page'], $id);

		$this->global_data['dataUser'] = array();

		$no=1+$id;
		foreach ($user as $result) {
			$this->global_data['dataUser'][] = array(
				'no'			=> $no,
				'id'			=> $result['user_id'],
				'nama'			=> $result['nama_user'],
				'email'			=> $result['email_user'],
				'telp'			=> $result['telp'],
				'hak'			=> $result['name'],
				'foto'			=> (!empty($result['foto'])) ? base_url('assets/'.$result['foto']) : base_url('assets/img/default.png'),
				'username'		=> $result['username'],
				
				'href_edit'		=> site_url('user/edit/'.$result['user_id'])
			);
			$no++;
		}

		$this->tampilan('user/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "user";
		$this->global_data['title'] = "Add User";
		$this->global_data['description'] = "Add user";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Add User',
			'link'	=> ''
		);

		$this->tampilan('user/form');
	}
}