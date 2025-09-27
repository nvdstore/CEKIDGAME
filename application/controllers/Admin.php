<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        
        $this->load->library('form_validation');
		$this->load->helper('string');

		if($this->session->userdata('login') !== true){

			redirect('');

		}

        if($this->session->userdata('role') !== 'admin'){

			redirect('');

		}
	}

    public function dataUser()
	{
		$users = $this->db->get('users')->result();

		$this->load->view('web/header');
		$this->load->view('web/datauser',compact('users'));
		$this->load->view('web/footer');
	}

	public function dataUserAdd()
	{
		$this->load->view('web/header');
		$this->load->view('web/datauseradd');
		$this->load->view('web/footer');
	}

	public function saveDataUser()
	{

		$this->form_validation->set_rules('username','Username','required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('role','Role','required|trim');
		$this->form_validation->set_rules('status','Status','required|trim');
		

		if($this->form_validation->run() == FALSE){

			$this->dataUserAdd();

		}else{
			
			$data = [
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status'),
			];

			$this->db->insert('users',$data);
			$user_id = $this->db->insert_id();

			$this->db->insert('api_key',['id_user' => $user_id,'api_key' => random_string('alnum',60)]);

			$this->session->set_flashdata('success','Successfully added user');

			redirect('/data/user/add');

			
			
			
		}
	}

	public function deleteDataUser($id)
	{
		$cek = $this->db->get_where('users',['id_user' => $id])->row();

		if($cek->username !== 'admin'){

			$this->db->delete('users',['id_user' => $id]);

			$this->session->set_flashdata('success','Successfully deleted user');

		}

		redirect('/data/user');

	}

    public function statusDataUser()
    {
        if($this->input->is_ajax_request()){

            $id = $this->input->post('id');
            
            $cek = $this->db->get_where('users',['id_user' => $id])->row();

            if($cek->username !== 'admin'){

                if($cek->status == 1){

                    $status = 0;

                }else{

                    $status = 1;
                }

                $this->db->update('users',['status' => $status],['id_user' => $id]);

                $this->session->set_flashdata('success','Successfully changed user status');

            }

            redirect('/data/user');


        }
    }

    public function editDataUser($id)
    {
        $user = $this->db->get_where('users',['id_user' => $id])->row();

        if($user->username == 'admin'){

            redirect('/data/user');
            exit();
        }

        $this->load->view('web/header');
		$this->load->view('web/datauseredit',compact('user'));
		$this->load->view('web/footer');
    }

    public function saveEditDataUser($id)
    {
        
        $user_id = $id;

		$original_value = $this->db->get_where('users',['id_user' => $user_id])->row();

        if($original_value->username == 'admin'){

            redirect('/data/user');
            exit();
        }

		if($this->input->post('email') !== $original_value->email) {
			$is_unique1 =  '|is_unique[users.email]';
		} else {
			$is_unique1 =  '';
		}

        if($this->input->post('username') !== $original_value->username) {
			$is_unique2 =  '|is_unique[users.username]';
		} else {
			$is_unique2 =  '';
		}

        $this->form_validation->set_rules('username','Username','required|trim'.$is_unique2.'');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email'.$is_unique1.'');
		$this->form_validation->set_rules('role','Role','required|trim');
		$this->form_validation->set_rules('status','Status','required|trim');
		

		if($this->form_validation->run() == FALSE){

			$this->editDataUser($user_id);

		}else{
			
			$data = [
                'username' => $this->input->post('username'),
				'nama' => $this->input->post('name'),
				'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'status' => $this->input->post('status')
			];

			if(!empty($this->input->post('password'))){

				$data['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);

			}

				$this->db->update('users',$data,['id_user' => $user_id]);

				$this->session->set_flashdata('success','Successfully updated user');

				redirect('/data/user/edit/'.$user_id.'');
			
		}

    }

	public function settingWeb()
	{
		$data = $this->db->get_where('setting_web',['id_setting' => 1])->row();
		$this->load->view('web/header');
		$this->load->view('web/settingweb',compact('data'));
		$this->load->view('web/footer');
	}

	public function saveSettingWeb()
	{
		$this->form_validation->set_rules('title_web','Title Web','required|trim');
        $this->form_validation->set_rules('copyright_web','Copyright Web','required|trim');

        if($this->form_validation->run() == FALSE){

            $this->settingWeb();

        }else{

			$this->db->truncate('setting_web');
                        
			$insert = $this->db->insert('setting_web',['copyright_web' => $this->input->post('copyright_web'),'title_web' => $this->input->post('title_web')]);

			if($insert == true){

				$this->session->set_flashdata('success','Successfully updated');

				redirect('/setting/web');

			}else{

				redirect('/setting/web');

			}   

		}
	}

}
