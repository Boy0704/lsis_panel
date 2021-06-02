<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notif_model');
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

    public function tes()
    {
        $tanggal = '2024-12-28 00:59:59';
        $tanggal = new DateTime($tanggal); 

        $sekarang = new DateTime();

        $perbedaan = $tanggal->diff($sekarang);

        //gabungkan
        echo $perbedaan->y.' selisih tahun.';
        echo $perbedaan->m.' selisih bulan.';
        echo $perbedaan->d.' selisih hari.';
        echo $perbedaan->h.' selisih jam.';
        echo $perbedaan->i.' selisih menit.';
    }

    public function cek_perizinan()
    {
        $this->db->where('notif', 't');
        $perizinan = $this->db->get('perizinan');
        if ($perizinan->num_rows() > 0) {
            foreach ($perizinan->result() as $rw) {

                if ($rw->jenis == 'HGU' || $rw->jenis == 'HGB') {
                    $tanggal = "$rw->sampai 00:59:59";
                    $tanggal = new DateTime($tanggal); 

                    $sekarang = new DateTime();

                    $perbedaan = $tanggal->diff($sekarang);
                    if ($perbedaan->y == 2) {
                        echo "notifikasi terikirim perizinan HGB HGU !<br>";
                        echo $rw->id_perizinan;

                        // Dikirim ke APK, GM, Manajer, ATU, Askep, Kasubaghukum, Staf Hukum, Kasubag Pertanahan dan Keamanan.

                        $title = "Perizinan";
                        $id = '';
                        $pesan = "Perizinan $rw->jenis akan berakhir 2 tahun lagi";
                        $method = "1";

                        $this->db->where('id_level', '1');
                        $this->db->or_where('id_level', '2');
                        $this->db->or_where('id_level', '4');
                        $this->db->or_where('id_level', '5');
                        $this->db->or_where('id_level', '6');
                        $this->db->or_where('id_level', '8');
                        $this->db->or_where('id_level', '9');
                        foreach ($this->db->get('users')->result() as $br) {
                            $this->Notif_model->send_notif_topup($title, $id, $pesan, $method, $br->token);
                        }
                        $this->db->where('id_perizinan', $rw->id_perizinan);
                        $this->db->update('perizinan', array('notif'=>'y'));


                    } 
                } else {
                    
                    $tanggal = "$rw->sampai 00:59:59";
                    $tanggal = new DateTime($tanggal); 

                    $sekarang = new DateTime();

                    $perbedaan = $tanggal->diff($sekarang);
                    if ($perbedaan->y == 0) {
                        if ($perbedaan->m == 6) {
                            echo "notifikasi terikirim non HGB !<br>";
                            echo $rw->id_perizinan;

                            // Dikirim ke APK, GM, Manajer, ATU, Askep, Kasubaghukum, Staf Hukum, Kasubag Pertanahan dan Keamanan.

                            $title = "Perizinan";
                            $id = '';
                            $pesan = "Perizinan $rw->jenis akan berakhir 6 bulan lagi";
                            $method = "1";

                            $this->db->where('id_level', '1');
                            $this->db->or_where('id_level', '2');
                            $this->db->or_where('id_level', '4');
                            $this->db->or_where('id_level', '5');
                            $this->db->or_where('id_level', '6');
                            $this->db->or_where('id_level', '8');
                            $this->db->or_where('id_level', '9');
                            foreach ($this->db->get('users')->result() as $br) {
                                $this->Notif_model->send_notif_topup($title, $id, $pesan, $method, $br->token);
                            }
                            $this->db->where('id_perizinan', $rw->id_perizinan);
                            $this->db->update('perizinan', array('notif'=>'y'));
                        } 
                    }
                    

                    if (strtotime($rw->sampai) == strtotime(date('Y-m-d'))) {
                        echo "berakhir <br>";
                        echo $rw->id_perizinan;

                        // Dikirim ke APK, GM, Manajer, ATU, Askep, Kasubaghukum, Staf Hukum, Kasubag Pertanahan dan Keamanan.

                        $title = "Perizinan";
                        $id = '';
                        $pesan = "Perizinan $rw->jenis akan telah habis masanya";
                        $method = "1";

                        $this->db->where('id_level', '1');
                        $this->db->or_where('id_level', '2');
                        $this->db->or_where('id_level', '4');
                        $this->db->or_where('id_level', '5');
                        $this->db->or_where('id_level', '6');
                        $this->db->or_where('id_level', '8');
                        $this->db->or_where('id_level', '9');
                        foreach ($this->db->get('users')->result() as $br) {
                            $this->Notif_model->send_notif_topup($title, $id, $pesan, $method, $br->token);
                        }
                        $this->db->where('id_perizinan', $rw->id_perizinan);
                        $this->db->update('perizinan', array('notif'=>'y'));
                    }

                }

            }
        } else {

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
