<?php


class Transaksi extends CI_Controller
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
            $data['produk'] = $this->db->get('produk')->result();
            $this->load->view('transaksi/index', $data);
        } else {
            redirect('masuk');
        }
    }
    public function simpan(){
        $banyak = $this->input->post('banyak');
        $member = $this->input->post('member');
        $idproduk = $this->input->post('idproduk');
        $harga = $this->input->post('harga');
        $berat = $this->input->post('berat');
        $banyak = count($this->input->post('idproduk'));

        for($i = 0; $i<=$banyak; $i++ ){
            
            if ($berat[$i] > 0){
                $total = $harga[$i] * $berat[$i];
                $data = array(
                    'id_member' => $member,
                    'id_produk' => $idproduk[$i],
                    'berat' => $berat[$i],
                    'sub_harga' => $harga[$i],
                    'total_harga' => $total
                );
                $this->db->insert('keranjang', $data);
            }
        }
        $this->session->set_flashdata('success', "Berhasil diproses");
        redirect('transaksi/tampil/' . $member);
    }

    public function tampil($member){
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('produk' , 'produk.id_produk=keranjang.id_produk');
        $data['keranjang'] = $this->db->get()->result();
        $data['member'] = $member;
        $this->load->view('transaksi/tampil', $data);
    }

    public function proses() {
        $kode = $this->buat_kode();
        $tanggal = $this->input->post('tanggal');
        $selesai = $this->input->post('selesai');
        $total = $this->input->post('total');
        $member = $this->input->post('member');
        $keranjang = $this->input->post('keranjang');
        $banyak = count($this->input->post('keranjang'));

        $data = array(
            'id_order' =>$kode,
            'id_member' =>$member,
            'total_order' =>$total,
            'tgl_order' =>$tanggal,
            'tgl_selesai' =>$selesai,
            'status_order' =>'PROSES'
        );
        $this->db->insert('tbl_order', $data);
        for ($i = 0; $i < $banyak; $i++){
            $this->db->where('id_keranjang' , $keranjang[$i]);
            $this->db->update('keranjang', array('id_order' =>$kode));
        }
        $this->session->set_flashdata('success', 'Berhasil Diproses!');
        redirect('transaksi');
    }

    function buat_kode() {
        $this->db->select('RIGHT(tbl_order.id_order, 7) as kode', false);
        $this->db->order_by('id_order', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tbl_order');

        if($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode);
        }else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $kodeJadi = "ORD" . $kodemax;
        return $kodeJadi;
    }

}
