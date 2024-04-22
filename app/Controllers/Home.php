<?php

namespace App\Controllers;

use App\Models\JumbotronModel;
use App\Models\PostsModel;

class Home extends BaseController
{
    public function index()
    {
        $data = [];
        $m_jumbotron = new JumbotronModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_jumbotron->listJumbotron($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_home', $data);
        echo view('layout-user/footer', $data);
    }

    public function article()
    {
        $data = [];
        $m_posts = new PostsModel();
        helper('global_fungsi_helper');
        $validation = \Config\Services::validation();

        $post_type = 'article';
        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "ft";

        // $konfigurasi_name = "set_halaman_depan";
        // $konfigurasi = konfigurasi_get($konfigurasi_name);
        // $page_id = isset($konfigurasi['konfigurasi_value']);

        // $dataHalaman = $m_posts->getPost($page_id);
        // $data['type'] = $dataHalaman['post_type'];
        // $data['judul'] = $dataHalaman['post_title'];
        // $data['deskripsi'] = $dataHalaman['post_description'];
        // $data['thumbnail'] = $dataHalaman['post_thumbnail'];

        $file = $this->request->getFile('post_thumbnail');

        $hasil = $m_posts->listPost($post_type, $jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_article', $data);
        echo view('layout-user/footer', $data);
    }
}
