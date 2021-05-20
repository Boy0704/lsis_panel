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
                'id_level' => $users->id_level,
                'level' => get_data('level','id_level',$users->id_level,'level'),
                'jabatan' => $users->jabatan,
                'foto' => $users->foto,
                'token' => $users->token,
                'status_gps' => $users->status_gps
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
        $this->db->order_by('id_pertanyaan', 'desc');
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

    public function jawaban_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $this->db->where('id_pertanyaan', $decoded_data->id_pertanyaan);
        $this->db->order_by('id_jawaban', 'desc');
        $forums = $this->db->get('jawaban');
        $data = array();
        foreach ($forums->result() as $rw) {
            array_push($data, array(
                'jawaban' => $rw->jawaban,
                'id_user'=> $rw->id_user,
                'nama_penjawab' => get_data('users','id_user',$rw->id_user,'nama'),
                'foto' => get_data('users','id_user',$rw->id_user,'foto'),
                'waktu' => $rw->created_at

            ));
        }
        $message = array(
            'data' => $data
        );

        $this->response($message, 200);
    }

    public function kirim_jawaban_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $simpan = $this->db->insert('jawaban', array(
            'id_user' => $decoded_data->id_user,
            'id_pertanyaan' => $decoded_data->id_pertanyaan,
            'jawaban' => $decoded_data->jawaban,
            'created_at' => get_waktu()
        ));
        if ($simpan) {
            $condition = array('id_user'=>$decoded_data->id_user,'id_pertanyaan'=>$decoded_data->id_pertanyaan);
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

    public function edit_profil_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $image = $decoded_data->foto;
        $namafoto = time() . '-' . rand(0, 99999) . ".jpg";
        $path = "image/user/" . $namafoto;
        file_put_contents($path, base64_decode($image));

        $this->db->where('id_user', $decoded_data->id_user);
        $update =  $this->db->update('users', array(
            'nama' => $decoded_data->nama,
            'username' => $decoded_data->username,
            'password' => ($decoded_data->password == '') ? $decoded_data->password_old : $decoded_data->password,
            'foto' => ($decoded_data->foto == '') ? $decoded_data->foto_old : $namafoto,
        ));
        if ($update) {
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

    public function update_location_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $this->db->where('id_user', $decoded_data->id_user);
        $this->db->where('latitude', $decoded_data->latitude);
        $this->db->where('longitude', $decoded_data->longitude);
        $this->db->like('created_at', date('Y-m-d'), 'AFTER');
        $cek = $this->db->get('log_lokasi');
        if ($cek->num_rows() > 0) {
            $condition = array('data'=>"kosong");
            $message = array(
                'kode' => '404',
                'message' => 'diabaikan !',
                'data' => [$condition]
            );
        } else {
            $simpan = $this->db->insert('log_lokasi', array(
                'id_user'=>$decoded_data->id_user,
                'latitude' => $decoded_data->latitude,
                'longitude' => $decoded_data->longitude,
                'bearing' => $decoded_data->bearing,
                'created_at' => get_waktu()
                )
            );
            if ($simpan) {
                $condition = array(
                    'id_user'=>$decoded_data->id_user,
                    'latitude' => $decoded_data->latitude,
                    'longitude' => $decoded_data->longitude,
                    'bearing' => $decoded_data->bearing,
                    'created_at' => get_waktu()
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
                    'message' => 'gagal !',
                    'data' => [$condition]
                );
            }
        }

        

        $this->response($message, 200);
    }

    public function set_on_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        if ($decoded_data->on == true) {
            $on = "1";
        } else {
            $on = "4";
        }
        $this->db->where('id_user', $decoded_data->id_user);
        $update = $this->db->update('users', array('status_gps'=>$on));
        if ($update) {
            $condition = array('token'=>$decoded_data->id_user);
            $message = array(
                'kode' => $on,
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




}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */