<?php

namespace App\Controllers;

use App\Models\ManagementTeamModel;

class Management_team extends BaseController
{
    public function index()
    {
        $halaman_label = "Management Team";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('management_team_id')) {
            $m_management = new ManagementTeamModel();
            $dataManagement = $m_management->getManagementTeam($this->request->getVar('management_team_id'));
            if ($dataManagement['management_team_id']) {
                @unlink(LOKASI_UPLOAD_MANAGEMENT_TEAM . "/" . $dataManagement['management_team_image']);
                $aksi = $m_management->deleteManagementTeam($this->request->getVar('management_team_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/management_team");
        }

        $m_management = new ManagementTeamModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_management->listManagementTeam($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_management_team', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "Management Team";
        $validation = \Config\Services::validation();
        $data = [];

        $m_management = new ManagementTeamModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'management_team_image' => [
                    'rules' => 'is_image[management_team_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'management_team_job' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Job Harus Diisi'
                    ]
                ],
                'management_team_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus Diisi'
                    ]
                ],
                'management_team_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi Harus Diisi'
                    ]
                ]
            ];

            $file = $this->request->getFile('management_team_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $management_team_image = '';
                if ($file->getName()) {
                    $management_team_image = $file->getRandomName();
                }
                $record = [
                    'management_team_image' => $management_team_image,
                    'management_team_job' => $this->request->getVar('management_team_job'),
                    'management_team_name' => $this->request->getVar('management_team_name'),
                    'management_team_description' => $this->request->getVar('management_team_description'),
                ];

                $aksi = $m_management->insertManagementTeam($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD_MANAGEMENT_TEAM;
                        $file->move($lokasi_direktori, $management_team_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/management_team/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/management_team/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_management_team_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($management_team_id)
    {
        $halaman_label = "Management Team";
        $validation = \Config\Services::validation();
        $data = [];

        $m_management = new ManagementTeamModel();

        $dataManagement = $m_management->getManagementTeam($management_team_id);
        if (empty($dataManagement)) {
            return redirect()->to('admins/management_team');
        }

        $data = $dataManagement;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'management_team_image' => [
                    'rules' => 'is_image[management_team_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'management_team_job' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Job Harus Diisi'
                    ]
                ],
                'management_team_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus Diisi'
                    ]
                ],
                'management_team_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi Harus Diisi'
                    ]
                ]
            ];

            $file = $this->request->getFile('management_team_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $management_team_image = '';
                if ($file->getName()) {
                    $management_team_image = $file->getRandomName();
                }
                $record = [
                    'management_team_image' => $management_team_image,
                    'management_team_job' => $this->request->getVar('management_team_job'),
                    'management_team_name' => $this->request->getVar('management_team_name'),
                    'management_team_description' => $this->request->getVar('management_team_description'),
                    'management_team_id' => $management_team_id
                ];

                $aksi = $m_management->insertManagementTeam($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        if ($dataManagement['management_team_image']) {
                            @unlink(LOKASI_UPLOAD_MANAGEMENT_TEAM . "/" . $dataManagement['management_team_image']);
                        }

                        $lokasi_direktori = LOKASI_UPLOAD_MANAGEMENT_TEAM;
                        $file->move($lokasi_direktori, $management_team_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/management_team/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/management_team/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_management_team_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
