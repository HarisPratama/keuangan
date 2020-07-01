<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title']          = 'Administrasi Siswa';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['total_rows']     = $this->siswa->count();
        $data['pagination']     = $this->siswa->makePagination(
            base_url('siswa'),
            2,
            $data['total_rows']
        );

        $data['page']           = 'pages/siswa/index';

        $this->view($data);
    }

    public function sortir($rombel, $page = null)
    {
        $data['title']      = 'Kelas';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']    = $this->siswa->select(
            [
                'siswa.id', 'siswa.id_kelas AS siswa_id_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'siswa_role.id', 'siswa_role.role', 'kelas.id AS kelas_id', 'kelas.rombel',
            ]
        )
            ->join4('siswa_role')
            ->join('kelas')
            ->where('kelas.rombel', $rombel)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->siswa
            ->where('kelas.rombel', $rombel)
            ->join('kelas')
            ->count();
        $data['pagination'] = $this->siswa->makePagination(
            base_url("siswa/sortir/$rombel"),
            4,
            $data['total_rows']
        );
        $data['category']   = strtolower($rombel);
        $data['page']       = 'pages/siswa/sortir';
        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('siswa'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']                  = 'Administrasi Siswa';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']                = $this->siswa->select(
            [
                'siswa.id', 'siswa.id_kelas AS siswa_id_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'siswa_role.id', 'siswa_role.role', 'kelas.id AS kelas_id', 'kelas.rombel',
            ]
        )
            ->join4('siswa_role')
            ->join('kelas')
            ->paginate($page)
            ->like('nama', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows']             = $this->siswa->like('nama', $keyword)->count();
        $data['pagination']             = $this->siswa->makePagination(
            base_url('siswa'),
            2,
            $data['total_rows']
        );

        $data['page']                   = "pages/siswa/sortir";

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('siswa'));
    }

    public function detail_spp($nisn_siswa)
    {
        $data['title']          = 'Detail SPP';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']    = $this->siswa->select(
            [
                'siswa.id', 'siswa.id_kelas AS siswa_id_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'siswa_role.id', 'siswa_role.role', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'kelas.id AS kelas_id', 'kelas.rombel',
            ]
        )
            ->join4('siswa_role')
            ->join3('spp')
            ->join('kelas')
            ->where('nisn_siswa', $nisn_siswa)
            ->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Belum ada transaksi SPP');
            redirect(base_url('siswa'));
        }


        $data['spp_sendiri']        =  $this->siswa->sppDanaSendiri($nisn_siswa);
        $data['spp_kjp']            =  $this->siswa->sppDanaKjp($nisn_siswa);
        $data['total_spp']          =  $this->siswa->totalSpp($nisn_siswa);
        $data['page']               = 'pages/siswa/detail_spp';
        $this->view($data);
    }

    public function detail_ppdb($nisn_siswa)
    {
        $data['title']          = 'Detail SPP';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']    = $this->siswa->select(
            [
                'siswa.id', 'siswa.id_kelas AS siswa_id_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'siswa_role.id', 'siswa_role.role', 'ppdb.nisn_siswa', 'ppdb.osis', 'ppdb.tabungan', 'ppdb.sat', 'ppdb.koperasi', 'kelas.id AS kelas_id', 'kelas.rombel',
            ]
        )
            ->join4('siswa_role')
            ->join3('ppdb')
            ->join('kelas')
            ->where('nisn_siswa', $nisn_siswa)
            ->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Belum ada transaksi PPDB');
            redirect(base_url('siswa'));
        }

        $data['total_osis']         = $this->siswa->ppdb_osis($nisn_siswa);
        $data['total_tabungan']     = $this->siswa->ppdb_tabungan($nisn_siswa);
        $data['total_sat']          = $this->siswa->ppdb_sat($nisn_siswa);
        $data['total_koperasi']     = $this->siswa->ppdb_koperasi($nisn_siswa);

        $data['page']               = 'pages/siswa/detail_ppdb';
        $this->view($data);
    }

    public function detail_ujian($nisn_siswa)
    {
        $data['title']      = 'Detail Ujian';
        $data['user']       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['content']    = $this->siswa->select(
            [
                'siswa.id', 'siswa.id_kelas AS siswa_id_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'siswa_role.id', 'siswa_role.role', 'ujian.nisn_siswa', 'ujian.pts1', 'ujian.pat1', 'ujian.pts2', 'ujian.pat2', 'ujian.keterangan', 'ujian.tanggal', 'kelas.id AS kelas_id', 'kelas.rombel',
            ]
        )
            ->join4('siswa_role')
            ->join3('ujian')
            ->join('kelas')
            ->where('nisn_siswa', $nisn_siswa)
            ->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Belum ada transaksi ujian');
            redirect(base_url('siswa'));
        }

        $data['pts1']               = $this->siswa->ujian_pts1($nisn_siswa);
        $data['pat1']               = $this->siswa->ujian_pat1($nisn_siswa);
        $data['pts2']               = $this->siswa->ujian_pts2($nisn_siswa);
        $data['pat2']               = $this->siswa->ujian_pat2($nisn_siswa);

        $data['page']               = 'pages/siswa/detail_ujian';
        $this->view($data);
    }

    public function inputkeringanan($nisn)
    {
        $data['content'] = $this->siswa->where('nisn', $nisn)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url("siswa/detail_spp/$nisn"));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->siswa->validate()) {
            $data['title']          = 'Input Keringanan';
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['form_action']    = base_url("siswa/inputkeringanan/$nisn");
            $data['page']           = 'pages/siswa/form_keringanan';

            $this->view($data);
            return;
        }

        if ($this->siswa->where('nisn', $nisn)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Keringanan berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url("siswa/detail_spp/$nisn"));
    }


    // Manjemen Siswa

    public function menajemen_siswa()
    {
        $data['title']          = 'Menajemen Siswa';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['total_rows']     = $this->siswa->count();
        $data['pagination']     = $this->siswa->makePagination(
            base_url('siswa/menajemen_siswa'),
            2,
            $data['total_rows']
        );

        $data['page']           = 'pages/siswa/menajemen';

        $this->view($data);
    }

    public function sortir_menajemen($rombel, $page = null)
    {
        $data['title']      = 'Kelas';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']    = $this->siswa->select(
            [
                'siswa.id AS siswa_id', 'siswa.id_kelas AS siswa_id_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'siswa_role.id AS role_id', 'siswa_role.role', 'kelas.id AS kelas_id', 'kelas.rombel',
            ]
        )
            ->join4('siswa_role')
            ->join('kelas')
            ->where('kelas.rombel', $rombel)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->siswa
            ->where('kelas.rombel', $rombel)
            ->join('kelas')
            ->count();
        $data['pagination'] = $this->siswa->makePagination(
            base_url("siswa/sortir_menajemen/$rombel"),
            4,
            $data['total_rows']
        );
        $data['category'] = strtolower($rombel);
        $data['page']   = 'pages/siswa/sortir_menajemen';
        $this->view($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->siswa->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        // if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
        //     $imageName  = url_title($input->title, '-', true) . '-' . date('YmdHis');
        //     $upload     = $this->product->uploadImage('image', $imageName);
        //     if ($upload) {
        //         $input->image = $upload['file_name'];
        //     } else {
        //         redirect(base_url('product/create'));
        //     }
        // }

        if (!$this->siswa->validate()) {
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['title']          = 'Tambah Siswa';
            $data['input']          = $input;
            $data['form_action']    = base_url('siswa/create');
            $data['page']           = 'pages/siswa/form';

            $this->view($data);
            return;
        }

        if ($this->siswa->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url('siswa/menajemen_siswa'));
    }

    public function edit($id)
    {
        $data['content'] = $this->siswa->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('siswa'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        // if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
        //     $imageName  = url_title($data['input']->title, '-', true) . '-' . date('YmdHis');
        //     $upload     = $this->siswa->uploadImage('image', $imageName);
        //     if ($upload) {
        //         if ($data['content']->image !== '') {
        //             $this->siswa->deleteImage($data['content']->image);
        //         }
        //         $data['input']->image = $upload['file_name'];
        //     } else {
        //         redirect(base_url("siswa/edit/$id"));
        //     }
        // }

        if (!$this->siswa->validate()) {
            $data['title']          = 'Edit Siswa';
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['form_action']    = base_url("siswa/edit/$id");
            $data['page']           = 'pages/siswa/form';

            $this->view($data);
            return;
        }

        if ($this->siswa->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url("siswa/menajemen_siswa"));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('siswa/menajemen_siswa'));
        }

        $siswa = $this->siswa->where('id', $id)->first();

        if (!$siswa) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('siswa/menajemen_siswa'));
        }

        if ($this->siswa->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }
        redirect(base_url('siswa/menajemen_siswa'));
    }

    public function unique_nisn()
    {
        $nisn       = $this->input->post('nisn');
        $id         = $this->input->post('id');
        $siswa      = $this->siswa->where('nisn', $nisn)->first();

        if ($siswa) {
            if ($id == $siswa->id) {
                return true;
            }
            $this->load->library('form_validation');

            $this->form_validation->set_message('unique_nisn', '%s sudah digunakan');
            return false;
        }

        return true;
    }
}

/* End of file Siswa.php */
