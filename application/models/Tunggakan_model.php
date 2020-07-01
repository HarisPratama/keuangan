<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Tunggakan_model extends MY_Model
{

    public function getDefaultValues()
    {
        return  [
            'id_kelas'              => '',
            'nisn_siswa'            => '',
            'total_tunggakan'       => '',
            'bayar'                 => '',
            'keterangan'            => '',
            'tanggal'               => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_kelas',
                'lable' => 'Kelas',
                'rules' => 'required'
            ],
            [
                'field' => 'nisn_siswa',
                'lable' => 'NISN',
                'rules' => 'required'
            ],
            [
                'field' => 'total_tunggakan',
                'lable' => 'Total Tunggakan',
                'rules' => 'numeric'
            ],
            [
                'field' => 'bayar',
                'lable' => 'Bayar',
                'rules' => 'numeric'
            ],
            [
                'field' => 'tanggal',
                'lable' => 'Tanggal',
                'rules' => 'required'
            ],
        ];

        return $validationRules;
    }
}

/* End of file Tunggakan_model.php */
