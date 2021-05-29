<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fruit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Fruit_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'fruit/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'fruit/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'fruit/index.html';
            $config['first_url'] = base_url() . 'fruit/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Fruit_model->total_rows($q);
        $fruit = $this->Fruit_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'fruit_data' => $fruit,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Supir Truk',
            'konten' => 'fruit/fruit_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Fruit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_fruit' => $row->id_fruit,
		'id_user' => $row->id_user,
		'no_plat' => $row->no_plat,
		'afdeling' => $row->afdeling,
		'tgl_angkut' => $row->tgl_angkut,
		'tgl_bongkar' => $row->tgl_bongkar,
	    );
            $this->load->view('fruit/fruit_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fruit'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Form Supir Truk',
            'konten' => 'fruit/fruit_form',
            'button' => 'Create',
            'action' => site_url('fruit/create_action'),
	    'id_fruit' => set_value('id_fruit'),
	    'id_user' => set_value('id_user'),
	    'no_plat' => set_value('no_plat'),
	    'afdeling' => set_value('afdeling'),
	    'tgl_angkut' => set_value('tgl_angkut'),
	    'tgl_bongkar' => set_value('tgl_bongkar'),
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
		'id_user' => $this->input->post('id_user',TRUE),
		'no_plat' => $this->input->post('no_plat',TRUE),
		'afdeling' => $this->input->post('afdeling',TRUE),
		'tgl_angkut' => $this->input->post('tgl_angkut',TRUE),
		'tgl_bongkar' => $this->input->post('tgl_bongkar',TRUE),
        'user_at' => $this->input->get('id_user')
	    );

            $this->Fruit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('fruit').'?'.param_get());
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fruit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Supir Truk',
                'konten' => 'fruit/fruit_form',
                'button' => 'Update',
                'action' => site_url('fruit/update_action'),
		'id_fruit' => set_value('id_fruit', $row->id_fruit),
		'id_user' => set_value('id_user', $row->id_user),
		'no_plat' => set_value('no_plat', $row->no_plat),
		'afdeling' => set_value('afdeling', $row->afdeling),
		'tgl_angkut' => set_value('tgl_angkut', $row->tgl_angkut),
		'tgl_bongkar' => set_value('tgl_bongkar', $row->tgl_bongkar),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fruit').'?'.param_get());
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fruit', TRUE));
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'no_plat' => $this->input->post('no_plat',TRUE),
		'afdeling' => $this->input->post('afdeling',TRUE),
		'tgl_angkut' => $this->input->post('tgl_angkut',TRUE),
		'tgl_bongkar' => $this->input->post('tgl_bongkar',TRUE),
        'user_at' => $this->input->get('id_user')
	    );

            $this->Fruit_model->update($this->input->post('id_fruit', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fruit').'?'.param_get());
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fruit_model->get_by_id($id);

        if ($row) {
            $this->Fruit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('fruit').'?'.param_get());
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fruit').'?'.param_get());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('no_plat', 'no plat', 'trim|required');
	$this->form_validation->set_rules('afdeling', 'afdeling', 'trim|required');
	$this->form_validation->set_rules('tgl_angkut', 'tgl angkut', 'trim|required');
	$this->form_validation->set_rules('tgl_bongkar', 'tgl bongkar', 'trim|required');

	$this->form_validation->set_rules('id_fruit', 'id_fruit', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Fruit.php */
/* Location: ./application/controllers/Fruit.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-05-29 05:23:45 */
/* https://jualkoding.com */