<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index(){

        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/dash_header', $data);
        $this->load->view('templates/dash_sidebar', $data);
        $this->load->view('templates/dash_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/dash_footer');
    }

    public function role(){
    
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required',[
            'required' => 'Role Kosong!'
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/dash_header', $data);
            $this->load->view('templates/dash_sidebar', $data);
            $this->load->view('templates/dash_topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/dash_footer');
        }else{

            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
             $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
             Sukses Menambahkan Role!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/role');

        }
    }

    public function editrole(){

            $data = array(
                'id' => $this->input->post('id'),
                'role' => $this->input->post('role')
            );

            $this->db->set($data);
            $this->db->where('id', $data['id']);
            $this->db->update('user_role');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
            Role berhasil diedit!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/role');
    }

     public function hapusrole($id){
       $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        Role berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
       redirect('admin/role');
   }

    public function roleaccess($role_id){
    
        $data['title'] = 'Role Acces';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

            $this->load->view('templates/dash_header', $data);
            $this->load->view('templates/dash_sidebar', $data);
            $this->load->view('templates/dash_topbar', $data);
            $this->load->view('admin/roleaccess', $data);
            $this->load->view('templates/dash_footer');
    }

    public function ubahakses(){

        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if($result->num_rows() < 1){
            $this->db->insert('user_access_menu', $data);
        }else{
            $this->db->delete('user_access_menu', $data);
        }
        
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        Akses Diubah
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
}