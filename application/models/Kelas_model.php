<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends MY_Model
{

    protected $perPage = 10;

    public function getDefaultValues()
    {
        return [
            'rombel'    => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'     => 'rombel',
                'lable'     => 'Rombel',
                'rules'     => 'required'
            ]
        ];

        return $validationRules;
    }
}

/* End of file Kelas_model.php */
