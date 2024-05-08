<?php

namespace App\Controllers;

use App\Models\BrandModel;

class Brand extends BaseController
{
    public function index()
    {
        $halaman_label = "Brand";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('brand_id')) {
            $m_brand = new BrandModel();
            $dataBrand = $m_brand->getBrand($this->request->getVar('brand_id'));
            if ($dataBrand['brand_id']) {
                @unlink(LOKASI_UPLOAD_BRAND . "/" . $dataBrand['brand_logo']);
                $aksi = $m_brand->deleteBrand($this->request->getVar('brand_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/brand");
        }

        $m_brand = new BrandModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_brand->listBrand($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_brand', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "Brand";
        $validation = \Config\Services::validation();
        $data = [];

        $m_brand = new BrandModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'brand_logo' => [
                    'rules' => 'is_image[brand_logo]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'brand_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Brand Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('brand_logo');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $brand_logo = '';
                if ($file->getName()) {
                    $brand_logo = $file->getRandomName();
                }
                $record = [
                    'brand_logo' => $brand_logo,
                    'brand_name' => $this->request->getVar('brand_name')
                ];

                $aksi = $m_brand->insertBrand($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD_BRAND;
                        $file->move($lokasi_direktori, $brand_logo);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/brand/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/brand/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_brand_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($brand_id)
    {
        $halaman_label = "Brand";
        $validation = \Config\Services::validation();
        $data = [];

        $m_brand = new BrandModel();

        $dataBrand = $m_brand->getBrand($brand_id);
        if (empty($dataBrand)) {
            return redirect()->to('admins/brand');
        }

        $data = $dataBrand;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'brand_logo' => [
                    'rules' => 'is_image[brand_logo]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang boleh diupload'
                    ]
                ],
                'brand_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Brand Harus Diisi'
                    ]
                ],
            ];

            $file = $this->request->getFile('brand_logo');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $brand_logo = '';
                if ($file->getName()) {
                    $brand_logo = $file->getRandomName();
                }
                $record = [
                    'brand_logo' => $brand_logo,
                    'brand_name' => $this->request->getVar('brand_name'),
                    'brand_id' => $brand_id
                ];

                $aksi = $m_brand->insertBrand($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    if ($file->getName()) {
                        if ($dataBrand['brand_logo']) {
                            @unlink(LOKASI_UPLOAD_BRAND . "/" . $dataBrand['brand_logo']);
                        }

                        $lokasi_direktori = LOKASI_UPLOAD_BRAND;
                        $file->move($lokasi_direktori, $brand_logo);
                    }
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/brand/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/brand/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_brand_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
