<?php


class Produk extends CI_Controller
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
            $data['produk'] = $this->db->get('produk')->result();
            $this->load->view('produk/index', $data);
        } else {
            redirect('masuk');
        }
    }


    public function tambah() {
        $this->load->view('produk/tambah');
    }


    public function simpan() {
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');

        $data = array(
            'nama_produk' => $nama,
            'harga_produk' => $harga,
        );

        $this->db->insert('produk', $data);
        $this->session->set_flashdata('success', 'Data berhasil disimpan!!');
        redirect('produk');
    }

    public function ubah($id) {
        $data['cari'] = $this->db->get_where('produk', array('id_produk' => $id))->result();
        $this->load->view('produk/ubah', $data);
    }

    public function subah() {

        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $kode = $this->input->post('kode');
        
            $data = array(
                'nama_produk' => $nama,
                'harga_produk' => $harga
            );


        $this->db->where('id_produk', $kode);
        $this->db->update('produk', $data);

        $this->session->set_flashdata('success', 'Data berhasil Diubah!!');
        redirect('produk');
    }


    public function hapus($id) {
        $this->db->where('id_produk', $id);
        $this->db->delete('produk');

        $this->session->set_flashdata('success', 'Berhasil Dihapus!!');
        redirect('produk');
    }
}
