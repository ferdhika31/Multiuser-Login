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

		$this->global_data['notif'] = $this->session->flashdata('notif');
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "user";
		$this->global_data['title'] = "User";
		$this->global_data['description'] = "List user";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('core/user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'List User',
			'link'	=> site_url('core/user')
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

		$this->global_data['href_add'] = site_url('core/user/add');

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
				
				'href_edit'		=> site_url('core/user/edit/'.$result['user_id'])
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
			'link'	=> site_url('core/user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Add User',
			'link'	=> ''
		);

		$this->global_data['script'] = array(
			base_url('assets/plugins/datepicker/bootstrap-datepicker.js')
		);

		$this->global_data['add_script'] = "
		$(function(){
			$('#tgl_lahir').datepicker({
				autoclose: true,
				dateFormat: 'dd-mm-yy'
			});
		});
		";

		// Validasi form
		$config = array(
			array(
				'field' => 'nama',
				'label' => 'Full Name',
				'rules' => 'required|min_length[3]|max_length[45]'
			),
			array(
				'field' => 'alamat',
				'label'	=> 'Address',
				'rules' => 'required|min_length[3]|max_length[100]'
			),
			array(
				'field' => 'telp',
				'label'	=> 'No. Telp',
				'rules' => 'required|max_length[12]|numeric'
			),
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|is_unique[user.username]|alpha_numeric|min_length[4]|max_length[20]'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[6]|max_length[20]',
				'errors' => array(
					'required' => 'You must provide a %s.',
				),
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[user.email_user]'
			)
		);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run()){
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$telp = $this->input->post('telp');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$user_group = $this->input->post('user_group');
			$jk = $this->input->post('jk');

			$data = array(
				'nama_user'		=> $nama,
				'alamat'		=> $alamat,
				'telp'			=> $telp,
				'jenis_kelamin'	=> $jk,
				'email_user'	=> $email,
				'username'		=> $username,
				'password'		=> md5($password),
				'date_created'	=> date('Y-m-d H:i:s'),
				'date_updated'	=> date('Y-m-d H:i:s'),
				'user_group_id'	=> $user_group
			);

			$add = $this->m_user->add($data);

			if($add){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "<p>";
				$notif .= "<i class=\"fa fa-check\"></i> Sucessfully!";
	         	$notif .= "</p>";
	         	$notif .= "</div>";
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "<p>";
				$notif .= "<i class=\"fa fa-warning\"></i> Failed!";
	         	$notif .= "</p>";
	         	$notif .= "</div>";
			}

         	$this->session->set_flashdata('notif',$notif);
         	redirect('core/user');
		}else{
			$notif = "<div class=\"alert alert-danger alert-dismissable\">";
			$notif .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
			$notif .= "<p>";
			$notif .= "<i class=\"fa fa-warning\"></i> ".validation_errors();
         	$notif .= "</p>";
         	$notif .= "</div>";

         	$this->global_data['notif'] = (validation_errors()) ? $notif : $this->session->flashdata('notif');
		}

		$this->form();
	}

	public function edit($id=0){
		(empty($id)) ? redirect('core/user') : '';

		// Identitas halaman
		$this->global_data['active_menu'] = "user";
		$this->global_data['title'] = "Edit User";
		$this->global_data['description'] = "Edit user";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('core/user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit User',
			'link'	=> ''
		);

		$this->global_data['script'] = array(
			base_url('assets/plugins/datepicker/bootstrap-datepicker.js')
		);

		$this->global_data['add_script'] = "
		$(function(){
			$('#tgl_lahir').datepicker({
				autoclose: true,
				dateFormat: 'dd-mm-yy'
			});
		});
		";

		$this->global_data['datana'] = $this->m_user->getOneUser(array('user_id'=>$id));

		// Validasi form
		$config = array(
			array(
				'field' => 'nama',
				'label' => 'Full Name',
				'rules' => 'required|min_length[3]|max_length[45]'
			),
			array(
				'field' => 'alamat',
				'label'	=> 'Address',
				'rules' => 'required|min_length[3]|max_length[100]'
			),
			array(
				'field' => 'telp',
				'label'	=> 'No. Telp',
				'rules' => 'required|max_length[12]|numeric',
				'errors' => array(
					'required' => 'You must provide a %s.',
				),
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			)
		);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run()){
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$telp = $this->input->post('telp');
			$password = md5($this->input->post('password'));
			$email = $this->input->post('email');
			$user_group = $this->input->post('user_group');
			$jk = $this->input->post('jk');

			$data = array(
				'nama_user'		=> $nama,
				'alamat'		=> $alamat,
				'telp'			=> $telp,
				'jenis_kelamin'	=> $jk,
				'email_user'	=> $email,
				'password'		=> (empty($password)) ? $this->global_data['datana']['password'] : $password,
				'date_updated'	=> date('Y-m-d H:i:s'),
				'user_group_id'	=> $user_group
			);

			$edit = $this->m_user->edit($data,array('user_id'=> $id));

			if($edit){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "<p>";
				$notif .= "<i class=\"fa fa-check\"></i> Sucessfully edited!";
	         	$notif .= "</p>";
	         	$notif .= "</div>";
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "<p>";
				$notif .= "<i class=\"fa fa-warning\"></i> Failed!";
	         	$notif .= "</p>";
	         	$notif .= "</div>";
			}

         	$this->session->set_flashdata('notif',$notif);
         	redirect('core/user');
		}else{
			$notif = "<div class=\"alert alert-danger alert-dismissable\">";
			$notif .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
			$notif .= "<p>";
			$notif .= "<i class=\"fa fa-warning\"></i> ".validation_errors();
         	$notif .= "</p>";
         	$notif .= "</div>";

         	$this->global_data['notif'] = (validation_errors()) ? $notif : $this->session->flashdata('notif');
		}

		$this->form();
	}

	private function form(){
		// Load model
		$this->load->model("m_usergroup");

		// Load Library
		$this->load->library('form_validation');

		$this->global_data['user_group'] = $this->m_usergroup->getAll();

		$this->tampilan('user/form');
	}

	public function getOne($id=0){
		(empty($id)) ? redirect('core/user') : '';

		$data = $this->m_user->getOneUser(array('user_id'=>$id));

		$this->outputJson($data);
	}

	public function hapus(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			
			$hapus = $this->m_user->remove(array('user_id' => $id));

			if($hapus){
				$response = array('status'=>true, 'message'=>'Sucessfully deleted user.');
			}else{
				$response = array('status'=>false, 'message'=>'Kesalahan database');
			}
			
		}

		$this->outputJson($response);
	}
}