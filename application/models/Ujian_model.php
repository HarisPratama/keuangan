<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ujian_model extends MY_Model
{

    public function getDefaultValues()
    {
        return  [
            'id_kelas'      => '',
            'nisn_siswa'    => '',
            'pts1'          => '',
            'pat1'           => '',
            'pts2'          => '',
            'pat2'          => '',
            'keterangan'    => '',
            'tanggal'       => ''
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
                'field' => 'pts1',
                'lable' => 'PTS 1',
                'rules' => ''
            ],
            [
                'field' => 'pat1',
                'lable' => 'PAT 1',
                'rules' => ''
            ],
            [
                'field' => 'pts2',
                'lable' => 'PTS 2',
                'rules' => ''
            ],
            [
                'field' => 'pat2',
                'lable' => 'PAT 2',
                'rules' => ''
            ],
            [
                'field' => 'tanggal',
                'lable' => 'Tanggal',
                'rules' => 'required'
            ]
        ];

        return $validationRules;
    }

    public function fetch_kelas()
    {
        $this->ujian->orderBy('rombel', 'ASC');
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

    public function getFilterUjianNow($startdate, $enddate)
    {
        $startdate          = date("Y-m-d");
        $enddate            = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->ujian->select([
            'ujian.id', 'ujian.id_kelas', 'ujian.nisn_siswa', 'ujian.pts1', 'ujian.pat1', 'ujian.pts2', 'ujian.pat2',  'ujian.keterangan', 'ujian.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }

    public function getFilterUjian($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->ujian->select([
            'ujian.id', 'ujian.id_kelas', 'ujian.nisn_siswa', 'ujian.pts1', 'ujian.pat1', 'ujian.pts2', 'ujian.pat2',  'ujian.keterangan', 'ujian.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }
}

/* End of file Ujian_model.php */
