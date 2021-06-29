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
        
        $this->load->view('templates/dash_header', $data);
        $this->load->view('templates/dash_sidebar', $data);
        $this->load->view('templates/dash_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/dash_footer');
    }
}