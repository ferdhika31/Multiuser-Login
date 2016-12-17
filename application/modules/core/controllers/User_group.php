<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class User_group extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-23 21:47:26
	**/

	function __construct(){
		parent::__construct();

		$this->load->model("m_usergroup");

		$this->load->library(['pagination','form_validation']);	
	}

	public function index(){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_group";
		$this->global_data['title'] = "User Group";
		$this->global_data['description'] = "List user group";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'List User Group',
			'link'	=> ''
		);

		$this->global_data['data'] = array();

		$this->global_data['href_add'] = site_url('core/user_group/add');

		$data = $this->m_usergroup->getAll();
		$no=1;
		foreach ($data as $result) {
			$this->global_data['data'][] = array(
				'no'				=> $no,
				'nama'				=> $result['name'],
				'href_permission'	=> site_url('core/user_group/permission/'.$result['key_name']),
				'href_edit'			=> site_url('core/user_group/edit/'.$result['user_group_id'])
			);
			$no++;
		}

		$this->tampilan('user_group/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_group";
		$this->global_data['stt'] = "add";
		$this->global_data['title'] = "Add User Group";
		$this->global_data['description'] = "Add user group";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'User Group',
			'link'	=> site_url('user_group')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Add User Group',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('name', 'Group Name', 'required|min_length[3]|max_length[12]|is_unique[user_group.name]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('key', 'Key Name', 'required|min_length[3]|max_length[12]|is_unique[user_group.key_name]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));

		if($this->form_validation->run()){
			$nama = $this->input->post('name');
			$key = $this->input->post('key');

			$peri = array(
				'view' => array(),
				'modif' => array()
			);

			$nambah = $this->m_usergroup->tambah(array(
				'name' => $nama,
				'key_name' => $key,
				'permission' => serialize($peri)
			));

			if($nambah){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-success\"></i> Alert!</h4>";
				$notif .= "	Successfully adding group ".$nama;
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_group');
			}
		}else{
			// Pesan validasi
			if(validation_errors()){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	".validation_errors();
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_group/add');
			}
		}

		$this->tampilan('user_group/form');
	}

	public function edit($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_group";
		$this->global_data['stt'] = "edit";
		$this->global_data['title'] = "Edit User Group";
		$this->global_data['description'] = "Edit user group";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'User Group',
			'link'	=> site_url('user_group')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit User Group',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$data = $this->m_usergroup->getOneBy(array('user_group_id'=>$id));
		
		if(empty($data)){
			redirect('core/user_group');
		}

		$this->global_data['datana'] = $data;

		$this->form_validation->set_rules('name', 'Group Name', 'required|min_length[3]|max_length[12]', array(
			'required'	=> 'You have not provided %s.'
        ));
        $this->form_validation->set_rules('key', 'Key Name', 'required|min_length[3]|max_length[12]', array(
			'required'	=> 'You have not provided %s.'
        ));

        if($this->form_validation->run()){
			$nama = $this->input->post('name');
			$key = $this->input->post('key');

			$ubah = $this->m_usergroup->ubah(array(
				'name' => $nama,
				'key_name' => $key
			),array('user_group_id'=>$id));

			if($ubah){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-success\"></i> Alert!</h4>";
				$notif .= "	Successfully change group ".$nama;
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_group');
			}
		}else{
			// Pesan validasi
			if(validation_errors()){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	".validation_errors();
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_group/edit/'.$id);
			}
		}

		$this->tampilan('user_group/form');
	}

	public function permission(){
		$key = $this->uri->segment(4);

		$this->load->model('m_userpage');

		// Identitas halaman
		$this->global_data['active_menu'] = "user_group";
		$this->global_data['stt'] = "permission";
		$this->global_data['title'] = "Permission User Group";
		$this->global_data['description'] = "Permission user group";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'User Group',
			'link'	=> site_url('user_group')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Permission User Group',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		if($this->input->post('change')){
			$permissions = $this->input->post('permission');

			if(!empty($permissions)){
				$data = array('permission'=>serialize($permissions));

				$idna = array('key_name' => $key);

				if($this->m_usergroup->ubah($data,$idna)){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
					$notif .= "	Permission successfully changed.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('user_group/permission/'.$key);
				}
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Permission failed changed.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_group/permission/'.$key);
			}
		}

		if(!empty($this->m_usergroup->getOneBy(array('key_name'=>$key)))){
			$this->global_data['page'] = $this->m_userpage->getAll();
			$this->global_data['admin'] = $this->m_usergroup->getOneBy(array('key_name' => $key));

		}else{
			redirect('core/user_group');
		}

		$this->tampilan('user_group/permission');
	}
}