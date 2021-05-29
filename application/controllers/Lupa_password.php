<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends CI_Controller {

	public function index()
	{
		$data['view'] = 'form';
		$this->load->view('lupa_password', $data);
	}

	public function aksi()
	{
		$email = $this->input->post('email');

		$this->db->where('email', $email);
		$cek = $this->db->get('users');
		if ($cek->num_rows() == 1) {
			?>
			<script type="text/javascript">
				WebAppInterface.showToast("Password sudah dikirim ke email anda !");
				window.location="<?php echo base_url() ?>lupa_password/berhasil";
			</script>
			<?php
		} else {
			?>
			<script type="text/javascript">
				WebAppInterface.showToast("Email kamu tidak ditemukan !");
				WebAppInterface.vibrate(1000);
				window.location="<?php echo base_url() ?>lupa_password";
			</script>
			<?php
		}
	}

	public function berhasil()
	{
		$data['view'] = 'berhasil';
		$this->load->view('lupa_password', $data);
	}

}

/* End of file Lupa_password.php */
/* Location: ./application/controllers/Lupa_password.php */