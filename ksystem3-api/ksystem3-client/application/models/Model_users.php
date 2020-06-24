<?php
defined('BASEPATH') or exit('No direct script access allowed');


use GuzzleHttp\Client;

class Model_users extends CI_Model
{

    public function getUsers()
    {
        $client = new Client();

        $response = $client->request('GET', 'http://localhost/ksystem3-api/ksystem3-server/api/');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }
}
