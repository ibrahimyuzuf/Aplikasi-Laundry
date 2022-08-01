<?php


class Member extends CI_Controller
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
            $data['member'] = $this->db->get('member')->result();
            $this->load->view('member/index', $data);
        } else {
            redirect('masuk');
        }
    }


    public function tambah() {
        $this->load->view('member/tambah');
    }


    public function simpan() {
        $nama = $this->input->post('nama');
        $kelamin = $this->input->post('kelamin');
        $alamat = $this->input->post('alamat');
        $hp = $this->input->post('hp');
        $tanggal = $this->input->post('tanggal');

        $data = array(
            'nama_member' => $nama,
            'kelamin_member' => $kelamin,
            'alamat_member' => $alamat,
            'tlp_member' => $hp,
            'tgl_daftar' => $tanggal

        );

        $this->db->insert('member', $data);
        $this->session->set_flashdata('success', 'Data berhasil disimpan!!');
        redirect('member');
    }

    public function ubah($id) {
        $data['cari'] = $this->db->get_where('member', array('id_member' => $id))->result();
        $this->load->view('member/ubah', $data);
    }

    public function subah() {
        $nama = $this->input->post('nama');
        $kelamin = $this->input->post('kelamin');
        $alamat = $this->input->post('alamat');
        $hp = $this->input->post('hp');
        $tanggal = $this->input->post('tanggal');
        $kode = $this->input->post('kode');
        
        
        $data = array(
            'nama_member' => $nama,
            'kelamin_member' => $kelamin,
            'alamat_member' => $alamat,
            'tlp_member' => $hp,
            'tgl_daftar' => $tanggal

        );


        $this->db->where('id_member', $kode);
        $this->db->update('member', $data);

        $this->session->set_flashdata('success', 'Data berhasil Diubah!!');
        redirect('member');
    }


    public function hapus($id) {
        $this->db->where('id_produk', $id);
        $this->db->delete('member');

        $this->session->set_flashdata('success', 'Berhasil Dihapus!!');
        redirect('member');
    }
}
