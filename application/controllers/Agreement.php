<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Agreement extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notif_model');
	}

	public function index()
	{
		$data = array(
            'konten' => 'agreement/view',
            'judul_page' => 'Agreement',
        );
        $this->load->view('v_index', $data);
	}

	public function add()
	{
		$data = array(
            'konten' => 'agreement/add',
            'judul_page' => 'Form Agreement',
        );
        $this->load->view('v_index', $data);
	}

	public function aksi_simpan()
	{
		// log_data($_POST);
		// log_data($_FILES);
		$id_user = $this->input->get('id_user');

		$ktp_p1 = upload_gambar_biasa('agreement', 'files/agreement/', 'jpg|png|jpeg|pdf', 10000, 'ktp_p1');
		$ktp_p2 = upload_gambar_biasa('agreement', 'files/agreement/', 'jpg|png|jpeg|pdf', 10000, 'ktp_p2');

		$surat_kuasa1 = upload_gambar_biasa('agreement', 'files/agreement/', 'jpg|png|jpeg|pdf', 10000, 'surat_kuasa1');
		$surat_kuasa2 = upload_gambar_biasa('agreement', 'files/agreement/', 'jpg|png|jpeg|pdf', 10000, 'surat_kuasa1');

		// table agreement
		$agree = array(
			'nama_p1' => $this->input->post('nama_p1'),
			'nama_p2' => $this->input->post('nama_p2'),
			'ktp_p1' => $ktp_p1,
			'ktp_p2' => $ktp_p2,

			'no_surat_kuasa_p1' => $this->input->post('no_surat_p1'),
			'no_surat_kuasa_p2' => $this->input->post('no_surat_p2'),
			'surat_kuasa_p1' => $surat_kuasa1,
			'surat_kuasa_p2' => $surat_kuasa2,

			'jenis_perjanjian' => $this->input->post('jenis_perjanjian'),
			'objek_perjanjian' => $this->input->post('objek_perjanjian'),
			'jumlah_objek_perjanjian' => $this->input->post('jumlah_objek_perjanjian'),
			'jangka_waktu_perjanjian' => $this->input->post('jangka_waktu_perjanjian'),
			'nilai_perjanjian' => $this->input->post('nilai_perjanjian'),
			'cara_pembayaran' => $this->input->post('cara_pembayaran'),
			'term_pembayaran' => $this->input->post('term_pembayaran'),

			'alamat1' => $this->input->post('alamat1'),
			'no_telp1' => $this->input->post('no_telp1'),
			'email1' => $this->input->post('email1'),
			'faks1' => $this->input->post('faks1'),
			'alamat2' => $this->input->post('alamat2'),
			'no_telp2' => $this->input->post('no_telp2'),
			'email2' => $this->input->post('email2'),
			'faks2' => $this->input->post('faks2'),
			'user_at' => $id_user,
			'status' => 'proses',
			'created_at' => get_waktu(),

		);

		$this->db->insert('agreement', $agree);
		$id_agree = $this->db->insert_id();

		$title = "Agreement New";
        $id = $id_user;
        $pesan = "Permohonan Perjanjian Menunggu Untuk Diproses";
        $method = "1";

        $this->db->where('id_level', '6');
        $this->db->or_where('id_level', '9');
        foreach ($this->db->get('users')->result() as $br) {
        	$this->Notif_model->send_notif_topup($title, $id, $pesan, $method, $br->token);
        }

		

		?>
		<script type="text/javascript">
			WebAppInterface.showToast("Data berhasil disimpan !");
			window.location="<?php echo base_url() ?>agreement?<?php echo param_get() ?>";
		</script>
		<?php
		


	}

	public function edit($id)
	{
		$this->db->where('id_agree', $id);
		$query = $this->db->get('agreement');
		$data = array(
			'query' => $query,
			'konten' => 'agreement/edit',
            'judul_page' => 'Edit Agreement',
		);

		$this->load->view('v_index', $data);


	}

	public function detail($id)
	{
		$this->db->where('id_agree', $id);
		$query = $this->db->get('agreement');
		$data = array(
			'query' => $query,
			'konten' => 'agreement/detail',
            'judul_page' => 'detail Agreement',
		);

		$this->load->view('v_index', $data);


	}

	public function upload_kurang($id)
	{
		if ($_POST) {
			
			$id_agree = $this->input->post('id_agree');
			$data = [];
   
		      $count = count($_FILES['files']['name']);
		    
		      for($i=0;$i<$count;$i++){
		    
		        if(!empty($_FILES['files']['name'][$i])){

		        	$nmfile = "tambahan_".time();
		    
		          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
		          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
		          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
		          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
		          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
		  
		          $config['upload_path'] = 'files/agreement/'; 
		          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
		          $config['max_size'] = '10000';
		          $config['file_name'] = $nmfile;
		   
		          $this->load->library('upload',$config); 
		    
		          if($this->upload->do_upload('file')){
		            $uploadData = $this->upload->data();
		            $filename = $uploadData['file_name'];
		   
		            $this->db->insert('agree_kurang', array(
		            	'id_agree' => $id_agree,
		            	'link' => $filename
		            ));
		          }
		        }
		   
		      }

		    $title = "Agreement Tambahan";
	        $id = '';
	        $pesan = "file tambahan permohonan perjanjian sudah di upload";
	        $method = "1";

	        $this->db->where('id_level', '6');
	        $this->db->or_where('id_level', '9');
	        foreach ($this->db->get('users')->result() as $br) {
	        	$this->Notif_model->send_notif_topup($title, $id, $pesan, $method, $br->token);
	        }

			

			?>
			<script type="text/javascript">
				WebAppInterface.showToast("Data berhasil disimpan !");
				window.location="<?php echo base_url() ?>agreement?<?php echo param_get() ?>";
			</script>
			<?php

		} else {
			$data = array(
				'id' => $id,
				'konten' => 'agreement/upload_kurang',
	            'judul_page' => 'Upload Agreement',
			);
			$this->load->view('v_index', $data);
		}
	}

	public function lihat_data_tambahan($id)
	{
		$data = array(
			'id' => $id,
			'konten' => 'agreement/tambahan',
            'judul_page' => 'Data yang kurang Agreement',
		);
		$this->load->view('v_index', $data);
	}

	public function upload_hasil($id)
	{
		$this->db->where('id_agree', $id);
		$query = $this->db->get('agreement');
		$data = array(
			'query' => $query,
			'konten' => 'agreement/upload_hasil',
            'judul_page' => 'Upload Agreement',
		);

		$this->load->view('v_index', $data);


	}

	public function aksi_upload_hasil()
	{
		$hasil = upload_gambar_biasa('hasil_agreement', 'files/agreement/', 'jpg|png|jpeg|pdf', 10000, 'hasil');
		$this->db->insert('hasil_agree', array(
			'id_agree'=>$this->input->post('id_agree'),
			'link_download'=> $hasil )
		);

		$this->db->where('id_agree', $this->input->post('id_agree'));
		$this->db->update('agreement', array('status'=>'final'));

		?>
		<script type="text/javascript">
			WebAppInterface.showToast("Data berhasil diupload !");
			window.location="<?php echo base_url() ?>agreement?<?php echo param_get() ?>";
		</script>
		<?php

	}

	public function minta_perbaiki($id)
	{
		if ($_POST) {


			$this->db->where('id_agree', $id);
			$this->db->update('agreement', array('status'=>'kurang','catatan_perbaikan' => $this->input->post('catatan_perbaikan')));

			$title = "Agreement Perbaikan";
	        $id = get_data('agreement','id_agree',$id,'user_at');
	        $pesan = "Permohonan Perjanjian meminta perbaikan";
	        $method = "1";
	        $token = get_data('users','id_user',$id,'token');

	        $this->Notif_model->send_notif_topup($title, $id, $pesan, $method, $token);

			?>
			<script type="text/javascript">
				WebAppInterface.showToast("Data berhasil dikirim !");
				window.location="<?php echo base_url() ?>agreement?<?php echo param_get() ?>";
			</script>
			<?php
		} else {
			$data = array(
				'konten' => 'agreement/minta_perbaiki',
	            'judul_page' => 'Upload Ulang Agreement',
			);

			$this->load->view('v_index', $data);
		}
		

	}

	public function delete($id)
	{
		$this->db->where('id_agree', $id);
		$file = $this->db->get('agreement')->row();
		unlink('files/agreement/'.$file->ktp_p1);
		unlink('files/agreement/'.$file->ktp_p2);
		unlink('files/agreement/'.$file->surat_kuasa_p1);
		unlink('files/agreement/'.$file->surat_kuasa_p2);

		$this->db->where('id_agree', $id);
		$this->db->delete('agreement');

		?>
		<script type="text/javascript">
			WebAppInterface.showToast("Data berhasil dihapus !");
			window.location="<?php echo base_url() ?>agreement?<?php echo param_get() ?>";
		</script>
		<?php

	}

}

/* End of file Agreement.php */
/* Location: ./application/controllers/Agreement.php */