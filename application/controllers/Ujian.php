<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index($page = null)
    {
        $data['title']          = 'Input Pembayaran Ujian';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->ujian->getFilterUjianNow($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->ujian
            ->getFilterUjianNow($startdate, $enddate)
            ->count();
        $data['pagination'] = $this->ujian->makePagination(
            base_url("ujian"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/ujian/index';
        $this->view($data);
    }

    public function filter($page = null)
    {
        $data['title']          = 'Input PPDB';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->ujian->getFilterUjian($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->ujian
            ->getFilterUjian($startdate, $enddate)
            ->count();
        $data['pagination'] = $this->ujian->makePagination(
            base_url("ujian"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/ujian/index';
        $this->view($data);
    }

    public function edit($id)
    {
        $data['content'] = $this->ujian->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('ujian'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->ujian->validate()) {
            $data['title']          = 'Edit Inputan ujian';
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['form_action']    = base_url("ujian/edit/$id");
            $data['page']           = 'pages/ujian/form';

            $this->view($data);
            return;
        }

        $data['input'] = str_replace(".", "", $this->input->post(null, true));

        if ($this->ujian->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url("ujian"));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('ujian'));
        }

        $ujian = $this->ujian->where('id', $id)->first();

        if (!$ujian) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('ujian'));
        }

        if ($this->ujian->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }
        redirect(base_url('ujian'));
    }

    public function detail($nisn_siswa)
    {
        $data['title']          = 'Detail Pembayaran Ujian';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']        = $this->ujian->select([
            'ujian.id', 'ujian.id_kelas', 'ujian.nisn_siswa', 'ujian.pts1', 'ujian.pat1', 'ujian.pts2', 'ujian.pat2', 'ujian.keterangan', 'ujian.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas')
            ->where('nisn_siswa', $nisn_siswa)
            ->first();
        $data['page']               = 'pages/ujian/detail';
        $this->view($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->ujian->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->ujian->validate()) {
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['title']          = 'Tambah Pembayaran Ujian Siswa';
            $data['input']          = $input;
            $data['form_action']    = base_url('ujian/create');
            $data['page']           = 'pages/ujian/form';
            $data['kelas']          = $this->ujian->fetch_kelas();

            $this->view($data);
            return;
        }

        $input = str_replace(".", "", $this->input->post(null, true));

        if ($this->ujian->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url('ujian'));
    }

    public function fetch_siswa()
    {
        if ($this->input->post('id_kelas')) {
            echo $this->spp->fetch_siswa($this->input->post('id_kelas'));
        }
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('ujian'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']                  = 'Administrasi Ujian';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']        = $this->ujian->select([
            'ujian.id', 'ujian.id_kelas', 'ujian.nisn_siswa', 'ujian.pts1', 'ujian.pat1', 'ujian.pts2', 'ujian.pat2', 'ujian.keterangan', 'ujian.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas')
            ->paginate($page)
            ->like('nisn_siswa', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows']             = $this->ujian->like('nisn_siswa', $keyword)->count();
        $data['pagination']             = $this->ujian->makePagination(
            base_url('ujian'),
            2,
            $data['total_rows']
        );

        $data['page']                   = "pages/ujian/index";

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('ujian'));
    }
}

/* End of file Ujian.php */
