<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_satpam_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_satpam_detail_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jadwal_satpam_detail/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jadwal_satpam_detail/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jadwal_satpam_detail/index.html';
            $config['first_url'] = base_url() . 'jadwal_satpam_detail/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_satpam_detail_model->total_rows($q);
        $jadwal_satpam_detail = $this->Jadwal_satpam_detail_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jadwal_satpam_detail_data' => $jadwal_satpam_detail,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Detail Jadwal Tgl '.get_data('jadwal_satpam','id_jadwal',$this->input->get('id_jadwal'),'tanggal'),
            'konten' => 'jadwal_satpam_detail/jadwal_satpam_detail_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_satpam_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal_detail' => $row->id_jadwal_detail,
		'id_jadwal' => $row->id_jadwal,
		'id_user' => $row->id_user,
		'shift' => $row->shift,
		'area' => $row->area,
	    );
            $this->load->view('jadwal_satpam_detail/jadwal_satpam_detail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_satpam_detail'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Detail Jadwal',
            'konten' => 'jadwal_satpam_detail/jadwal_satpam_detail_form',
            'button' => 'Create',
            'action' => site_url('jadwal_satpam_detail/create_action'),
	    'id_jadwal_detail' => set_value('id_jadwal_detail'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'id_user' => set_value('id_user'),
	    'shift' => set_value('shift'),
	    'area' => set_value('area'),
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
		'id_jadwal' => $this->input->post('id_jadwal',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'shift' => $this->input->post('shift',TRUE),
		'area' => $this->input->post('area',TRUE),
        'user_at' => $this->input->get('id_user')
	    );

            $this->Jadwal_satpam_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jadwal_satpam_detail').'?'.param_get());
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_satpam_detail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Detail Jadwal',
                'konten' => 'jadwal_satpam_detail/jadwal_satpam_detail_form',
                'button' => 'Update',
                'action' => site_url('jadwal_satpam_detail/update_action'),
		'id_jadwal_detail' => set_value('id_jadwal_detail', $row->id_jadwal_detail),
		'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
		'id_user' => set_value('id_user', $row->id_user),
		'shift' => set_value('shift', $row->shift),
		'area' => set_value('area', $row->area),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_satpam_detail').'?'.param_get());
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal_detail', TRUE));
        } else {
            $data = array(
		'id_jadwal' => $this->input->post('id_jadwal',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'shift' => $this->input->post('shift',TRUE),
		'area' => $this->input->post('area',TRUE),
        'user_at' => $this->input->get('id_user')
	    );

            $this->Jadwal_satpam_detail_model->update($this->input->post('id_jadwal_detail', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jadwal_satpam_detail').'?'.param_get());
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_satpam_detail_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_satpam_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal_satpam_detail').'?'.param_get());
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_satpam_detail').'?'.param_get());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_jadwal', 'id jadwal', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('shift', 'shift', 'trim|required');
	$this->form_validation->set_rules('area', 'area', 'trim|required');

	$this->form_validation->set_rules('id_jadwal_detail', 'id_jadwal_detail', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jadwal_satpam_detail.php */
/* Location: ./application/controllers/Jadwal_satpam_detail.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-05-29 05:15:49 */
/* https://jualkoding.com */