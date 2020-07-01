<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Management_model extends MY_Model
{

    protected $table = 'siswa';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_kelas',
                'lable' => 'ID Kelas',
                'rules' => 'required'
            ],
            [
                'field' => 'nama',
                'lable' => 'Nama',
                'rules' => 'required'
            ],
            [
                'field' => 'nisn',
                'lable' => 'NISN',
                'rules' => 'trim|required|numeric|callback_unique_nisn'
            ],
            [
                'field' => 'role',
                'lable' => 'Role SPP',
                'rules' => 'required'
            ],
            [
                'field' => 'keringanan',
                'lable' => 'Keringanan SPP',
                'rules' => 'numeric'
            ],
            [
                'field' => 'total_spp',
                'lable' => 'Total SPP',
                'rules' => 'numeric|required'
            ]
        ];

        return $validationRules;
    }
}

/* End of file Management_model.php */
