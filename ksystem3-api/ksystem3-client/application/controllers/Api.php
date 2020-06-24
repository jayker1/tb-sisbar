<?php
require 'vendor/autoload.php';
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Users');
    }
    public function index()
    {

        $data['user'] = $this->Model_Users->getUsers();
        $this->load->view('users/users', $data);
    }
}
