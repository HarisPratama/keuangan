<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Management extends MY_Controller
{
    protected $table = 'siswa';

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title']      = 'Import Data Siswa';
        $data['user']       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['page']       = 'pages/import/index';
        $this->view($data);
    }

    public function import()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $config['upload_path'] = './assets/import/';
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            //upload gagal
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> ' . $this->upload->display_errors() . '</div>');
            //redirect halaman
            redirect('management');
        } else {

            $data_upload = $this->upload->data();

            $excelreader        = new PHPExcel_Reader_Excel2007();
            $loadexcel          = $excelreader->load('assets/import/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet              = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

            $data = array();

            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($data, array(
                        'id_kelas'          => $row['A'],
                        'nama'              => $row['B'],
                        'nisn'              => $row['C'],
                        'id_siswa_role'     => $row['D'],
                        'keringanan'        => $row['E'],
                        'total_spp'         => $row['F']
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('siswa', $data);
            //delete file from server
            unlink(realpath('assets/import/' . $data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            //redirect halaman
            redirect('management');
        }
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

/* End of file Management.php */
