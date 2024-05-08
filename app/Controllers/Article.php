<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Article extends BaseController
{
    public function index()
    {
        $halaman_controller = "article";
        $halaman_label = "Artikel";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('post_id')) {
            $m_posts = new PostsModel();
            $dataPost = $m_posts->getPost($this->request->getVar('post_id'));
            if ($dataPost['post_id']) {
                @unlink(LOKASI_UPLOAD . "/" . $dataPost['post_thumbnail']);
                @unlink(LOKASI_UPLOAD_FILE . "/" . $dataPost['post_thumbnail']);
                $aksi = $m_posts->deletePost($this->request->getVar('post_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/update");
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
        echo view('admins/v_article', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_controller = "article";
        $halaman_label = "Artikel";
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
                'post_thumbnail' => [
                    'rules' => 'is_image[post_thumbnail]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                // 'post_file' => [
                //     'rules' => 'is_file[post_file]',
                //     'errors' => [
                //         'is_file' => 'Hanya File yang boleh diupload'
                //     ]
                // ]
            ];

            $file = $this->request->getFile('post_thumbnail');
            $file2 = $this->request->getFile('post_file');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $post_thumbnail = '';
                $post_file = '';
                if ($file->getName()) {
                    $post_thumbnail = $file->getRandomName();
                }
                if ($file2->getName()) {
                    $post_file = $file2->getRandomName();
                }
                $record = [
                    'username' => session()->get('akun_username'),
                    'post_title' => $this->request->getVar('post_title'),
                    'post_status' => $this->request->getVar('post_status'),
                    'post_thumbnail' => $post_thumbnail,
                    'post_file' => $post_file,
                    'post_description' => $this->request->getVar('post_description'),
                    'post_content' => $this->request->getVar('post_content'),
                ];

                $post_type = $halaman_controller;

                $aksi = $m_posts->insertPost($record, $post_type);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        $file->move(LOKASI_UPLOAD, $post_thumbnail);
                    }
                    if ($file2->getName()) {
                        $file2->move(LOKASI_UPLOAD_FILE, $post_file);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/update/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/update/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_article_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($post_id)
    {
        $halaman_controller = "article";
        $halaman_label = "Artikel";
        $validation = \Config\Services::validation();
        $data = [];

        $m_posts = new PostsModel();

        $dataPost = $m_posts->getPost($post_id);
        if (empty($dataPost)) {
            return redirect()->to('admins/update');
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
                'post_thumbnail' => [
                    'rules' => 'is_image[post_thumbnail]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                // 'post_file' => [
                //     'rules' => 'is_file[post_file]',
                //     'errors' => [
                //         'is_file' => 'Hanya File yang boleh diupload'
                //     ]
                // ]
            ];

            $file = $this->request->getFile('post_thumbnail');
            $file2 = $this->request->getFile('post_file');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $post_thumbnail = '';
                $post_file = '';
                if ($file->getName()) {
                    $post_thumbnail = $file->getRandomName();
                }
                if ($file2->getName()) {
                    $post_file = $file2->getRandomName();
                }
                $record = [
                    'username' => session()->get('akun_username'),
                    'post_title' => $this->request->getVar('post_title'),
                    'post_status' => $this->request->getVar('post_status'),
                    'post_thumbnail' => $post_thumbnail,
                    'post_file' => $post_file,
                    'post_description' => $this->request->getVar('post_description'),
                    'post_content' => $this->request->getVar('post_content'),
                    'post_id' => $post_id
                ];

                $post_type = $halaman_controller;

                $aksi = $m_posts->insertPost($record, $post_type);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        if ($dataPost['post_thumbnail']) {
                            @unlink(LOKASI_UPLOAD . "/" . $dataPost['post_thumbnail']);
                        }
                        $file->move(LOKASI_UPLOAD, $post_thumbnail);
                    }
                    if ($file2->getName()) {
                        if ($dataPost['post_file']) {
                            @unlink(LOKASI_UPLOAD_FILE . "/" . $dataPost['post_file']);
                        }
                        $file2->move(LOKASI_UPLOAD_FILE, $post_file);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/update/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/update/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_article_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
