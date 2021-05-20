<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Satpam extends CI_Controller {

	public function index()
	{
		 $data = array(
            'konten' => 'satpam/view',
            'judul_page' => 'Daftar Semua Satpam',
        );
        $this->load->view('v_index', $data);
	}

	public function cek_posisi($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);
		$br = $this->db->get('log_lokasi')->row();
		$data['latitude']= $br->latitude;
		$data['longitude']= $br->longitude;
		$this->load->view('satpam/cek_posisi',$data);
	}

	public function lokasi_satpam($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);
		$data = $this->db->get('log_lokasi');
		$attribs=array('id_user','latitude','longitude','bearing','created_at');


	    $dom=new DOMDocument('1.0','utf-8');
	    $dom->formatOutput=true;
	    $dom->standalone=true;
	    $dom->recover=true;

	    $root=$dom->createElement('markers');
	    $dom->appendChild( $root );


	    foreach ($data->result() as $rs) {
	    	$node=$dom->createElement('marker');
	        $root->appendChild( $node );

	        foreach( $attribs as $attrib ){
	            $attr = $dom->createAttribute( $attrib );
	            $value= $dom->createTextNode( $rs->$attrib );
	            $attr->appendChild( $value );
	            $node->appendChild( $attr );
	        }
	    }

	    header("Content-Type: application/xml");
	    echo $dom->saveXML();



	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */