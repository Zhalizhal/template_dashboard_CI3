<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index(){

        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->model('User_model', 'user');
        $data['tampil_user'] =$this->user->getuser();
        
        $this->load->view('templates/dash_header', $data);
        $this->load->view('templates/dash_sidebar', $data);
        $this->load->view('templates/dash_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/dash_footer');
    }
    
    public function editprofil(){
        
        $data['title'] = 'Edit Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama tidak boleh kosong!'
        ]);
        
        if($this->form_validation->run() == false){

            $this->load->view('templates/dash_header', $data);
            $this->load->view('templates/dash_sidebar', $data);
            $this->load->view('templates/dash_topbar', $data);
            $this->load->view('user/editprofil', $data);
            $this->load->view('templates/dash_footer');
        }else{

            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            //jika ada foto yang diupload
            $uploadfoto = $_FILES['foto']['name'];
            if($uploadfoto){
                $config['upload_path']          = './assets/img/profil/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = '2048';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('foto')){
                    $foto_baru = $this->upload->data('file_name');
                    $this->db->set('foto', $foto_baru);
                }else{
                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('user');
                }

            }
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
            User berhasil diedit!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('user');
            
        }
    }
}