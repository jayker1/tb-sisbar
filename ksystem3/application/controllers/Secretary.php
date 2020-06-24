<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Secretary extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {

        $data['title'] = 'Information';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['announcement'] = $this->db->get('secretary_announcement')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('secretary/index', $data);
        $this->load->view('templates/footer');
    }

    public function information()
    {

        $data['title'] = 'Add Information';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('topic', 'Topic', 'required');
        $this->form_validation->set_rules('information', 'Information', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('secretary/information', $data);
            $this->load->view('templates/footer');
        } else {
            $date = date("Y/m/d h:i:s");
            $data = [
                'title' => $this->input->post('title'),
                'topic' => $this->input->post('topic'),
                'information' => $this->input->post('information'),
                'date_created' => $date
            ];
            $this->db->insert('secretary_announcement', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Information added!</div>');
            redirect('secretary/information');
        }
    }

    public function editInformation($id)
    {

        $data['title'] = 'Edit Information';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['announcement'] = $this->db->get_where('secretary_announcement', ['id' => $id])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('topic', 'Topic', 'required');
        $this->form_validation->set_rules('information', 'Information', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('secretary/editinformation', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->set('title', $this->input->post('title'));
            $this->db->set('topic', $this->input->post('topic'));
            $this->db->set('information', $this->input->post('information'));
            $this->db->set('date_created', date("Y/m/d h:i:s"));

            $this->db->where('id', $id);
            $this->db->update('secretary_announcement');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Information has been updated</div>');
            redirect('secretary');
        }
    }

    public function deleteInformation($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('secretary_announcement');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Information has been deleted!</div>');
        redirect('secretary');
    }

    public function schedule()
    {

        $data['title'] = 'Schedule';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['member'] = $this->db->get('user')->result_array();
        $data['schedule'] = $this->db->get('secretary_schedule')->result_array();


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('day', 'Day', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('secretary/schedule', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'time' => $this->input->post('time'),
                'day' => $this->input->post('day'),
            ];
            $this->db->insert('secretary_schedule', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Schedule added!</div>');
            redirect('secretary/schedule');
        }
    }

    public function editSchedule($id)
    {

        $data['title'] = 'Edit Schedule';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['member'] = $this->db->get('user')->result_array();
        $data['schedule'] = $this->db->get('secretary_schedule')->result_array();


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('day', 'Day', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('secretary/schedule', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $time = $this->input->post('time');
            $day = $this->input->post('day');
            $this->db->set('name', $name);
            $this->db->set('time', $time);
            $this->db->set('day', $day);
            $this->db->where('id', $id);
            $this->db->update('secretary_schedule');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Schedule has been updated</div>');
            redirect('secretary/schedule');
        }
    }

    public function deleteSchedule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('secretary_schedule');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Schedule has been deleted!</div>');
        redirect('secretary/schedule');
    }
}
