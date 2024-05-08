<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\AchievementModel;
use App\Models\ContactModel;
use App\Models\HomeModel;
use App\Models\MessageModel;
use App\Models\PostsModel;
use App\Models\ServicesModel;

class Home extends BaseController
{
    public function index()
    {
        $data = [];
        $m_home = new HomeModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_home->listHome($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_home', $data);
        echo view('layout-user/footer', $data);
    }

    public function about()
    {
        $data = [];
        $m_about = new AboutModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_about->listAbout($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_about', $data);
        echo view('layout-user/footer', $data);
    }

    public function services()
    {
        $data = [];
        $m_services = new ServicesModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_services->listServices($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_services', $data);
        echo view('layout-user/footer', $data);
    }

    public function achievement()
    {
        $data = [];

        $m_achievement = new AchievementModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_achievement->listAchievement($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_achievement', $data);
        echo view('layout-user/footer', $data);
    }

    public function detailAchievement($achievement_id)
    {
        $halaman_label = "Achievement";
        $validation = \Config\Services::validation();
        $data = [];

        $m_achievement = new AchievementModel();

        $dataAchievement = $m_achievement->getAchievement($achievement_id);
        if (empty($dataAchievement)) {
            return redirect()->to('admins/achievement');
        }

        $data = $dataAchievement;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'achievement_image' => [
                    'rules' => 'is_image[achievement_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'achievement_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'achievement_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi Harus Diisi'
                    ]
                ],
                'achievement_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Penghargaan Harus Diisi'
                    ]
                ],
                'achievement_category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Penghargaan Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('achievement_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $achievement_image = '';
                if ($file->getName()) {
                    $achievement_image = $file->getRandomName();
                }
                $record = [
                    'achievement_image' => $achievement_image,
                    'achievement_title' => $this->request->getVar('achievement_title'),
                    'achievement_description' => $this->request->getVar('achievement_description'),
                    'achievement_date' => $this->request->getVar('achievement_date'),
                    'achievement_category' => $this->request->getVar('achievement_category'),
                    'achievement_id' => $achievement_id
                ];
            }
        }

        echo view('layout-user/head', $data);
        echo view('users/v_detail_achievement', $data);
        echo view('layout-user/foot', $data);
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

    public function detailArticle($post_id)
    {
        $halaman_controller = "article";
        $halaman_label = "Artikel";
        $validation = \Config\Services::validation();
        $data = [];

        $m_posts = new PostsModel();

        $dataPost = $m_posts->getPost($post_id);
        if (empty($dataPost)) {
            return redirect()->to('/update');
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
                ]
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
                    'post_description' => $this->request->getVar('post_description'),
                    'post_content' => $this->request->getVar('post_content'),
                    'post_file' => $post_file,
                    'post_id' => $post_id
                ];
            }
        }

        echo view('layout-user/header', $data);
        echo view('users/v_detail_article', $data);
        echo view('layout-user/footer', $data);
    }

    public function contact()
    {
        $data = [];
        $m_contact = new ContactModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 5;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_contact->listContact($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-user/header', $data);
        echo view('users/v_contact', $data);
        echo view('layout-user/footer', $data);
    }

    public function messages()
    {
        $validation = \Config\Services::validation();
        $data = [];

        $m_message = new MessageModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'messages_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus Diisi'
                    ]
                ],
                'messages_email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email Harus Diisi'
                    ]
                ],
                'messages_subject' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Subjek Harus Diisi'
                    ]
                ],
                'messages_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi Harus Diisi'
                    ]
                ]
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $record = [
                    'messages_name' => $this->request->getVar('messages_name'),
                    'messages_email' => $this->request->getVar('messages_email'),
                    'messages_subject' => $this->request->getVar('messages_subject'),
                    'messages_description' => $this->request->getVar('messages_description')
                ];

                $aksi = $m_message->insertMessage($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('contact');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('contact');
                }
            }
        }


        echo view('layout-user/header', $data);
        echo view('users/v_contact', $data);
        echo view('layout-user/footer', $data);
    }
}
