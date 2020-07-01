<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Spp_model extends MY_Model
{

    public function getDefaultValues()
    {
        return  [
            'id_kelas'      => '',
            'nisn_siswa'    => '',
            'nominal'       => '',
            'kjp'           => '',
            'bulan'         => '',
            'tanggal'       => ''
        ];
    }

    function maximumSpp()
    {
        if ($this->input->post('nominal', true) < 350000) {
            $this->form_validation->set_message(
                'nominal',
                'The %s field must be less than 24'
            );
            return FALSE;
        } else {
            return TRUE;
        }
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
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'nominal',
                'lable' => 'Nominal',
                'rules' => ''
            ],
            [
                'field' => 'kjp',
                'lable' => 'KJP',
                'rules' => ''
            ],
            [
                'field' => 'bulan',
                'lable' => 'Bulan',
                'rules' => 'required'
            ],
            [
                'field' => 'tanggal',
                'lable' => 'Tanggal',
                'rules' => 'required'
            ],
        ];

        return $validationRules;
    }

    public function sppDanaSendiri($nisn_siswa)
    {
        $query = "SELECT 
        sum(if( bulan = 'Januari', nominal, NULL))  as januari, 
        sum(if( bulan = 'Februari', nominal, NULL))  as februari, 
        sum(if( bulan = 'Maret', nominal, NULL))  as maret, 
        sum(if( bulan = 'April', nominal, NULL))  as april, 
        sum(if( bulan = 'Mei', nominal, NULL))  as mei, 
        sum(if( bulan = 'Juni', nominal, NULL))  as juni, 
        sum(if( bulan = 'Juli', nominal, NULL))  as juli, 
        sum(if( bulan = 'Agustus', nominal, NULL))  as agustus, 
        sum(if( bulan = 'September', nominal, NULL))  as september, 
        sum(if( bulan = 'Oktober', nominal, NULL))  as oktober, 
        sum(if( bulan = 'November', nominal, NULL))  as november, 
        sum(if( bulan = 'Desember', nominal, NULL))  as desember
        FROM spp WHERE nisn_siswa = '$nisn_siswa'";
        $result = $this->db->query($query);
        return $result->row();
    }

    public function sppDanaKjp($nisn_siswa)
    {
        $query = "SELECT 
        sum(if( bulan = 'Januari', kjp, NULL))  as januari, 
        sum(if( bulan = 'Februari', kjp, NULL))  as februari, 
        sum(if( bulan = 'Maret', kjp, NULL))  as maret, 
        sum(if( bulan = 'April', kjp, NULL))  as april, 
        sum(if( bulan = 'Mei', kjp, NULL))  as mei, 
        sum(if( bulan = 'Juni', kjp, NULL))  as juni, 
        sum(if( bulan = 'Juli', kjp, NULL))  as juli, 
        sum(if( bulan = 'Agustus', kjp, NULL))  as agustus, 
        sum(if( bulan = 'September', kjp, NULL))  as september, 
        sum(if( bulan = 'Oktober', kjp, NULL))  as oktober, 
        sum(if( bulan = 'November', kjp, NULL))  as november, 
        sum(if( bulan = 'Desember', kjp, NULL))  as desember
        FROM spp WHERE nisn_siswa = '$nisn_siswa'";
        $result = $this->db->query($query);
        return $result->row();
    }

    public function totalSpp($nisn_siswa)
    {
        $query = "SELECT SUM(nominal + kjp) as total FROM spp where nisn_siswa = '$nisn_siswa'";
        $result = $this->db->query($query);
        return $result->row();
    }

    public function fetch_kelas()
    {
        $this->spp->orderBy('rombel', 'ASC');
        $query = $this->db->get('kelas');
        return $query->result();
    }

    function fetch_siswa($id_kelas)
    {
        $this->db->where('id_kelas', $id_kelas);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('siswa');
        $output = '<option value="">Pilih Siswa</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->nisn . '">' . $row->nama . '</option>';
        }
        return $output;
    }

    public function getFilterSppNow($startdate, $enddate)
    {
        $startdate          = date("Y-m-d");
        $enddate            = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->spp->select([
            'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }

    public function getFilterSpp($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->spp->select([
            'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }

    public function getspp($id)
    {
        $query = $this->spp->select([
            'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas')
            ->where('id', $id);
        return $query->result_array();
    }

    public function getValSpp()
    {
        $query = $this->spp->select([
            'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }
}

/* End of file Spp_model.php */
