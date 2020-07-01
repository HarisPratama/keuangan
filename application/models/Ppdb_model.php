<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ppdb_model extends MY_Model
{

    public function getDefaultValues()
    {
        return  [
            'id_kelas'      => '',
            'nisn_siswa'    => '',
            'osis'          => '',
            'tabungan'      => '',
            'sat'           => '',
            'koperasi'      => '',
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
                'field' => 'osis',
                'lable' => 'OSIS',
                'rules' => ''
            ],
            [
                'field' => 'tabungan',
                'lable' => 'Tabungan',
                'rules' => ''
            ],
            [
                'field' => 'sat',
                'lable' => 'SAT',
                'rules' => ''
            ],
            [
                'field' => 'koperasi',
                'lable' => 'Koperasi',
                'rules' => ''
            ],
            [
                'field' => 'keterangan',
                'lable' => 'Keterangan',
                'rules' => ''
            ],
            [
                'field' => 'tanggal',
                'lable' => 'Tanggal',
                'rules' => 'required'
            ],
        ];

        return $validationRules;
    }

    public function fetch_kelas()
    {
        $this->ppdb->orderBy('rombel', 'ASC');
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

    public function getFilterPpdbNow($startdate, $enddate)
    {
        $startdate          = date("Y-m-d");
        $enddate            = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->ppdb->select([
            'ppdb.id', 'ppdb.id_kelas', 'ppdb.nisn_siswa', 'ppdb.osis', 'ppdb.tabungan', 'ppdb.sat', 'ppdb.koperasi', 'ppdb.keterangan', 'ppdb.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }

    public function getFilterPpdb($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->ppdb->select([
            'ppdb.id', 'ppdb.id_kelas', 'ppdb.nisn_siswa', 'ppdb.osis', 'ppdb.tabungan', 'ppdb.sat', 'ppdb.koperasi', 'ppdb.keterangan', 'ppdb.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas');
        return $query;
    }
}

/* End of file Ppdb_model.php */
