<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Tunggakan extends MY_Controller
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
        $data['title']      = 'Input Tunggakan';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->tunggakan->getFilterTunggakanNow($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->tunggakan
            ->join('kelas')
            ->count();
        $data['pagination'] = $this->tunggakan->makePagination(
            base_url("tunggakan"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/tunggakan/index';
        $this->view($data);
    }

    public function filter($page = null)
    {
        $data['title']          = 'Input Tunggakan';
        $data['user']           = $this->db->get_where('user', ['email'
        => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->get('startdate', true);
        $enddate = $this->input->get('enddate', true);
        $data['content'] = $this->tunggakan->getFilterTunggakan($startdate, $enddate)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->tunggakan
            ->join('kelas')
            ->count();
        $data['pagination'] = $this->tunggakan->makePagination(
            base_url("tunggakan"),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/tunggakan/index';
        $this->view($data);
    }
}

/* End of file Tunggakan.php */
