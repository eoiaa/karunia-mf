<?php

namespace App\Controllers;

use App\Models\AboutModel;

class About extends BaseController
{
    public function index()
    {
        $halaman_label = "About";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('about_id')) {
            $m_about = new AboutModel();
            $dataAbout = $m_about->getAbout($this->request->getVar('about_id'));
            if ($dataAbout['about_id']) {
                $aksi = $m_about->deleteAbout($this->request->getVar('about_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/about");
        }

        $m_about = new AboutModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_about->listAbout($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_about', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "About";
        $validation = \Config\Services::validation();
        $data = [];

        $m_about = new AboutModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'about_description_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'about_description_desc' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten Harus Diisi'
                    ]
                ],
                'about_description_right_section' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten bagian kanan Harus Diisi'
                    ]
                ],
                'about_vision' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Visi harus Diisi'
                    ]
                ],
                'about_mission' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Misi Harus Diisi'
                    ]
                ],
                'about_company_history' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'History Harus Diisi'
                    ]
                ],
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $record = [
                    'about_description_title' => $this->request->getVar('about_description_title'),
                    'about_description_desc' => $this->request->getVar('about_description_desc'),
                    'about_description_right_section' => $this->request->getVar('about_description_right_section'),
                    'about_vision' => $this->request->getVar('about_vision'),
                    'about_mission' => $this->request->getVar('about_mission'),
                    'about_company_history' => $this->request->getVar('about_company_history'),
                ];

                $aksi = $m_about->insertAbout($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/about/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/about/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_about_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($about_id)
    {
        $halaman_label = "About";
        $validation = \Config\Services::validation();
        $data = [];

        $m_about = new AboutModel();

        $dataAbout = $m_about->getAbout($about_id);
        if (empty($dataAbout)) {
            return redirect()->to('admins/about');
        }

        $data = $dataAbout;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'about_description_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'about_description_desc' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten Harus Diisi'
                    ]
                ],
                'about_description_right_section' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten bagian kanan Harus Diisi'
                    ]
                ],
                'about_vision' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Visi harus Diisi'
                    ]
                ],
                'about_mission' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Misi Harus Diisi'
                    ]
                ],
                'about_company_history' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'History Harus Diisi'
                    ]
                ],
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $record = [
                    'about_description_title' => $this->request->getVar('about_description_title'),
                    'about_description_desc' => $this->request->getVar('about_description_desc'),
                    'about_description_right_section' => $this->request->getVar('about_description_right_section'),
                    'about_vision' => $this->request->getVar('about_vision'),
                    'about_mission' => $this->request->getVar('about_mission'),
                    'about_company_history' => $this->request->getVar('about_company_history'),
                    'about_id' => $about_id
                ];

                $aksi = $m_about->insertAbout($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/about/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/about/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_about_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
