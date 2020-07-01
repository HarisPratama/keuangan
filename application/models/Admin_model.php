<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function pemasukan()
    {
        $query = $this->db->get('pemasukan');
        return $query->result_array();
    }

    public function getFilterNow($startdate, $enddate)
    {
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        return $query->result_array();
    }

    public function getFilter($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        return $query->result_array();
    }

    public function hitungTotalNominalNow($startdate, $enddate)
    {
        $this->db->select_sum('nominal');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }

    public function hitungTotalNominal($startdate, $enddate)
    {
        $this->db->select_sum('nominal');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }

    public function totalNominal()
    {
        $this->db->select_sum('nominal');
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }
    public function totalBos()
    {
        $this->db->select_sum('bos');
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->bos;
        } else {
            return 0;
        }
    }
    public function totalLain()
    {
        $this->db->select_sum('lain');
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->lain;
        } else {
            return 0;
        }
    }

    public function hitungTotalBosNow($startdate, $enddate)
    {
        $this->db->select_sum('bos');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->bos;
        } else {
            return 0;
        }
    }

    public function hitungTotalBos($startdate, $enddate)
    {
        $this->db->select_sum('bos');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->bos;
        } else {
            return 0;
        }
    }

    public function hitungTotalLainNow($startdate, $enddate)
    {
        $this->db->select_sum('lain');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->lain;
        } else {
            return 0;
        }
    }

    public function hitungTotalLain($startdate, $enddate)
    {
        $this->db->select_sum('lain');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pemasukan');
        if ($query->num_rows() > 0) {
            return $query->row()->lain;
        } else {
            return 0;
        }
    }

    public function delete_pemasukan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pemasukan');
        return true;
    }

    // public function exportList()
    // {
    //     $query = $this->db->get('pemasukan');
    //     return $query->result_array();
    // }

    // public function totalAll()
    // {
    //     $query = $this->db->get('pemasukan');
    //     if ($query->num_rows() > 0) {
    //         return $query->num_rows();
    //     } else {
    //         return 0;
    //     }
    // }

    public function pengeluaran()
    {
        $query = $this->db->get('pengeluaran');
        return $query->result_array();
    }

    public function outTotalBosNow($startdate, $enddate)
    {
        $this->db->select_sum('bos');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->bos;
        } else {
            return 0;
        }
    }

    public function outTotalBos($startdate, $enddate)
    {
        $this->db->select_sum('bos');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->bos;
        } else {
            return 0;
        }
    }

    public function outBos()
    {
        $this->db->select_sum('bos');
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->bos;
        } else {
            return 0;
        }
    }

    public function outBrs()
    {
        $this->db->select_sum('brs');
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->brs;
        } else {
            return 0;
        }
    }

    public function outLain()
    {
        $this->db->select_sum('lain');
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->lain;
        } else {
            return 0;
        }
    }

    public function outTotalBrsNow($startdate, $enddate)
    {
        $this->db->select_sum('brs');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->brs;
        } else {
            return 0;
        }
    }

    public function outTotalBrs($startdate, $enddate)
    {
        $this->db->select_sum('brs');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->brs;
        } else {
            return 0;
        }
    }

    public function outTotalLainNow($startdate, $enddate)
    {
        $this->db->select_sum('lain');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->lain;
        } else {
            return 0;
        }
    }

    public function outTotalLain($startdate, $enddate)
    {
        $this->db->select_sum('lain');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        if ($query->num_rows() > 0) {
            return $query->row()->lain;
        } else {
            return 0;
        }
    }

    public function outFilterNow($startdate, $enddate)
    {
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        return $query->result_array();
    }

    public function outFilter($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('pengeluaran');
        return $query->result_array();
    }

    public function delete_pengeluaran($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pengeluaran');
        return true;
    }
    // Akhir pengeluaran

    // Peminjaman
    public function peminjaman()
    {
        $query = $this->db->get('peminjaman');
        return $query->result_array();
    }

    public function debtFilterNow($startdate, $enddate)
    {
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('peminjaman');
        return $query->result_array();
    }

    public function debtFilter($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('peminjaman');
        return $query->result_array();
    }

    public function debtTotalNow($startdate, $enddate)
    {
        $this->db->select_sum('nominal');
        $startdate = date("Y-m-d");
        $enddate = date("Y-m-d");
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('peminjaman');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }

    public function debtTotal($startdate, $enddate)
    {
        $this->db->select_sum('nominal');
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = $this->db->get('peminjaman');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }

    public function totalDebt()
    {
        $this->db->select_sum('nominal');
        $query = $this->db->get('peminjaman');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }

    public function delete_peminjaman($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('peminjaman');
        return true;
    }
    // Akhir peminjaman

    public function kategori_pemasukan($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = "SELECT 
        sum(if( deskripsi = 'SPP', nominal + bos + lain, NULL)) as spp, 
        sum(if( deskripsi = 'Sarpras', nominal + bos + lain, NULL)) as sarpras, 
        sum(if( deskripsi = 'Tunggakan', nominal + bos + lain, NULL)) as tunggakan, 
        sum(if( deskripsi = 'OSIS', nominal + bos + lain, NULL)) as osis, 
        sum(if( deskripsi = 'SAT', nominal + bos + lain, NULL)) as sat, 
        sum(if( deskripsi = 'Semesteran', nominal + bos + lain, NULL)) as semesteran, 
        sum(if( deskripsi = 'Ujian Nasional', nominal + bos + lain, NULL)) as ujian_nasional,
        sum(if( deskripsi = 'Lain-lain', nominal + bos + lain, NULL)) as lain_lain 
        FROM pemasukan";
        $result = $this->db->query($query);
        return $result->row();
    }

    public function kategori_pengeluaran($startdate, $enddate)
    {
        $this->db->where('DATE(tanggal) >=', $startdate);
        $this->db->where('DATE(tanggal) <=', $enddate);
        $query = "SELECT 
        sum(if( kategori = 'Belanja Harian', bos + brs + lain, NULL)) as belanja_harian, 
        sum(if( kategori = 'TAL', bos + brs + lain, NULL)) as tal, 
        sum(if( kategori = 'Sarpras', bos + brs + lain, NULL)) as sarpras, 
        sum(if( kategori = 'Gaji', bos + brs + lain, NULL)) as gaji, 
        sum(if( kategori = 'Air', bos + brs + lain, NULL)) as air, 
        sum(if( kategori = 'Insentif Pengawas', bos + brs + lain, NULL)) as insentif_pengawas, 
        sum(if( kategori = 'Iuran RT', bos + brs + lain, NULL)) as iuran_rt, 
        sum(if( kategori = 'OSIS', bos + brs + lain, NULL)) as osis, 
        sum(if( kategori = 'Iuran Sampah', bos + brs + lain, NULL)) as iuran_sampah, 
        sum(if( kategori = 'Bulanan', bos + brs + lain, NULL)) as bulanan, 
        sum(if( kategori = 'Pengelolaan Website', bos + brs + lain, NULL)) as pengelolaan_website, 
        sum(if( kategori = 'Service AC dan lainnya', bos + brs + lain, NULL)) as servic, 
        sum(if( kategori = 'ATK', bos + brs + lain, NULL)) as atk, 
        sum(if( kategori = 'Lain-lain', bos + brs + lain, NULL)) as lain_lain 
        FROM pengeluaran";
        $result = $this->db->query($query);
        return $result->row();
    }
}

/* End of file Admin_model.php */
