<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('web/login');
	}

    public function authCek()
    {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == FALSE){

            $this->index();

        }else{

            $cek = $this->db->get_where('users',['username' => $this->input->post('username')])->row();

            if($cek !== NULL){

                if(password_verify($this->input->post('password'),$cek->password)){


                    if($cek->status == 1){

                        $data = [
                            'id_user' => $cek->id_user,
                            'nama' => $cek->nama,
                            'username' => $cek->username,
                            'email' => $cek->email,
                            'role' => $cek->role,
                            'login' => true
                        ];
    
                        $this->session->set_userdata($data);
                        $this->session->sess_regenerate();
    
                        redirect('/dashboard');

                    }else{

                        $this->session->set_flashdata('error','Inactive user!');
                    
                        redirect('');

                    }

                  

                }else{

                    $this->session->set_flashdata('error','Wrong Username/Password!');
                    
                    redirect('');

                }

            }else{

                $this->session->set_flashdata('error','Wrong Username/Password!');
                    
                redirect('');


            }


        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }

}
