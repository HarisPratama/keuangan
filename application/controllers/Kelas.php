<?php


defined('BASEPATH') or exit('No direct script access allowed');

class kelas extends MY_Controller
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
        $data['title']          = 'Data Kelas';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();
        $data['content']        = $this->kelas->paginate($page)->get();
        $data['total_rows']     = $this->kelas->count();
        $data['pagination']     = $this->kelas->makePagination(base_url('kelas'), 2, $data['total_rows']);
        $data['page']           = 'pages/kelas/index';
        $this->view($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->kelas->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->kelas->validate()) {
            $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title']          = 'Tambah Kelas';
            $data['input']          = $input;
            $data['form_action']    = base_url('kelas/create');
            $data['page']           = 'pages/kelas/form';

            $this->view($data);
            return;
        }
        if ($this->kelas->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url('kelas'));
    }

    public function edit($id)
    {
        $data['content'] = $this->kelas->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('kelas'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->kelas->validate()) {
            $data['title']          = 'Edit kelas';
            $data['user'] = $this->db->get_where('user', ['email'
            => $this->session->userdata('email')])->row_array();
            $data['form_action']    = base_url("kelas/edit/$id");
            $data['page']           = 'pages/kelas/form';

            $this->view($data);
            return;
        }

        if ($this->kelas->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Oops! terjadi suatu kesalahan');
        }

        redirect(base_url('kelas'));
    }
}

/* End of file kelas.php */
