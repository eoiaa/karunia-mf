<?php

namespace App\Controllers;

use App\Models\ServicesModel;

class Services extends BaseController
{
    public function index()
    {
        $halaman_label = "Services";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('services_id')) {
            $m_services = new ServicesModel();
            $dataServices = $m_services->getServices($this->request->getVar('services_id'));
            if ($dataServices['services_id']) {
                @unlink(LOKASI_UPLOAD_SERVICE_IMAGE . "/" . $dataServices['services_image']);
                $aksi = $m_services->deleteServices($this->request->getVar('services_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/services");
        }

        $m_services = new ServicesModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_services->listServices($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_services', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "Services";
        $validation = \Config\Services::validation();
        $data = [];

        $m_services = new ServicesModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'services_image' => [
                    'rules' => 'is_image[services_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'services_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Job Harus Diisi'
                    ]
                ],
                'services_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('services_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $services_image = '';
                if ($file->getName()) {
                    $services_image = $file->getRandomName();
                }
                $record = [
                    'services_image' => $services_image,
                    'services_name' => $this->request->getVar('services_name'),
                    'services_description' => $this->request->getVar('services_description'),
                ];

                $aksi = $m_services->insertServices($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        $file->move(LOKASI_UPLOAD_SERVICE_IMAGE, $services_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/services/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/services/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_services_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($services_id)
    {
        $halaman_label = "Services";
        $validation = \Config\Services::validation();
        $data = [];

        $m_services = new ServicesModel();

        $dataServices = $m_services->getServices($services_id);
        if (empty($dataServices)) {
            return redirect()->to('admins/services');
        }

        $data = $dataServices;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'services_image' => [
                    'rules' => 'is_image[services_image]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'services_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Job Harus Diisi'
                    ]
                ],
                'services_description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('services_image');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $services_image = '';
                if ($file->getName()) {
                    $services_image = $file->getRandomName();
                }
                $record = [
                    'services_image' => $services_image,
                    'services_name' => $this->request->getVar('services_name'),
                    'services_description' => $this->request->getVar('services_description'),
                    'services_id' => $services_id
                ];

                $aksi = $m_services->insertServices($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        if ($dataServices['services_image']) {
                            @unlink(LOKASI_UPLOAD_SERVICE_IMAGE . "/" . $dataServices['services_image']);
                        }
                        $file->move(LOKASI_UPLOAD_SERVICE_IMAGE, $services_image);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/services/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/services/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_services_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
