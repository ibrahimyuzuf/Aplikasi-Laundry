<?php


class Petugas extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('status') == "login") {
            $data['petugas'] = $this->db->get('petugas')->result();
            $this->load->view('petugas/index', $data);
        } else {
            redirect('masuk');
        }
    }


    public function tambah() {
        $this->load->view('petugas/tambah');
    }


    public function simpan() {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = array(
            'nama_petugas' => $nama,
            'username' => $username,
            'password' => $password
        );

        $this->db->insert('petugas', $data);
        $this->session->set_flashdata('success', 'Data berhasil disimpan!!');
        redirect('petugas');
    }

    public function ubah($id) {
        $data['cari'] = $this->db->get_where('petugas', array('id_petugas' => $id))->result();
        $this->load->view('petugas/ubah', $data);
    }

    public function subah() {

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $kode = $this->input->post('kode');

        if($password == ""){
            $data = array(
                'nama_petugas' => $nama,
                'username' => $username,
                'password' => $password
            );

        }else {
            $data = array(
                'nama_petugas' => $nama,
                'username' => $username
            );
        }

        $this->db->where('id_petugas', $kode);
        $this->db->update('petugas', $data);

        $this->session->set_flashdata('success', 'Data berhasil Diubah!!');
        redirect('petugas');
    }


    public function hapus($id) {
        $this->db->where('id_petugas', $id);
        $this->db->delete('petugas');

        $this->session->set_flashdata('success', 'Berhasil Dihapus!!');
        redirect('petugas');
    }
}
