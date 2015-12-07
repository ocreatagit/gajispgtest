<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->helper('url');
    }

    public function index() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array();

        $data['info'] = "";
        if ($this->input->post("btn_login")) {
            if ($this->Admin_model->cek_login($username, $password)) {
                $this->session->set_userdata('Username', $username);
                $this->session->set_userdata('Level', $this->Admin_model->cek_level_login($username)->level);
                if ($this->session->userdata("Level") != 0) {
                    $this->session->set_userdata('IDCabang', $this->Admin_model->get_cabang($username));
                } else {
                    $this->session->set_userdata('IDCabang', 0);
                }
                
                if($this->session->userdata('Level') == 2){
                    redirect('Laporan/kas');
                }
                redirect('Laporan/harian');
            } else {
                redirect('welcome/index');
            }
        }
        $data["status"] = $this->session->flashdata("status");
        $this->load->view("v_login", $data);
    }

}
