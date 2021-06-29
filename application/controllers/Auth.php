<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
   }

   public function index(){

   //form validasi
   $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',[
      'required' => 'Masukkan Email!'
   ]); //aturan form validasi
   $this->form_validation->set_rules('password', 'Password', 'required|trim', [
      'required' => 'Masukkan Password!'
   ]); //aturan form validasi

      //jika saah masuk maka masuk ke halaman login lagi
      if( $this->form_validation->run() == false)
      {         
         $data['title'] = 'Masuk';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/login');
         $this->load->view('templates/auth_footer');
      }
      //jika validasi berhasil maka bisa masuk
      else{
         $this->_login(); //menggunakan methode private     
      }         
   }

   private function _login(){

      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->db->get_where('user', ['email' => $email])->row_array();

      //validasi user jika ditemukan atau tidak
      if($user){
         //jika user aktif
         if($user['is_active'] == 1){
            
            //cek password
            if(password_verify($password, $user['password'])){
               $data = [
                  'email' => $user['email'],
                  'role_id' => $user['role_id']
               ];
               $this->session->set_userdata($data);

               if($user['role_id'] == 1){
                  redirect('admin');
               }else{
                  redirect('user');
               }
            }else{
               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
               Password Salah!</div>');
               redirect('auth');
            }

         }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Akun Belum Aktif, Silahkan Aktivasi Email!</div>');
            redirect('auth');
         }
      }else{
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         Akun Tidak Ditemukan!</div>');
         redirect('auth');
      }

   }

   public function registrasi()
   {

      //form validasi beserta rulesnya
      $this->form_validation->set_rules('nama', 'Name', 'required|trim', [
         'required' => 'Nama Tidak Boleh Kosong'
      ]); //aturan form validasi
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
         'is_unique' => 'Email sudah digunakan!',
         'required' => 'Email Tidak Boleh Kosong!'
      ]); //aturan form validasi
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repassword]',[
          'matches' => 'Password Tidak Sama!',
         'min_length' => 'Password Terlalu Pendek',
         'required' => 'Password Tidak Boleh Kosong'
      ]); //aturan form validasi
      $this->form_validation->set_rules('repassword', 'Password', 'required|trim|matches[password]'); //aturan form validasi
      
      //jika data kosong maka akan dilarikan ke halaman registrasi
      if( $this->form_validation->run() == false)
      {
         $data['title'] = 'Registrasi';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/registrasi');
         $this->load->view('templates/auth_footer');

      }else{
         //membuat array pengambilan data dari halaman form registrasi dan menyimpannya di array $data
         $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'foto' => 'default.jpg',
            'password' =>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => '2',
            'is_active' => '1',
            'date_created' => time()
            ];
            //setelah di simpan di array lalu di inputkan ke database ke tabel user dengan mengambil data dari $data
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, Akun Berhasil Dibuat!, Silahkan Masuk</div>');
            redirect('auth');
      }
   }

   public function lupa_password()
   {
      $data['title'] = 'Lupa Password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/lupa_password');
      $this->load->view('templates/auth_footer');
   }
   
   public function logout()
   {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Keluar!</div>');
      redirect('auth');
   }
}