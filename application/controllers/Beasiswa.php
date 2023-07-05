<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('JenisModel', 'BeasiswaModel'));
        $this->load->library('pdf');
    }

    public function index()
    {
        $data['title'] = "Dashboard | SIMDAWA-APP";
        $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('beasiswa/beasiswa_read', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        if (isset($_POST['create'])) {
            $this->BeasiswaModel->insert_beasiswa();
            redirect('beasiswa');
        } else {
            $data['title'] = "Tambah Data beasiswa | SIMDAWA-APP";
            $data['jenis'] = $this->JenisModel->get_jenis();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('beasiswa/beasiswa_create', $data);
            $this->load->view('template/footer');
        }
    }
    public function ubah($id)
    {
        if (isset($_POST['update'])) {
            $this->BeasiswaModel->update_beasiswa();
            redirect('beasiswa');
        } else {
            $data['jenis'] = $this->JenisModel->get_jenis();
            $data['title'] = "Perbaharui Data Mahasiswa| SIMDAWA-APP";
            $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa_byid($id);
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('beasiswa/beasiswa_update', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapus($id)
    {
        if (isset($id)) {
            $this->BeasiswaModel->delete_beasiswa($id);
            redirect('beasiswa');
        }
    }
    public function cetak()
    {
        $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa();
        $this->load->view('beasiswa/beasiswa_print', $data);
    }
}
