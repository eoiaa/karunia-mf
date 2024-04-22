<?php

namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\KonfigurasiModel;

class Page extends BaseController
{
    public function index()
    {
        $halaman_controller = "page";
        $halaman_label = "Halaman";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('post_id')) {
            $m_posts = new PostsModel();
            $dataPost = $m_posts->getPost($this->request->getVar('post_id'));
            if ($dataPost['post_id']) {
                @unlink(LOKASI_UPLOAD . "/" . $dataPost['post_thumbnail']);
                $aksi = $m_posts->deletePost($this->request->getVar('post_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/page");
        }

        $m_posts = new PostsModel();
        helper('global_fungsi_helper');

        $post_type = $halaman_controller;
        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_posts->listPost($post_type, $jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_page', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_controller = "page";
        $halaman_label = "Halaman";
        $validation = \Config\Services::validation();
        $data = [];
        $m_posts = new PostsModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'post_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'post_content' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten Harus Diisi'
                    ]
                ],
                'post_thumbnail' => [
                    'rules' => 'is_image[post_thumbnail]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ]
            ];

            $file = $this->request->getFile('post_thumbnail');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $post_thumbnail = '';
                if ($file->getName()) {
                    $post_thumbnail = $file->getRandomName();
                }
                $record = [
                    'username' => session()->get('akun_username'),
                    'post_title' => $this->request->getVar('post_title'),
                    'post_status' => $this->request->getVar('post_status'),
                    'post_thumbnail' => $post_thumbnail,
                    'post_description' => $this->request->getVar('post_description'),
                    'post_content' => $this->request->getVar('post_content')
                ];

                $post_type = $halaman_controller;
                $aksi = $m_posts->insertPost($record, $post_type);
                if ($aksi != false) {
                    $page_id = $aksi;

                    //masuk konfigurasi
                    $set_halaman_depan = $this->request->getVar('set_halaman_depan');
                    $set_halaman_kontak = $this->request->getVar('set_halaman_kontak');

                    helper('global_fungsi_helper');

                    //set halaman depan
                    $dataGet = konfigurasi_get('set_halaman_depan');
                    $konfig_data = isset($dataGet['konfigurasi_value']);

                    if ($set_halaman_depan == '1') {
                        $page_id_depan = $page_id;
                    }
                    if ($konfig_data == $page_id && $set_halaman_depan != '1') {
                        $page_id_depan = '';
                    }
                    $dataSet = [
                        'konfigurasi_value' => $page_id_depan
                    ];
                    konfigurasi_set('set_halaman_depan', $dataSet);

                    //set halaman kontak
                    $dataGet = konfigurasi_get('set_halaman_kontak');
                    $konfig_data = isset($dataGet['konfigurasi_value']);

                    if ($set_halaman_kontak == '1') {
                        $page_id_kontak = $page_id;
                    }
                    if ($konfig_data == $page_id && $set_halaman_kontak != '1') {
                        $page_id_kontak = '';
                    }
                    $dataSet = [
                        'konfigurasi_value' => $page_id_kontak
                    ];
                    konfigurasi_set('set_halaman_kontak', $dataSet);
                    //selesai konfigurasi

                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $post_thumbnail);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/page/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/page/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_page_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($post_id)
    {
        $halaman_controller = "page";
        $halaman_label = "Halaman";
        $validation = \Config\Services::validation();
        $data = [];
        $m_posts = new PostsModel();
        helper('global_fungsi_helper');

        $dataPost = $m_posts->getPost($post_id);
        if (empty($dataPost)) {
            return redirect()->to('admins/page');
        }

        $data = $dataPost;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'post_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'post_content' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten Harus Diisi'
                    ]
                ],
                'post_thumbnail' => [
                    'rules' => 'is_image[post_thumbnail]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ]
            ];

            $file = $this->request->getFile('post_thumbnail');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $post_thumbnail = '';
                if ($file->getName()) {
                    $post_thumbnail = $file->getRandomName();
                }
                $record = [
                    'username' => session()->get('akun_username'),
                    'post_title' => $this->request->getVar('post_title'),
                    'post_status' => $this->request->getVar('post_status'),
                    'post_thumbnail' => $post_thumbnail,
                    'post_description' => $this->request->getVar('post_description'),
                    'post_content' => $this->request->getVar('post_content'),
                    'post_id' => $post_id
                ];

                $post_type = $halaman_controller;

                $aksi = $m_posts->insertPost($record, $post_type);
                if ($aksi != false) {
                    $page_id = $aksi;

                    //masuk konfigurasi
                    $set_halaman_depan = $this->request->getVar('set_halaman_depan');
                    $set_halaman_kontak = $this->request->getVar('set_halaman_kontak');
                    $page_id_depan = '';
                    $page_id_kontak = '';
                    helper('global_fungsi_helper');
                    //set halaman depan
                    $konfigurasi_name = 'set_halaman_depan';
                    $dataGet = konfigurasi_get($konfigurasi_name);
                    $konfig_data = isset($dataGet['konfigurasi_value']);

                    if ($set_halaman_depan == '1') {
                        $page_id_depan = $page_id;
                    }
                    if ($konfig_data == $page_id && $set_halaman_depan != '1') {
                        $page_id_depan = null;
                    }
                    $dataSet = [
                        'konfigurasi_value' => $page_id_depan
                    ];
                    konfigurasi_set($konfigurasi_name, $dataSet);

                    //set halaman kontak
                    $konfigurasi_name = 'set_halaman_kontak';
                    $dataGet = konfigurasi_get($konfigurasi_name);
                    $konfig_data = isset($dataGet['konfigurasi_value']);

                    if ($set_halaman_kontak == '1') {
                        $page_id_kontak = $page_id;
                    }
                    if ($konfig_data == $page_id && $set_halaman_kontak != '1') {
                        $page_id_kontak = null;
                    }
                    $dataSet = [
                        'konfigurasi_value' => $page_id_kontak
                    ];
                    konfigurasi_set($konfigurasi_name, $dataSet);
                    //selesai konfigurasi

                    if ($file->getName()) {
                        if ($dataPost['post_thumbnail']) {
                            @unlink(LOKASI_UPLOAD . "/" . $dataPost['post_thumbnail']);
                        }

                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $post_thumbnail);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/page/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/page/edit/' . $page_id);
                }
            }
        }
        $konfigurasi_name = 'set_halaman_depan';
        $dataGet = konfigurasi_get($konfigurasi_name);

        $konfig_data = isset($dataGet['konfigurasi_value']);
        $dataGet = konfigurasi_get('set_halaman_depan');
        if ($konfig_data == $post_id) {
            $data['set_halaman_depan'] = 1;
        }

        $konfigurasi_name = 'set_halaman_depan';
        $dataGet = konfigurasi_get($konfigurasi_name);

        $konfig_data = isset($dataGet['konfigurasi_value']);
        $dataGet = konfigurasi_get('set_halaman_kontak');
        if ($konfig_data == $post_id) {
            $data['set_halaman_kontak'] = 1;
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_page_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
