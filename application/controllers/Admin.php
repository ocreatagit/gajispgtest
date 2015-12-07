<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
//        $this->load->library('session');
//        $this->load->helper('file');
//        $this->load->library('ftp');
        $this->load->helper('url');
    }

    public function logout() {
        $this->session->unset_userdata('Username');
        redirect('welcome/index');
    }

    public static function test() {
        echo "adadasdasdas";
    }

    public function daftar_admin() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $data['status'] = $this->session->flashdata('status');
        $data['admins'] = $this->Admin_model->select_admin();

        $this->load->view('v_head', $data);
        $this->load->view('v_navigation', $data);
        $this->load->view('v_daftar_admin', $data);
        $this->load->view('v_foot');
    }

    public function tambah_admin() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }
        $data['status'] = $this->session->flashdata('status');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]');
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->input->post("btn_submit")) {
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('v_head');
                $this->load->view('v_navigation');
                $this->load->view('v_tambah_admin', $data);
            } else {
                $this->load->model("Admin_model");
                $id = $this->Admin_model->insert_admin();

                $config['upload_path'] = "./uploads";
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = 0;
                $config['file_name'] = $id;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload("foto_admin")) {
                    echo $response = $this->upload->display_errors();
                    exit;
                } else {
                    $response = $this->upload->data();
                    redirect("Admin/daftar_admin");
                }
            }
        } else {
            $data['status'] = "";
            $this->load->view('v_head');
            $this->load->view('v_navigation', $data);
            $this->load->view('v_tambah_admin', $data);
        }
    }

    public function GVlg7Mq9vc6y0LyijfKx() {
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]');
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');

        if ($this->input->post("btn_submit")) {
            if ($this->form_validation->run() == TRUE) {
                $this->Admin_model->change_data();
//                redirect('admin/GVlg7Mq9vc6y0LyijfKx');
            }
        }

        $data['status'] = $this->session->flashdata('status');
        $this->load->view('v_head', $data);
        $this->load->view('v_navigation', $data);
        $this->load->view('v_ganti_password', $data);
    }

    public function edit_admin($IDAdmin = FALSE) {
        if ($IDAdmin == FALSE) {
            redirect("Welcome");
        }
        if ($this->session->userdata('Username')) {
            $data['username'] = $this->session->userdata('Username');
            $data['level'] = $this->session->userdata('Level');
            $data['IDCabang'] = $this->session->userdata('IDCabang');
        } else {
            redirect('welcome/index');
        }

        $data['status'] = $this->session->flashdata('status');
        $data["admin"] = $this->Admin_model->get_admin_edit($IDAdmin);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->input->post("btn_submit")) {
            if ($this->form_validation->run() == FALSE) {
                $data['username'] = $this->session->userdata('Username');
                $data['level'] = $this->session->userdata('Level');
                $data['IDCabang'] = $this->session->userdata('IDCabang');
                $data['status'] = $this->session->flashdata('status');
                $data["admin"] = $this->Admin_model->get_admin_edit($IDAdmin);

                $this->load->view('v_head');
                $this->load->view('v_navigation', $data);
                $this->load->view('v_edit_admin', $data);
            } else {
                $name = $_FILES['foto_admin']['name'];
                if ($name != "") {
                    if (file_exists("./uploads/" . $this->input->post("IDAdmin") . ".jpg")) {
                        if (!unlink("./uploads/" . $this->input->post("IDAdmin") . ".jpg")) {
                            echo "gagal";
                            exit;
                        }
                    }
                    if (file_exists("./uploads/" . $this->input->post("IDAdmin") . ".png")) {
                        if (!unlink("./uploads/" . $this->input->post("IDAdmin") . ".png")) {
                            echo "gagal";
                            exit;
                        }
                    }
                    if (file_exists("./uploads/" . $this->input->post("IDAdmin") . ".gif")) {
                        if (!unlink("./uploads/" . $this->input->post("IDAdmin") . ".gif")) {
                            echo "gagal";
                            exit;
                        }
                    }
                }
//                if (!unlink("./uploads/" . $this->input->post("IDAdmin"))) {
//                    echo "gagal";
//                    exit;
//                }
                $this->load->model("Admin_model");
                $this->Admin_model->update_admin();

                $config['upload_path'] = "./uploads";
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = 0;
                $config['file_name'] = $this->input->post("IDAdmin");
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload("foto_admin")) {
//                    echo $response = $this->upload->display_errors();
//                    exit;
                } else {
                    $response = $this->upload->data();
                }
                redirect("Admin/daftar_admin");
            }
        } else {

            $this->load->view('v_head', $data);
            $this->load->view('v_navigation', $data);
            $this->load->view('v_edit_admin', $data);
        }
    }

}
