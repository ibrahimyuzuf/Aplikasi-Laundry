 <?php


    class Utama extends CI_Controller
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
                $data['petugas'] = $this->db->get('petugas')->num_rows();
                $data['member'] = $this->db->get('member')->num_rows();
                $data['produk'] = $this->db->get('produk')->num_rows();
                $data['ord'] = $this->db->get_where('tbl_order', array('status_order' => 'SELESAI'))->num_rows();
                $this->load->view('utama', $data);
            } else {
                redirect('masuk');
            }
        }
    }
