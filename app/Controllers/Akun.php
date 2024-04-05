<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Akun extends BaseController
{
    public function index()
    {
        $data = [];
        $validation = \Config\Services::validation();
        $m_admin = new AdminModel();
        helper('global_fungsi_helper');
        $halaman_controller = "akun";
        $halaman_label = "Akun";

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $nama_lengkap = $this->request->getVar('nama_lengkap');
            $password_lama = $this->request->getVar('password_lama');
            $password_baru = $this->request->getVar('password_baru');
            $password_baru_konfirmasi = $this->request->getVar('password_baru_konfirmasi');

            $aturan = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap wajib diisi'
                    ]
                ]
            ];

            if ($password_baru != '') {
                $aturan = [
                    'password_lama' => [
                        'rules' => 'required|check_old_password[password_lama]',
                        'errors' => [
                            'required' => 'Password Lama wajib diisi',
                            'check_old_password' => 'Password Lama salah'
                        ]
                    ],
                    'password_baru' => [
                        'rules' => 'min_length[5]|alpha_numeric',
                        'errors' => [
                            'min_length' => 'Minimal panjang password adalah 5 karakter',
                            'alpha_numeric' => 'Hanya angka, Huruf, dan beberapa simbol saja yang diperbolehkan'
                        ]
                    ],
                    'password_baru_konfirmasi' => [
                        'rules' => 'matches[password_baru]',
                        'errors' => [
                            'matches' => 'Konfirmasi password tidak sesuai dengan kolom Password Baru',
                        ]
                    ]
                ];
            }

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $dataUpdate = [
                    'email' => session()->get('akun_email'),
                    'nama_lengkap' => $nama_lengkap
                ];
                $m_admin->updateData($dataUpdate);

                $sesi = [
                    'akun_nama_lengkap' => $nama_lengkap
                ];
                session()->set($sesi);

                if ($password_baru != '') {
                    $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
                    $dataUpdate = [
                        'email' => session()->get('akun_email'),
                        'password' => $password_baru
                    ];
                    $m_admin->updateData($dataUpdate);

                    helper('cookie');
                    if (get_cookie('cookie_password')) {
                        set_cookie("cookie_username", session()->get('akun_username'), 3600 * 24 * 30);
                        set_cookie("cookie_password", $password_baru, 3600 * 24 * 30);
                    }
                }

                session()->setFlashdata('success', 'Data Akun berhasil diupdate');
            }

            return redirect()->to('admins/akun')->withCookies();
        }
        $username = session()->get('akun_username');
        $data = $m_admin->getData($username);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_akun', $data);
        echo view('layout-admin/footer', $data);
    }
}
