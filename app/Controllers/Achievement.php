<?php

namespace App\Controllers;

use App\Models\AchievementModel;

class Achievement extends BaseController
{
    public function index()
    {
        $halaman_label = "Achievement";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('achievement_id')) {
            $m_achievement = new AchievementModel();
            $dataAchievement = $m_achievement->getAchievement($this->request->getVar('achievement_id'));
            if ($dataAchievement['achievement_id']) {
                @unlink(LOKASI_UPLOAD_ACHIEVEMENT . "/" . $dataAchievement['achievement_image']);
                $aksi = $m_achievement->deleteAchievement($this->request->getVar('achievement_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/achievement");
        }

        $m_achievement = new AchievementModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_achievement->listAchievement($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_achievement', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "Achievement";
        $validation = \Config\Services::validation();
        $data = [];

        $m_achievement = new AchievementModel();

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
                ];

                $aksi = $m_achievement->insertAchievement($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD_ACHIEVEMENT;
                        $file->move($lokasi_direktori, $achievement_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/achievement/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/achievement/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_achievement_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($achievement_id)
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

                $aksi = $m_achievement->insertAchievement($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        if ($dataAchievement['achievement_image']) {
                            @unlink(LOKASI_UPLOAD_ACHIEVEMENT . "/" . $dataAchievement['achievement_image']);
                        }

                        $lokasi_direktori = LOKASI_UPLOAD_ACHIEVEMENT;
                        $file->move($lokasi_direktori, $achievement_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/achievement/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/achievement/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_achievement_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
