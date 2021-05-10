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

        $condition = array(
        	'username' => $decoded_data->username,
            'password' => sha1($decoded_data->password),
            //'token' => $decoded_data->token
        );
        $message = array(
            'code' => '200',
            'message' => 'found',
            'data' => [$condition]//$condition
        );

        $this->response($message, 200);
		
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */