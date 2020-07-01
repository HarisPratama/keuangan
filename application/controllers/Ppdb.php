<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Ppdb extends MY_Controller
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
        $data['title']          = 'Input Pembayaran PPDB';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->ppdb->getFilterPpdbNow($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->ppdb
            ->getFilterPpdbNow($startdate, $enddate)
            ->count();
        $data['pagination'] = $this->ppdb->makePagination(
            base_url("ppdb"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/ppdb/index';
        $this->view($data);
    }

    public function filter($page = null)
    {
        $data['title']          = 'Input PPDB';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->ppdb->getFilterPpdb($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->ppdb
            ->getFilterPpdbNow($startdate, $enddate)
            ->count();
        $data['pagination'] = $this->ppdb->makePagination(
            base_url("ppdb"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/ppdb/index';
        $this->view($data);
    }

    public function edit($id)
    {
        $data['content'] = $this->ppdb->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('ppdb'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->ppdb->validate()) {
            $data['title']          = 'Edit Inputan ppdb';
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['form_action']    = base_url("ppdb/edit/$id");
            $data['page']           = 'pages/ppdb/form';

            $this->view($data);
            return;
        }

        $data['input'] = str_replace(".", "", $this->input->post(null, true));

        if ($this->ppdb->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url("ppdb"));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('ppdb'));
        }

        $ppdb = $this->ppdb->where('id', $id)->first();

        if (!$ppdb) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('ppdb'));
        }

        if ($this->ppdb->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }
        redirect(base_url('ppdb'));
    }

    public function detail($nisn_siswa)
    {
        $data['title']          = 'Detail PPDB';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']        = $this->ppdb->select([
            'ppdb.id', 'ppdb.id_kelas', 'ppdb.nisn_siswa', 'ppdb.osis', 'ppdb.tabungan', 'ppdb.sat', 'ppdb.koperasi', 'ppdb.keterangan', 'ppdb.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas')
            ->where('nisn_siswa', $nisn_siswa)
            ->first();
        $data['page']               = 'pages/spp/detail';
        $this->view($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->ppdb->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->ppdb->validate()) {
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['title']          = 'Tambah ppdb';
            $data['input']          = $input;
            $data['form_action']    = base_url('ppdb/create');
            $data['page']           = 'pages/ppdb/form';
            $data['kelas']          = $this->ppdb->fetch_kelas();

            $this->view($data);
            return;
        }

        $input = str_replace(".", "", $this->input->post(null, true));

        if ($this->ppdb->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url('ppdb'));
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
            redirect(base_url('ppdb'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']                  = 'SPP';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']        = $this->ppdb->select([
            'ppdb.id', 'ppdb.id_kelas', 'ppdb.nisn_siswa', 'ppdb.osis', 'ppdb.tabungan', 'ppdb.sat', 'ppdb.koperasi', 'ppdb.keterangan', 'ppdb.tanggal', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas')
            ->paginate($page)
            ->like('nisn_siswa', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows']             = $this->ppdb->like('nisn_siswa', $keyword)->count();
        $data['pagination']             = $this->ppdb->makePagination(
            base_url('ppdb'),
            2,
            $data['total_rows']
        );

        $data['page']                   = "pages/ppdb/index";

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('ppdb'));
    }
}

/* End of file Ppdb.php */
