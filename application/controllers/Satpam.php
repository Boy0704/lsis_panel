<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Satpam extends CI_Controller {

	public function index()
	{
		$this->load->view('satpam/load');
	}

	public function view()
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

	public function cek_lokasi($id)
	{
		$this->db->where('id', $id);
		$br = $this->db->get('log_lokasi')->row();
		$data['latitude']= $br->latitude;
		$data['longitude']= $br->longitude;
		$data['address']= $br->address;
		$data['nama']= get_data('users','id_user',$br->id_user,'nama');
		$data['date']= $br->created_at;
		$this->load->view('satpam/lihat_posisi',$data);
	}

	public function hari_ini()
	{
		$data = array(
            'konten' => 'satpam/jadwal_hari_ini',
            'judul_page' => 'Jadwal Satpam',
        );
        $this->load->view('v_index', $data);
	}

	public function all_jaga()
	{
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);
		$br = $this->db->get('log_lokasi')->row();
		$data['latitude']= $br->latitude;
		$data['longitude']= $br->longitude;
		$this->load->view('satpam/all_posisi', $data);
	}

	public function history($id_user)
	{
		$data = array(
            'konten' => 'satpam/history',
            'judul_page' => 'History Tracking',
        );
        $this->load->view('v_index', $data);
	}

	public function download($id_user)
	{
		$data = array(
            'konten' => 'satpam/download',
            'judul_page' => 'History Tracking',
        );
        $this->load->view('v_index', $data);
	}

	public function lokasi_satpam_all()
	{
		$this->db->select('a.id_user,b.nama,a.latitude,a.longitude,a.created_at');
		$this->db->from('log_lokasi a');
		$this->db->join('users b', 'a.id_user = b.id_user', 'inner');
		$this->db->join('jadwal_satpam_detail c', 'a.id_user = c.id_user', 'inner');
		$this->db->where('b.id_level', '8');
		$this->db->group_by('a.id_user');
		$this->db->order_by('a.created_at', 'desc');
		$data = $this->db->get();
		$attribs=array('id_user','nama','latitude','longitude','created_at');


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

	public function lokasi_satpam($id_user,$all='0')
	{
		$this->db->select('a.id_user,b.nama,a.latitude,a.longitude,a.created_at');
		$this->db->from('log_lokasi a');
		$this->db->join('users b', 'a.id_user = b.id_user', 'inner');
		$this->db->where('a.id_user', $id_user);
		$this->db->where('b.id_level', '8');
		$this->db->order_by('a.created_at', 'desc');
		if ($all == '1') {
			// code...
		} else {
			$this->db->limit(1);
		}
		
		$data = $this->db->get();
		$attribs=array('id_user','nama','latitude','longitude','created_at');


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