<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->library('form_validation');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();

        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();

        $data['total_peminjaman'] = $this->admin->totalDebt();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function pemasukan()
    {
        $data['title'] = 'Pemasukan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->getFilterNow($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        $data['total_nominal'] = $this->admin->hitungTotalNominalNow($startdate, $enddate);
        $data['total_bos'] = $this->admin->hitungTotalBosNow($startdate, $enddate);
        $data['total_lain'] = $this->admin->hitungTotalLainNow($startdate, $enddate);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pemasukan', $data);
        $this->load->view('templates/footer');
        // $data['title'] = 'Pemasukan';
        // $data['user'] = $this->db->get_where('user', ['email'
        // => $this->session->userdata('email')])->row_array();

        // $data['transaksi'] = $this->db->get('pemasukan')->result_array();

        // $data['total_nominal'] = $this->admin->hitungTotalNominal();
        // $data['total_bos'] = $this->admin->hitungTotalBos();
        // $data['total_lain'] = $this->admin->hitungTotalLain();

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('admin/pemasukan', $data);
        // $this->load->view('templates/footer');
    }

    public function filter()
    {
        $data['title'] = 'Pemasukan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);

        $data['transaksi'] = $this->admin->getFilter($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        $data['total_nominal'] = $this->admin->hitungTotalNominal($startdate, $enddate);
        $data['total_bos'] = $this->admin->hitungTotalBos($startdate, $enddate);
        $data['total_lain'] = $this->admin->hitungTotalLain($startdate, $enddate);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pemasukan', $data);
        $this->load->view('templates/footer');
    }

    public function inputpemasukan()
    {
        $data['title'] = 'Pemasukan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->getFilterNow($startdate, $enddate);

        $data['total_nominal'] = $this->admin->hitungTotalNominalNow($startdate, $enddate);
        $data['total_bos'] = $this->admin->hitungTotalBosNow($startdate, $enddate);
        $data['total_lain'] = $this->admin->hitungTotalLainNow($startdate, $enddate);

        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pemasukan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'deskripsi'     => htmlspecialchars($this->input->post('deskripsi', true)),
                'nominal'       => htmlspecialchars($this->input->post('nominal', true)),
                'bos'           => htmlspecialchars($this->input->post('bos', true)),
                'lain'          => htmlspecialchars($this->input->post('lain', true)),
                'keterangan'    => htmlspecialchars($this->input->post('keterangan', true)),
                'tanggal'       => htmlspecialchars($this->input->post('tanggal', true))
            ];

            $this->db->insert('pemasukan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pemasukan berhasil ditambahkan
            </div>');
            redirect('admin/pemasukan');
        }
    }

    public function editpemasukan($pemasukan_id)
    {
        $data['title'] = 'Edit Pemasukan';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['no'] = $this->db->get_where('pemasukan', ['id' => $pemasukan_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editpemasukan', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['no'] = $this->db->get_where('pemasukan')->result_array();

        $deskripsi      = $this->input->post('deskripsi', true);
        $nominal        = $this->input->post('nominal', true);
        $bos            = $this->input->post('bos', true);
        $lain           = $this->input->post('lain', true);
        $tanggal        = $this->input->post('tanggal', true);
        $id             = $this->input->post('id', true);

        $this->db->set('deskripsi', $deskripsi);
        $this->db->set('nominal', $nominal);
        $this->db->set('bos', $bos);
        $this->db->set('lain', $lain);
        $this->db->set('tanggal', $tanggal);
        $this->db->where('id', $id);
        $this->db->update('pemasukan');

        // $url = $this->uri->segment(3);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di Update!</div>');
        redirect('admin/pemasukan/');
    }

    public function delPemasukan($id)
    {
        $data['transaksi'] = $this->admin->pemasukan();
        $this->db->get_where('pemasukan', ['id' => $id])->row_array();
        $this->admin->delete_pemasukan($id);
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/pemasukan');
    }

    // Pengeluaran
    public function pengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->outFilterNow($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        //  pengeluaran
        $data['total_bos'] = $this->admin->outTotalBosNow($startdate, $enddate);
        $data['total_brs'] = $this->admin->outTotalBrsNow($startdate, $enddate);
        $data['total_lain'] = $this->admin->outTotalLainNow($startdate, $enddate);
        $data['total_pengeluaran'] = $data['total_bos'] + $data['total_brs'] + $data['total_lain'];
        // end

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengeluaran', $data);
        $this->load->view('templates/footer');
    }

    public function filterpengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->outFilter($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        $data['total_bos'] = $this->admin->outTotalBos($startdate, $enddate);
        $data['total_brs'] = $this->admin->outTotalBrs($startdate, $enddate);
        $data['total_lain'] = $this->admin->outTotalLain($startdate, $enddate);
        $data['total_pengeluaran'] = $data['total_bos'] + $data['total_brs'] + $data['total_lain'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengeluaran', $data);
        $this->load->view('templates/footer');
    }

    public function inputpengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->outFilterNow($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        //  pengeluaran
        $data['total_bos'] = $this->admin->outTotalBosNow($startdate, $enddate);
        $data['total_brs'] = $this->admin->outTotalBrsNow($startdate, $enddate);
        $data['total_lain'] = $this->admin->outTotalLainNow($startdate, $enddate);
        $data['total_pengeluaran'] = $data['total_bos'] + $data['total_brs'] + $data['total_lain'];
        // end

        $this->form_validation->set_rules('saldo', 'Saldo', 'numeric');
        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi',
            'trim|required',
            [
                'required' => 'Deskripsi harus diisi'
            ]
        );
        $this->form_validation->set_rules('bos', 'BOS', "trim|required|numeric|greater_than['saldo']");
        $this->form_validation->set_rules('brs', 'BRS', 'trim|required|numeric');
        $this->form_validation->set_rules('lain', 'Lain', 'trim|required|numeric');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengeluaran', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'deskripsi'     => htmlspecialchars($this->input->post('deskripsi', true)),
                'bos'           => htmlspecialchars($this->input->post('bos', true)),
                'brs'           => htmlspecialchars($this->input->post('brs', true)),
                'lain'          => htmlspecialchars($this->input->post('lain', true)),
                'kategori'      => htmlspecialchars($this->input->post('kategori', true)),
                'keterangan'    => htmlspecialchars($this->input->post('keterangan', true)),
                'tanggal'       => htmlspecialchars($this->input->post('tanggal', true))
            ];

            $this->db->insert('pengeluaran', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pengeluaran berhasil ditambahkan
            </div>');
            redirect('admin/pengeluaran');
        }
    }

    public function editpengeluaran($pengeluaran_id)
    {
        $data['title'] = 'Edit Pengeluaran';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['no'] = $this->db->get_where('pengeluaran', ['id' => $pengeluaran_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editpengeluaran', $data);
        $this->load->view('templates/footer');
    }

    public function edit2()
    {
        $data['no'] = $this->db->get_where('pengeluaran')->result_array();

        $deskripsi      = $this->input->post('deskripsi', true);
        $nominal        = $this->input->post('bos', true);
        $bos            = $this->input->post('brs', true);
        $lain           = $this->input->post('lain', true);
        $kategori       = $this->input->post('kategori', true);
        $tanggal        = $this->input->post('tanggal', true);
        $id             = $this->input->post('id', true);

        $this->db->set('deskripsi', $deskripsi);
        $this->db->set('bos', $nominal);
        $this->db->set('brs', $bos);
        $this->db->set('lain', $lain);
        $this->db->set('kategori', $kategori);
        $this->db->set('tanggal', $tanggal);
        $this->db->where('id', $id);
        $this->db->update('pengeluaran');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di Update!</div>');
        redirect('admin/pengeluaran');
    }

    public function delPengeluaran($id)
    {
        $data['transaksi'] = $this->admin->pengeluaran();
        $this->db->get_where('pengeluaran', ['id' => $id])->row_array();
        $this->admin->delete_pengeluaran($id);
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/pengeluaran');
    }
    // akhir pengeluaran

    // Peminjaman
    public function peminjaman()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->debtFilterNow($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        $data['total'] = $this->admin->debtTotalNow($startdate, $enddate);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function filterpeminjaman()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);

        $data['transaksi'] = $this->admin->debtFilter($startdate, $enddate);

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        $data['total'] = $this->admin->debtTotal($startdate, $enddate);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function inputpeminjaman()
    {
        $data['transaksi'] = $this->db->get('peminjaman')->result_array();

        // pemasukan
        $data['jumlah_nominal'] = $this->admin->totalNominal();
        $data['jumlah_bos'] = $this->admin->totalBos();
        $data['jumlah_lain'] = $this->admin->totalLain();
        $total_pemasukan = $data['jumlah_nominal'] + $data['jumlah_bos'] + $data['jumlah_lain'];
        // end

        // pengeluaran
        $data['out_bos'] = $this->admin->outBos();
        $data['out_brs'] = $this->admin->outBrs();
        $data['out_lain'] = $this->admin->outLain();
        $total_pengeluaran = $data['out_bos'] + $data['out_brs'] + $data['out_lain'];
        // end

        // peminjaman
        $total_peminjaman = $this->admin->totalDebt();
        // end

        $data['saldo'] = $total_pemasukan - $total_pengeluaran + $total_peminjaman;

        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi',
            'trim|required',
            [
                'required' => 'Deskripsi harus diisi'
            ]
        );
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['transaksi'] = $this->admin->debtFilterNow($startdate, $enddate);

        $data['total'] = $this->admin->debtTotalNow($startdate, $enddate);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/peminjaman', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'deskripsi'         => htmlspecialchars($this->input->post('deskripsi', true)),
                'nominal'           => htmlspecialchars($this->input->post('nominal', true)),
                'pihak'             => htmlspecialchars($this->input->post('pihak', true)),
                'keterangan'        => htmlspecialchars($this->input->post('keterangan', true)),
                'tanggal'           => htmlspecialchars($this->input->post('tanggal', true))
            ];

            $this->db->insert('peminjaman', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Peminjaman berhasil ditambahkan
            </div>');
            redirect('admin/peminjaman');
        }
    }

    public function editdebt($peminjaman_id)
    {
        $data['title'] = 'Edit Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['no'] = $this->db->get_where('peminjaman', ['id' => $peminjaman_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editpeminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function edit3()
    {
        $data['no'] = $this->db->get_where('peminjaman')->result_array();


        $deskripsi      = $this->input->post('deskripsi', true);
        $nominal        = $this->input->post('nominal', true);
        $pihak          = $this->input->post('pihak', true);
        $keterangan     = $this->input->post('keterangan', true);
        $tanggal        = $this->input->post('tanggal', true);
        $id             = $this->input->post('id', true);

        $this->db->set('deskripsi', $deskripsi);
        $this->db->set('nominal', $nominal);
        $this->db->set('pihak', $pihak);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('tanggal', $tanggal);
        $this->db->where('id', $id);
        $this->db->update('peminjaman');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di Update!</div>');
        redirect('admin/peminjaman');
    }

    public function delPeminjaman($id)
    {
        $data['transaksi'] = $this->admin->peminjaman();
        $this->db->get_where('peminjaman', ['id' => $id])->row_array();
        $this->admin->delete_peminjaman($id);
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/peminjaman');
    }
}

/* End of file Admin.php */
