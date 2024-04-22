<?php

namespace App\Controllers;

use App\Models\JumbotronModel;

class Jumbotron extends BaseController
{
    public function index()
    {
        $halaman_label = "Jumbotron";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('jumbotron_id')) {
            $m_jumbotron = new JumbotronModel();
            $dataJumbotron = $m_jumbotron->getJumbotron($this->request->getVar('jumbotron_id'));
            if ($dataJumbotron['jumbotron_id']) {
                @unlink(LOKASI_UPLOAD_JUMBOTRON . "/" . $dataJumbotron['jumbotron_image']);
                $aksi = $m_jumbotron->deleteJumbotron($this->request->getVar('jumbotron_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/jumbotron");
        }

        $m_jumbotron = new JumbotronModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_jumbotron->listJumbotron($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_jumbotron', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "Jumbotron";
        $validation = \Config\Services::validation();
        $data = [];

        $m_jumbotron = new JumbotronModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'jumbotron_image' => [
                    'rules' => 'is_image[jumbotron_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'jumbotron_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'jumbotron_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('jumbotron_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $jumbotron_image = '';
                if ($file->getName()) {
                    $jumbotron_image = $file->getRandomName();
                }
                $record = [
                    'jumbotron_image' => $jumbotron_image,
                    'jumbotron_title' => $this->request->getVar('jumbotron_title'),
                    'jumbotron_description' => $this->request->getVar('jumbotron_description'),
                    'jumbotron_button_text' => $this->request->getVar('jumbotron_button_text'),
                    'jumbotron_button_link' => $this->request->getVar('jumbotron_button_link'),
                ];


                $aksi = $m_jumbotron->insertJumbotron($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD_JUMBOTRON;
                        $file->move($lokasi_direktori, $jumbotron_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/jumbotron/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/jumbotron/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_jumbotron_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($jumbotron_id)
    {
        $halaman_label = "Jumbotron";
        $validation = \Config\Services::validation();
        $data = [];
        $m_jumbotron = new JumbotronModel();

        $dataJumbotron = $m_jumbotron->getJumbotron($jumbotron_id);
        if (empty($dataJumbotron)) {
            return redirect()->to('admins/jumbotron');
        }

        $data = $dataJumbotron;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'jumbotron_image' => [
                    'rules' => 'is_image[jumbotron_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'jumbotron_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Harus Diisi'
                    ]
                ],
                'jumbotron_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konten Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('jumbotron_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $jumbotron_image = '';
                if ($file->getName()) {
                    $jumbotron_image = $file->getRandomName();
                }
                $record = [
                    'jumbotron_image' => $jumbotron_image,
                    'jumbotron_title' => $this->request->getVar('jumbotron_title'),
                    'jumbotron_description' => $this->request->getVar('jumbotron_description'),
                    'jumbotron_button_text' => $this->request->getVar('jumbotron_button_text'),
                    'jumbotron_button_link' => $this->request->getVar('jumbotron_button_link'),
                    'jumbotron_id' => $jumbotron_id
                ];

                $aksi = $m_jumbotron->insertJumbotron($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        if ($dataJumbotron['jumbotron_image']) {
                            @unlink(LOKASI_UPLOAD_JUMBOTRON . "/" . $dataJumbotron['jumbotron_image']);
                        }

                        $lokasi_direktori = LOKASI_UPLOAD_JUMBOTRON;
                        $file->move($lokasi_direktori, $jumbotron_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/jumbotron/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/jumbotron/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_jumbotron_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
