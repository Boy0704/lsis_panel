<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_satpam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_satpam_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jadwal_satpam/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jadwal_satpam/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jadwal_satpam/index.html';
            $config['first_url'] = base_url() . 'jadwal_satpam/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_satpam_model->total_rows($q);
        $jadwal_satpam = $this->Jadwal_satpam_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jadwal_satpam_data' => $jadwal_satpam,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Jadwal Satpam',
            'konten' => 'jadwal_satpam/jadwal_satpam_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_satpam_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal' => $row->id_jadwal,
		'lokasi' => $row->lokasi,
		'tanggal' => $row->tanggal,
	    );
            $this->load->view('jadwal_satpam/jadwal_satpam_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_satpam'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Input Jadwal',
            'konten' => 'jadwal_satpam/jadwal_satpam_form',
            'button' => 'Create',
            'action' => site_url('jadwal_satpam/create_action'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'lokasi' => set_value('lokasi'),
	    'tanggal' => set_value('tanggal'),
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
		'lokasi' => $this->input->post('lokasi',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
        'user_at' => $this->input->get('id_user')
	    );

            $this->Jadwal_satpam_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jadwal_satpam').'?'.param_get());
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_satpam_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Update Jadwal',
                'konten' => 'jadwal_satpam/jadwal_satpam_form',
                'button' => 'Update',
                'action' => site_url('jadwal_satpam/update_action'),
		'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
		'lokasi' => set_value('lokasi', $row->lokasi),
		'tanggal' => set_value('tanggal', $row->tanggal),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_satpam').'?'.param_get());
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {
            $data = array(
		'lokasi' => $this->input->post('lokasi',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
        'user_at' => $this->input->get('id_user')
	    );

            $this->Jadwal_satpam_model->update($this->input->post('id_jadwal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jadwal_satpam').'?'.param_get());
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_satpam_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_satpam_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal_satpam'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_satpam').'?'.param_get());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

	$this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jadwal_satpam.php */
/* Location: ./application/controllers/Jadwal_satpam.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-05-29 05:15:40 */
/* https://jualkoding.com */