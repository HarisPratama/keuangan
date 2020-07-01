<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends MY_Model
{
    protected $perPage = 10;

    public function getDefaultValues()
    {
        return [
            'id_kelas'      => '',
            'nama'          => '',
            'nisn'          => '',
            'id_siswa_role' => '',
            'keringanan'    => '',
            'total_spp'     => ''
        ];
    }

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
                'rules' => 'trim|required|callback_unique_nisn'
            ],
            [
                'field' => 'id_siswa_role',
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

    public function ppdb_osis($nisn_siswa)
    {
        $this->db->select_sum('osis');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ppdb');
        if ($query->num_rows() > 0) {
            return $query->row()->osis;
        } else {
            return 0;
        }
    }

    public function ppdb_tabungan($nisn_siswa)
    {
        $this->db->select_sum('tabungan');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ppdb');
        if ($query->num_rows() > 0) {
            return $query->row()->tabungan;
        } else {
            return 0;
        }
    }

    public function ppdb_sat($nisn_siswa)
    {
        $this->db->select_sum('sat');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ppdb');
        if ($query->num_rows() > 0) {
            return $query->row()->sat;
        } else {
            return 0;
        }
    }

    public function ppdb_koperasi($nisn_siswa)
    {
        $this->db->select_sum('koperasi');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ppdb');
        if ($query->num_rows() > 0) {
            return $query->row()->koperasi;
        } else {
            return 0;
        }
    }

    public function totalSpp($nisn_siswa)
    {
        $query = "SELECT SUM(nominal + kjp) as total FROM spp where nisn_siswa = '$nisn_siswa'";
        $result = $this->db->query($query);
        return $result->row();
    }

    public function ujian_pts1($nisn_siswa)
    {
        $this->db->select_sum('pts1');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ujian');
        if ($query->num_rows() > 0) {
            return $query->row()->pts1;
        } else {
            return 0;
        }
    }

    public function ujian_pat1($nisn_siswa)
    {
        $this->db->select_sum('pat1');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ujian');
        if ($query->num_rows() > 0) {
            return $query->row()->pat1;
        } else {
            return 0;
        }
    }

    public function ujian_pts2($nisn_siswa)
    {
        $this->db->select_sum('pts2');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ujian');
        if ($query->num_rows() > 0) {
            return $query->row()->pts2;
        } else {
            return 0;
        }
    }

    public function ujian_pat2($nisn_siswa)
    {
        $this->db->select_sum('pat2');
        $this->db->where('nisn_siswa', $nisn_siswa);
        $query = $this->db->get('ujian');
        if ($query->num_rows() > 0) {
            return $query->row()->pat2;
        } else {
            return 0;
        }
    }
}

/* End of file Siswa_model.php */
