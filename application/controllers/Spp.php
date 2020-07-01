<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Spp extends MY_Controller
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
        $data['title']          = 'Input SPP';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->spp->getFilterSppNow($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->spp
            ->getFilterSppNow($startdate, $enddate)
            ->count();
        $data['pagination'] = $this->spp->makePagination(
            base_url("spp"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/spp/index';
        $this->view($data);
    }

    public function filter($page = null)
    {
        $data['title']          = 'Input SPP';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->spp->getFilterSpp($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->spp
            ->getFilterSpp($startdate, $enddate)
            ->count();
        $data['pagination'] = $this->spp->makePagination(
            base_url("spp/filter?startdate=$startdate&enddate=$enddate"),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/spp/index';
        $this->view($data);
    }

    public function edit($id)
    {
        $data['content'] = $this->spp->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('spp'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->spp->validate()) {
            $data['title']          = 'Edit Inputan SPP';
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['form_action']    = base_url("spp/edit/$id");
            $data['page']           = 'pages/spp/form';

            $this->view($data);
            return;
        }

        $data['input'] = str_replace(".", "", $this->input->post(null, true));

        if ($this->spp->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url("spp"));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('spp'));
        }

        $spp = $this->spp->where('id', $id)->first();

        if (!$spp) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('spp'));
        }

        if ($this->spp->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }
        redirect(base_url('spp'));
    }

    public function detail($nisn_siswa)
    {
        $data['title']          = 'Detail SPP';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']        = $this->spp->select([
            'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id AS siswa_id', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
        ])
            ->join2('siswa')
            ->join('kelas')
            ->where('nisn_siswa', $nisn_siswa)
            ->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('spp'));
        }
        $data['spp_sendiri']        =  $this->spp->sppDanaSendiri($nisn_siswa);
        $data['spp_kjp']            =  $this->spp->sppDanaKjp($nisn_siswa);
        $data['total_spp']          =  $this->spp->totalSpp($nisn_siswa);
        $data['page']               = 'pages/spp/detail';
        $this->view($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->spp->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->spp->validate()) {
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['title']          = 'Tambah spp';
            $data['input']          = $input;
            $data['form_action']    = base_url('spp/create');
            $data['page']           = 'pages/spp/form';
            $data['kelas']          = $this->spp->fetch_kelas();

            $this->view($data);
            return;
        }

        $input = str_replace(".", "", $this->input->post(null, true));

        if ($this->spp->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url('spp'));
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
            redirect(base_url('spp'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']                  = 'SPP';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']                = $this->spp->select(
            [
                'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id AS siswa_id', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
            ]
        )
            ->join2('siswa')
            ->join('kelas')
            ->like('nisn_siswa', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows']             = $this->spp->select(
            [
                'spp.id', 'spp.id_kelas', 'spp.nisn_siswa', 'spp.nominal', 'spp.kjp', 'spp.bulan', 'spp.tanggal', 'siswa.id AS siswa_id', 'siswa.id_kelas AS siswa_kelas', 'siswa.nama', 'siswa.nisn', 'siswa.id_siswa_role', 'siswa.keringanan', 'siswa.total_spp', 'kelas.id AS kelas_id', 'kelas.rombel AS kelas_rombel'
            ]
        )
            ->like('nisn_siswa', $keyword)
            ->count();
        $data['pagination']             = $this->spp->makePagination(
            base_url('spp/search'),
            3,
            $data['total_rows']
        );

        $data['page']                   = "pages/spp/index";

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('spp'));
    }

    public function export_pdf($id)
    {
        $this->load->library('pdf');
        $spp = $this->spp->where('id', $id)->first();

        $pdf = new FPDF('l', 'mm', array(150, 200));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Image('assets/img/smp.jpg', 10, 5, 30, 30);
        $pdf->Cell(0, 7, 'SMP PGRI 30 JAKARTA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'BUKTI PEMBAYARAN SPP', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 7, '______________________________________________________', 0, 1);
        $pdf->Cell(70, 6, 'NISN', 0, 0);
        $pdf->Cell(50, 6, ': ' . $spp->nisn_siswa, 0, 1);
        $pdf->Cell(70, 6, 'NOMINAL', 0, 0);
        $pdf->Cell(50, 6, ': ' . $spp->nominal, 0, 1);
        $pdf->Cell(70, 6, 'DANA KJP', 0, 0);
        $pdf->Cell(50, 6, ': ' . $spp->kjp, 0, 1);
        $pdf->Cell(70, 6, 'PEMBAYARAN BULAN', 0, 0);
        $pdf->Cell(50, 6, ': ' . $spp->bulan, 0, 1);
        $pdf->Cell(70, 6, 'TANGGAL TRANSAKSI', 0, 0);
        $pdf->Cell(10, 6, ': ' . date('d F Y', strtotime(str_replace('/', '-', $spp->tanggal))), 0, 1);
        $pdf->Cell(0, 7, '______________________________________________________', 0, 1);

        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(70, 6, 'Catatan :', 0, 0);
        $pdf->Cell(120, 7, 'Jakarta, ' . date('d F Y', strtotime(str_replace('/', '-', date("Y-m-d")))), 0, 1, 'C');
        $pdf->Cell(70, 6, '- Disimpan sebagai bukti pembayaran yang sah', 0, 0);
        $pdf->Cell(120, 7, 'Yang Menerima,', 0, 1, 'C');
        $pdf->Cell(70, 6, '- Uang yang sudah dibayarkan tidak dapat diminta kembali', 0, 1);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Cell(260, 7, 'Eka Wahyuningsih, S.Kom', 0, 1, 'C');
        $pdf->Output();
    }
}

/* End of file Spp.php */
