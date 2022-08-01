<?php


class Masuk extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('status') == true) {
            redirect('Utama');
        } else {

            $this->load->view('masuk/index.php');
        }
    }

    public function proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->db->get_where('petugas', array(
            'username' => $username,
            'password' => $password
        ));

        $data = $cek->result;
        $banyak = $cek->num_rows();

        if ($banyak >= 1) {
            $data_session = array(
                'username' => $username,
                'status' => "login"
            );

            $this->session->set_userdata($data_session);

            redirect('Utama');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect('Masuk');
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('utama');
    }
}
