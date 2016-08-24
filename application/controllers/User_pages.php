<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class User_pages extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-24 23:03:09
	**/

	function __construct(){
		parent::__construct();

		$this->load->model("m_userpage");

		$this->load->library(['pagination','form_validation']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_pages";
		$this->global_data['title'] = "User Pages";
		$this->global_data['description'] = "List user page";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'List User Page',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Pengaturan pagination
		$config['base_url'] = site_url('user_pages/index');
		$config['total_rows'] = count($this->m_userpage->getAll());
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
		$page = $this->m_userpage->getAllPer($config['per_page'], $id);

		$this->global_data['data'] = array();

		$no=1+$id;
		foreach ($page as $result) {
			$this->global_data['data'][] = array(
				'no'			=> $no,
				'id'			=> $result['user_page_id'],
				'nama'			=> $result['page_name'],
				'url'			=> $result['page_url'],
				'href_edit'		=> site_url('user_pages/edit/'.$result['user_page_id'])
			);
			$no++;
		}

		$this->tampilan('user_page/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_pages";
		$this->global_data['stt'] = "add";
		$this->global_data['title'] = "Add User Page";
		$this->global_data['description'] = "Add user page";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'User Page',
			'link'	=> site_url('user_pages')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Add User Page',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('name', 'Page Name', 'required|min_length[3]|max_length[12]|is_unique[user_page.page_name]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('url', 'Page URL', 'required|min_length[3]|max_length[12]|is_unique[user_page.page_url]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));

        if($this->form_validation->run()){
        	$nama = $this->input->post('name');
			$url = $this->input->post('url');

			$nambah = $this->m_userpage->tambah(array(
				'page_name' => $nama,
				'page_url' => $url
			));

			if($nambah){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-success\"></i> Alert!</h4>";
				$notif .= "	Successfully adding page ".$nama;
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_pages');
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

				redirect('user_pages/add');
			}
        }

        $this->tampilan('user_page/form');
	}

	public function edit($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_pages";
		$this->global_data['stt'] = "edit";
		$this->global_data['title'] = "Edit User Page";
		$this->global_data['description'] = "Edit user page";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> User',
			'link'	=> site_url('user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'User Pages',
			'link'	=> site_url('user_pages')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit User Page',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$data = $this->m_userpage->getOneBy(array('user_page_id'=>$id));
		
		if(empty($data)){
			redirect('user_pages');
		}

		$this->global_data['datana'] = $data;

		$this->form_validation->set_rules('name', 'Page Name', 'required|min_length[3]|max_length[12]', array(
			'required'	=> 'You have not provided %s.'
        ));
        $this->form_validation->set_rules('url', 'Page URL', 'required|min_length[3]|max_length[12]', array(
			'required'	=> 'You have not provided %s.'
        ));

        if($this->form_validation->run()){
        	$nama = $this->input->post('name');
			$url = $this->input->post('url');

			$ubah = $this->m_userpage->ubah(array(
				'page_name' => $nama,
				'page_url' => $url
			),array('user_page_id'=>$id));

			if($ubah){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Successfully change page ".$nama;
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('user_pages');
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

				redirect('user_pages/add');
			}
        }

		$this->tampilan('user_page/form');
	}

	public function delete(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cek = $this->m_userpage->getOneBy(array('user_page_id'=>$id));

			if(!empty($cek)){
				$hapus = $this->m_userpage->hapus(array('user_page_id'=>$id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Successfully deleted.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}
		}

		echo json_encode($response);
	}
}