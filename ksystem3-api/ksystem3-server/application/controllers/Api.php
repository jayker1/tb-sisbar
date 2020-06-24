<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users');
    }
    public function index_get()
    {
        $users = $this->users->getUsers();

        if ($users) {
            $this->response([
                'status' => true,
                'data' => $users
            ], RestController::HTTP_OK);
        }
    }
}
