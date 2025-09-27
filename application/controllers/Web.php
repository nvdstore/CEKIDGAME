<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper('string');

		if($this->session->userdata('login') !== true){

			redirect('');

		}
	}

	public function dashboard()
	{
		$this->load->view('web/header');
		$this->load->view('web/dashboard');
		$this->load->view('web/footer');
	}

	public function profile()
	{
		$api = $this->db->get_where('api_key',['id_user' => $this->session->userdata('id_user')])->row();

		$this->load->view('web/header');
		$this->load->view('web/profile',compact('api'));
		$this->load->view('web/footer');
	}

	public function saveProfile()
	{
		$user_id = $this->session->userdata('id_user');

		$original_value = $this->db->get_where('users',['id_user' => $user_id])->row();
		if($this->input->post('email') !== $original_value->email) {
			$is_unique =  '|is_unique[users.email]';
		} else {
			$is_unique =  '';
		}

		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email'.$is_unique);
		$this->form_validation->set_rules('whitelist_ip','Whitelist IP','trim');
		

		if($this->form_validation->run() == FALSE){

			$this->profile();

		}else{
			
			$data = [
				'nama' => $this->input->post('name'),
				'email' => $this->input->post('email'),
			];

			if(!empty($this->input->post('password'))){

				$data['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);

			}

			    $this->db->update('api_key',['whitelist_ip' => $this->input->post('whitelist_api')],['id_user' => $user_id]);

				$this->db->update('users',$data,['id_user' => $user_id]);

				$this->session->set_flashdata('success','Successfully updated profile');

				redirect('/profile');
			
		}

	}

	public function updateApi()
	{
		if($this->input->is_ajax_request()){

			$this->db->update('api_key',['api_key' => random_string('alnum',60)],['id_user' => $this->session->userdata('id_user')]);

			$this->session->set_flashdata('success','Successfully updated API key');

		}
	}

	public function listGame()
	{
		$this->load->view('web/header');
		$this->load->view('web/listgame');
		$this->load->view('web/footer');
	}

	public function apiDoc()
	{
		$this->load->view('web/header');
		$this->load->view('web/apidoc');
		$this->load->view('web/footer');
	}

	




	

}
