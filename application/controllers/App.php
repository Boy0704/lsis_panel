<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }

    public function form_agreement()
    {
        if ($_GET) {
            $data = array(
                'konten' => 'mobile/form_agreement',
                'judul_page' => 'From Agreement',
            );
            $this->load->view('v_index', $data);
        }
        
    }

    public function simpan_form_agreement()
    {
        log_data($_GET);
        log_data($_FILES);
        log_data($_POST);
    }

    public function hapus_riwayat_tracking()
    {
        $tgl1 = date('Y-m-d');
        $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
        $sql = $this->db->query( " DELETE FROM log_lokasi WHERE created_at NOT LIKE '$tgl2%' AND created_at NOT LIKE '$tgl1%' " );
        if ($sql) {
            echo "berhasil di hapus";
        }
    }

    public function pengembangan()
    {
        $this->session->set_flashdata('message', alert_biasa('Menu masih dalam tahap pengembangan !','warning'));
        redirect('app','refresh');
    }

    public function api_login()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $condition = array(
            'password' => sha1($decoded_data->password),
            'no_telp' => $decoded_data->no_telp,
            //'token' => $decoded_data->token
        );
        $message = array(
            'code' => '200',
            'message' => 'found',
            'data' => [$condition]//$condition
        );

        echo json_encode($message);
    }

    public function cetak()
    {
        $this->load->view('cetak');
    }
    

    public function hasil($value='')
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        
        $data = array(
            'konten' => 'hasil',
            'judul_page' => 'Hasil Perhitungan',
        );
        $this->load->view('v_index', $data);
    }
	
	public function index()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function get_pegawai()
    {
        $nip = $this->input->post('nip');
        $nama = $this->db->get_where('pegawai', array('nip'=>$nip))->row()->nama;
        echo $nama;
    }

    

}
