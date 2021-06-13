<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasus extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kasus_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kasus/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kasus/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kasus/index.html';
            $config['first_url'] = base_url() . 'kasus/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kasus_model->total_rows($q);
        $kasus = $this->Kasus_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kasus_data' => $kasus,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'kasus/kasus_list',
            'konten' => 'kasus/kasus_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Kasus_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kasus' => $row->id_kasus,
		'nomor_surat' => $row->nomor_surat,
		'tanggal_surat' => $row->tanggal_surat,
		'nama_pelapor' => $row->nama_pelapor,
		'tanggal_kejadian' => $row->tanggal_kejadian,
		'jlh' => $row->jlh,
		'kg' => $row->kg,
		'lokasi' => $row->lokasi,
		'nama_tersangka' => $row->nama_tersangka,
		'tindak_lanjut' => $row->tindak_lanjut,
		'keterangan' => $row->keterangan,
	    );
            $this->load->view('kasus/kasus_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kasus'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'kasus/kasus_form',
            'konten' => 'kasus/kasus_form',
            'button' => 'Simpan',
            'action' => site_url('kasus/create_action'),
	    'id_kasus' => set_value('id_kasus'),
	    'nomor_surat' => set_value('nomor_surat'),
	    'tanggal_surat' => set_value('tanggal_surat'),
	    'nama_pelapor' => set_value('nama_pelapor'),
	    'tanggal_kejadian' => set_value('tanggal_kejadian'),
	    'jlh' => set_value('jlh'),
	    'kg' => set_value('kg'),
	    'lokasi' => set_value('lokasi'),
	    'nama_tersangka' => set_value('nama_tersangka'),
	    'tindak_lanjut' => set_value('tindak_lanjut'),
        'dokumen' => set_value('dokumen'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $dokumen = upload_gambar_biasa('dokumen', 'files/kasus/', 'pdf', 10000, 'dokumen');

            $data = array(
		'nomor_surat' => $this->input->post('nomor_surat',TRUE),
		'tanggal_surat' => $this->input->post('tanggal_surat',TRUE),
		'nama_pelapor' => $this->input->post('nama_pelapor',TRUE),
		'tanggal_kejadian' => $this->input->post('tanggal_kejadian',TRUE),
		'jlh' => $this->input->post('jlh',TRUE),
		'kg' => $this->input->post('kg',TRUE),
		'lokasi' => $this->input->post('lokasi',TRUE),
		'nama_tersangka' => $this->input->post('nama_tersangka',TRUE),
		'tindak_lanjut' => $this->input->post('tindak_lanjut',TRUE),
        'dokumen' => $dokumen,
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Kasus_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kasus').'?'.param_get());
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kasus_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'kasus/kasus_form',
                'konten' => 'kasus/kasus_form',
                'button' => 'Update',
                'action' => site_url('kasus/update_action'),
		'id_kasus' => set_value('id_kasus', $row->id_kasus),
		'nomor_surat' => set_value('nomor_surat', $row->nomor_surat),
		'tanggal_surat' => set_value('tanggal_surat', $row->tanggal_surat),
		'nama_pelapor' => set_value('nama_pelapor', $row->nama_pelapor),
		'tanggal_kejadian' => set_value('tanggal_kejadian', $row->tanggal_kejadian),
		'jlh' => set_value('jlh', $row->jlh),
		'kg' => set_value('kg', $row->kg),
		'lokasi' => set_value('lokasi', $row->lokasi),
		'nama_tersangka' => set_value('nama_tersangka', $row->nama_tersangka),
		'tindak_lanjut' => set_value('tindak_lanjut', $row->tindak_lanjut),
        'dokumen' => $retVal = ($_FILES['dokumen']['name'] == '') ? $_POST['dokumen_old'] : upload_gambar_biasa('dokumen', 'files/kasus/', 'pdf', 10000, 'dokumen'),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kasus'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kasus', TRUE));
        } else {
            $data = array(
		'nomor_surat' => $this->input->post('nomor_surat',TRUE),
		'tanggal_surat' => $this->input->post('tanggal_surat',TRUE),
		'nama_pelapor' => $this->input->post('nama_pelapor',TRUE),
		'tanggal_kejadian' => $this->input->post('tanggal_kejadian',TRUE),
		'jlh' => $this->input->post('jlh',TRUE),
		'kg' => $this->input->post('kg',TRUE),
		'lokasi' => $this->input->post('lokasi',TRUE),
		'nama_tersangka' => $this->input->post('nama_tersangka',TRUE),
		'tindak_lanjut' => $this->input->post('tindak_lanjut',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Kasus_model->update($this->input->post('id_kasus', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kasus').'?'.param_get());
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kasus_model->get_by_id($id);

        if ($row) {
            $this->Kasus_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kasus').'?'.param_get());
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kasus').'?'.param_get());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomor_surat', 'nomor surat', 'trim|required');
	$this->form_validation->set_rules('tanggal_surat', 'tanggal surat', 'trim|required');
	$this->form_validation->set_rules('nama_pelapor', 'nama pelapor', 'trim|required');
	$this->form_validation->set_rules('tanggal_kejadian', 'tanggal kejadian', 'trim|required');
	$this->form_validation->set_rules('jlh', 'jlh', 'trim|required');
	$this->form_validation->set_rules('kg', 'kg', 'trim|required');
	$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
	$this->form_validation->set_rules('nama_tersangka', 'nama tersangka', 'trim|required');
	$this->form_validation->set_rules('tindak_lanjut', 'tindak lanjut', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_kasus', 'id_kasus', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kasus.xls";
        $judul = "kasus";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Surat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Surat");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelapor");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Kejadian");
	xlsWriteLabel($tablehead, $kolomhead++, "Jlh");
	xlsWriteLabel($tablehead, $kolomhead++, "Kg");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Tersangka");
	xlsWriteLabel($tablehead, $kolomhead++, "Tindak Lanjut");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Kasus_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_surat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_surat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelapor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_kejadian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jlh);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_tersangka);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tindak_lanjut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Kasus.php */
/* Location: ./application/controllers/Kasus.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-05-10 09:06:37 */
/* https://jualkoding.com */