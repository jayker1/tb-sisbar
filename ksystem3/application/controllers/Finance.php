<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Financial Report';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['journal'] = $this->db->query("SELECT a.id,a.transaction_id,a.description,a.image,a.transaction_date,outcome,income FROM finance_journal a LEFT JOIN finance_detail b on a.id = b.journal_id order by a.transaction_date asc")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/index', $data);
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $data['title'] = 'Financial Report';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $first_dt = $this->input->post('first_date');
        $last_dt = $this->input->post('last_date');


        $first_cash = "SELECT a.id,a.transaction_id,a.description,a.transaction_date,outcome,income FROM finance_journal a 
        LEFT JOIN finance_detail b on a.id = b.journal_id where date(transaction_date) < '$first_dt' order by a.transaction_date asc";

        $query = "SELECT a.id,a.transaction_id,a.description,a.transaction_date,outcome,income FROM finance_journal a 
        LEFT JOIN finance_detail b on a.id = b.journal_id where date(transaction_date)  between '$first_dt' and '$last_dt'  order by a.transaction_date asc";

        $data['first_cash'] = $this->db->query($first_cash)->result_array();
        $data['journal'] = $this->db->query($query)->result_array();

        $this->session->set_flashdata('first', $first_dt);
        $this->session->set_flashdata('last', $last_dt);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/search', $data);
        $this->load->view('templates/footer');
    }

    public function cashIn()
    {

        $data['title'] = 'Cash In';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/cash-in', $data);
            $this->load->view('templates/footer');
        } else {
            $transaction_id = date("dmY") . '-' . rand(0000, 9999);
            $transaction =  $this->db->get_where('finance_transaction', ['transaction_id' => $transaction_id])->row_array();
            if ($transaction) {
                $transaction_id = date("dmY") . '-' . rand(0000, 9999);
            }
            $data = [
                'transaction_id' => $transaction_id,
                'type' => 'Cash In',
                'description' => $this->input->post('description'),
                'transaction_date' => $this->input->post('date'),
                'image' => $this->receipt(),
                'amount' => preg_replace('/[^0-9]/', '', $this->input->post('amount'))
            ];
            $this->db->insert('finance_transaction', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> New Income Added! </div>');
            redirect('finance/cashIn');
        }
    }

    public function receipt()
    {
        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/receipt';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                return $this->upload->data('file_name');
            }
        }
        return "default.jpg";
    }

    public function cashOut()
    {

        $data['title'] = 'Cash Out';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/cash-out', $data);
            $this->load->view('templates/footer');
        } else {
            $transaction_id = date("dmY") . '-' . rand(0000, 9999);
            $transaction =  $this->db->get_where('finance_transaction', ['transaction_id' => $transaction_id])->row_array();
            if ($transaction) {
                $transaction_id = date("dmY") . '-' . rand(0000, 9999);
            }
            $data = [
                'transaction_id' => $transaction_id,
                'type' => 'Cash Out',
                'description' => $this->input->post('description'),
                'transaction_date' => $this->input->post('date'),
                'image' => $this->receipt(),
                'amount' => preg_replace('/[^0-9]/', '', $this->input->post('amount'))
            ];
            $this->db->insert('finance_transaction', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> New Outcome Added! </div>');
            redirect('finance/cashOut');
        }
    }

    public function print()
    {
        $type = $this->input->get('p');
        $first_dt = $this->input->get('first');
        $last_dt = $this->input->get('last');
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        if ($type = 'excel') {
            if ($last_dt == null && $first_dt == null) {
                $first_cash = "SELECT a.id,a.transaction_id,a.description,a.transaction_date,outcome,income FROM finance_journal a
                LEFT JOIN finance_detail b on a.id = b.journal_id where date(transaction_date) < '$first_dt' order by a.transaction_date asc";

                $query = "SELECT a.id,a.transaction_id,a.description,a.transaction_date,outcome,income FROM finance_journal a 
               LEFT JOIN finance_detail b on a.id = b.journal_id  order by a.transaction_date asc";
            } else {
                $first_cash = "SELECT a.id,a.transaction_id,a.description,a.transaction_date,outcome,income FROM finance_journal a
                LEFT JOIN finance_detail b on a.id = b.journal_id where date(transaction_date) < '$first_dt' order by a.transaction_date asc";

                $query = "SELECT a.id,a.transaction_id,a.description,a.transaction_date,outcome,income FROM finance_journal a 
               LEFT JOIN finance_detail b on a.id = b.journal_id where date(transaction_date)  between '$first_dt' and '$last_dt'  order by a.transaction_date asc";
            }

            $data['first_cash'] = $this->db->query($first_cash)->result_array();
            $data['journal'] = $this->db->query($query)->result_array();

            $this->session->set_flashdata('first', $first_dt);
            $this->session->set_flashdata('last', $last_dt);

            $this->load->view('print/excel', $data);
        } else {
            #
        }
    }
}
