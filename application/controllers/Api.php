<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {


	public function index_get()
	{
		$id = $this->get('id');
        $kontak = array(
        	"nama" => "By dsf",
        	"jk" => "sdff"
        );
        $this->response($kontak, 502);
	}

	public function login_post()
	{
		if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $this->db->where('username', $decoded_data->username);
        $this->db->where('password', $decoded_data->password);
        $user = $this->db->get('users');
        if ($user->num_rows() > 0) {
            $users = $user->row(); 
            $this->db->where('id_user', $users->id_user);
            $this->db->update('users', array('token'=>$decoded_data->token));
            $condition = array(
                'id_user' => $users->id_user,
                'nama' => $users->nama,
                'username' => $users->username,
                'password' => $users->password,
                'id_jabatan' => $users->id_jabatan,
                'jabatan' => get_data('jabatan','id_jabatan',$users->id_jabatan,'jabatan'),
                'foto' => $users->foto,
                'token' => $users->token
            );
            $message = array(
                'kode' => '200',
                'message' => 'berhasil',
                'data' => [$condition]
            );
        } else {
            $condition = array('data'=>"kosong");
            $message = array(
                'kode' => '404',
                'message' => 'Akun login tidak di temukan !',
                'data' => [$condition]
            );
        }

        $this->response($message, 200);
		
	}

    public function update_token_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $this->db->where('id_user', $decoded_data->id_user);
        $update = $this->db->update('users', array('token'=>$decoded_data->token));
        if ($update) {
            $condition = array('token'=>$decoded_data->token);
            $message = array(
                'kode' => '200',
                'message' => 'berhasil',
                'data' => [$condition]
            );
        } else {
            $condition = array('data'=>"kosong");
            $message = array(
                'kode' => '404',
                'message' => 'gagal !',
                'data' => [$condition]
            );
        }

        $this->response($message, 200);
    }

    public function kirim_pertanyaan_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $simpan = $this->db->insert('pertanyaan', array(
            'id_user' => $decoded_data->id_user,
            'pertanyaan' => $decoded_data->pertanyaan,
            'created_at' => get_waktu()
        ));
        if ($simpan) {
            $condition = array('id_user'=>$decoded_data->id_user);
            $message = array(
                'kode' => '200',
                'message' => 'berhasil',
                'data' => [$condition]
            );
        } else {
            $condition = array('data'=>"kosong");
            $message = array(
                'kode' => '404',
                'message' => 'gagal !',
                'data' => [$condition]
            );
        }

        $this->response($message, 200);
    }

    public function forum_get()
    {
        $forums = $this->db->get('pertanyaan');
        $data = array();
        foreach ($forums->result() as $rw) {
            array_push($data, array(
                'id_pertanyaan' => $rw->id_pertanyaan,
                'pertanyaan' => $rw->pertanyaan,
                'id_user'=> $rw->id_user,
                'nama_penanya' => get_data('users','id_user',$rw->id_user,'nama'),
                'foto' => get_data('users','id_user',$rw->id_user,'foto'),
                'waktu' => $rw->created_at

            ));
        }
        $message = array(
            'data' => $data
        );

        $this->response($message, 200);
    }




}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */