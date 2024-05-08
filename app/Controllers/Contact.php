<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Contact extends BaseController
{
    public function index()
    {
        $halaman_label = "Contact";
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('contact_id')) {
            $m_contact = new ContactModel();
            $dataContact = $m_contact->getContact($this->request->getVar('contact_id'));
            if ($dataContact['contact_id']) {
                $aksi = $m_contact->deleteContact($this->request->getVar('contact_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', 'Data Berhasil Dihapus');
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dihapus']);
                }
            }
            return redirect()->to("admins/contact");
        }

        $m_contact = new ContactModel();
        helper('global_fungsi_helper');

        $jumlahBaris = 10;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $m_contact->listContact($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_contact', $data);
        echo view('layout-admin/footer', $data);
    }
    public function tambah()
    {
        $halaman_label = "Contact";
        $validation = \Config\Services::validation();
        $data = [];

        $m_contact = new ContactModel();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'contact_location' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Harus Diisi'
                    ]
                ],
                'contact_phone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No. Telp Harus Diisi'
                    ]
                ],
                'contact_email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Harus Diisi'
                    ]
                ],
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $record = [
                    'contact_location' => $this->request->getVar('contact_location'),
                    'contact_phone' => $this->request->getVar('contact_phone'),
                    'contact_email' => $this->request->getVar('contact_email')
                ];

                $aksi = $m_contact->insertContact($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    session()->setFlashdata('success', 'Data Berhasil Dimasukkan');
                    return redirect()->to('admins/contact/edit/' . $page_id);
                } else {
                    session()->setFlashdata('warning', ['Data Gagal Dimasukkan']);
                    return redirect()->to('admins/contact/tambah');
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_contact_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
    public function edit($contact_id)
    {
        $halaman_label = "Contact";
        $validation = \Config\Services::validation();
        $data = [];

        $m_contact = new ContactModel();

        $dataContact = $m_contact->getContact($contact_id);
        if (empty($dataContact)) {
            return redirect()->to('admins/contact');
        }

        $data = $dataContact;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $aturan = [
                'contact_location' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Harus Diisi'
                    ]
                ],
                'contact_phone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No. Telp Harus Diisi'
                    ]
                ],
                'contact_email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Harus Diisi'
                    ]
                ],
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $record = [
                    'contact_location' => $this->request->getVar('contact_location'),
                    'contact_phone' => $this->request->getVar('contact_phone'),
                    'contact_email' => $this->request->getVar('contact_email'),
                    'contact_id' => $contact_id
                ];

                $aksi = $m_contact->insertContact($record);
                if ($aksi != false) {
                    $page_id = $aksi;
                    session()->setFlashdata('success', 'Data Berhasil Dirubah');
                    return redirect()->to('admins/contact/edit/' . $page_id);
                } else {
                    $page_id = $aksi;
                    session()->setFlashdata('warning', ['Data Gagal Diubah']);
                    return redirect()->to('admins/contact/edit/' . $page_id);
                }
            }
        }

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_contact_tambah', $data);
        echo view('layout-admin/footer', $data);
    }
}
