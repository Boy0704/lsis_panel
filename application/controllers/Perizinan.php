<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perizinan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Perizinan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'perizinan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'perizinan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'perizinan/index.html';
            $config['first_url'] = base_url() . 'perizinan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Perizinan_model->total_rows($q);
        $perizinan = $this->Perizinan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'perizinan_data' => $perizinan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'perizinan/perizinan_list',
            'konten' => 'perizinan/perizinan_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Perizinan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_perizinan' => $row->id_perizinan,
		'unit_kerja' => $row->unit_kerja,
		'jenis' => $row->jenis,
		'nomor' => $row->nomor,
		'dasar_izin' => $row->dasar_izin,
		'dari' => $row->dari,
		'sampai' => $row->sampai,
	    );
            $this->load->view('perizinan/perizinan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perizinan'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'perizinan/perizinan_form',
            'konten' => 'perizinan/perizinan_form',
            'button' => 'Simpan',
            'action' => site_url('perizinan/create_action'),
	    'id_perizinan' => set_value('id_perizinan'),
	    'unit_kerja' => set_value('unit_kerja'),
	    'jenis' => set_value('jenis'),
	    'nomor' => set_value('nomor'),
	    'dasar_izin' => set_value('dasar_izin'),
	    'dari' => set_value('dari'),
	    'sampai' => set_value('sampai'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'unit_kerja' => $this->input->post('unit_kerja',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'nomor' => $this->input->post('nomor',TRUE),
		'dasar_izin' => $this->input->post('dasar_izin',TRUE),
		'dari' => $this->input->post('dari',TRUE),
		'sampai' => $this->input->post('sampai',TRUE),
	    );

            $this->Perizinan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('perizinan').'?'.param_get());
        }
    }
    
    public function update($id) 
    {
        $row = $this->Perizinan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'perizinan/perizinan_form',
                'konten' => 'perizinan/perizinan_form',
                'button' => 'Update',
                'action' => site_url('perizinan/update_action'),
		'id_perizinan' => set_value('id_perizinan', $row->id_perizinan),
		'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
		'jenis' => set_value('jenis', $row->jenis),
		'nomor' => set_value('nomor', $row->nomor),
		'dasar_izin' => set_value('dasar_izin', $row->dasar_izin),
		'dari' => set_value('dari', $row->dari),
		'sampai' => set_value('sampai', $row->sampai),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perizinan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_perizinan', TRUE));
        } else {
            $data = array(
		'unit_kerja' => $this->input->post('unit_kerja',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'nomor' => $this->input->post('nomor',TRUE),
		'dasar_izin' => $this->input->post('dasar_izin',TRUE),
		'dari' => $this->input->post('dari',TRUE),
		'sampai' => $this->input->post('sampai',TRUE),
	    );

            $this->Perizinan_model->update($this->input->post('id_perizinan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('perizinan').'?'.param_get());
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Perizinan_model->get_by_id($id);

        if ($row) {
            $this->Perizinan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('perizinan').'?'.param_get());
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perizinan').'?'.param_get());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('unit_kerja', 'unit kerja', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
	$this->form_validation->set_rules('dasar_izin', 'dasar izin', 'trim|required');
	$this->form_validation->set_rules('dari', 'dari', 'trim|required');
	$this->form_validation->set_rules('sampai', 'sampai', 'trim|required');

	$this->form_validation->set_rules('id_perizinan', 'id_perizinan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "perizinan.xls";
        $judul = "perizinan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Unit Kerja");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor");
	xlsWriteLabel($tablehead, $kolomhead++, "Dasar Izin");
	xlsWriteLabel($tablehead, $kolomhead++, "Dari");
	xlsWriteLabel($tablehead, $kolomhead++, "Sampai");

	foreach ($this->Perizinan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->unit_kerja);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dasar_izin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dari);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sampai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Perizinan.php */
/* Location: ./application/controllers/Perizinan.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-05-10 09:06:29 */
/* https://jualkoding.com */