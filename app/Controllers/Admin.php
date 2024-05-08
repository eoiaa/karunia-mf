<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Config\Config;

class Admin extends BaseController
{
    // function __construct()
    // {
    //     $m_admin = new AdminModel();
    //     $validation = \Config\Services::validation();
    // }
    public function login()
    {
        helper("cookie");
        $m_admin = new AdminModel();
        $validation = \Config\Services::validation();
        $data = [];
        $data['templateJudul'] = "Login";

        if (get_cookie('cookie_username') && get_cookie('cookie_password')) {
            $username = get_cookie('cookie_username');
            $password = get_cookie('cookie_password');

            $dataAkun = $m_admin->getData($username);
            if ($password != $dataAkun['password']) {
                $err[] = "Akun yang kamu masukkan tidak sesuai";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);

                delete_cookie('cookie_username');
                delete_cookie('cookie_password');
                return redirect()->to('admins');
            }
        }
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username harus diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata("warning", $validation->getErrors());
                return redirect()->to('admins');
            }
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');

            $dataAkun = $m_admin->getData($username);
            // $dataAkun = $m_admin->getData($password);
            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = "Akun yang anda masukkan tidak sesuai.";
                session()->setFlashData('username', $username);
                session()->setFlashData('warning', $err);
                return redirect()->to('admins');
            }

            if ($remember_me == '1') {
                set_cookie("cookie_username", $username, 3600 * 24 * 30);
                set_cookie("cookie_password", $dataAkun['password'], 3600 * 24 * 30);
            }

            $akun = [
                'akun_username' => $dataAkun['username'],
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_email' => $dataAkun['email']
            ];
            session()->set($akun);
            return redirect()->to('admins/sukses')->withCookies();
        }
        echo view('layout-login/header', $data);
        echo view('admins/v_login', $data);
        echo view('layout-login/footer', $data);
    }

    public function sukses()
    {
        // helper("cookie");
        // print_r(session()->get());
        // return "ISIAN COOKIE USERNAME" . \get_cookie("cookie_username") . "DAN PASSWORD" . \get_cookie("cookie_password");
        return redirect()->to('admins/jumbotron');
    }

    public function logout()
    {
        $data = [];
        $data['templateJudul'] = "Login";

        helper("cookie");
        delete_cookie("cookie_username");
        delete_cookie("cookie_password");
        session()->destroy();
        if (session()->get('akun_username') != '') {
            session()->setFlashdata("success", "Anda Berhasil Log Out");
        }
        echo view('layout-login/header', $data);
        echo view('admins/v_login', $data);
        echo view('layout-login/footer', $data);
    }

    public function lupapassword()
    {
        $data = [];
        $data['templateJudul'] = "Lupa Password";

        helper("global_fungsi_helper");
        $m_admin = new AdminModel();
        $err = [];
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getVar('username');
            if ($username == '') {
                $err[] = "Silahkan masukkan username atau email";
            }
            if (empty($err)) {
                $data = $m_admin->getData($username);
                if (empty($data)) {
                    $err[] = "Akun yang anda masukkan tidak terdaftar";
                }
            }
            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));

                $link = site_url("admins/resetpassword/?email=$email&token=$token");
                $attachment = "";
                $to = $email;
                $title = "Reset Password";
                $message = "Berikut adalah link untuk melakukan Reset Password";
                $message .= "Silahkan Klik Link berikut ini $link";

                kirim_email($attachment, $to, $title, $message);

                $dataUpdate = [
                    'email' => $email,
                    'token' => $token
                ];
                $m_admin->updateData($dataUpdate);
                session()->setFlashdata("success", "Verifikasi recovery sudah kami kirimkan ke email anda");
            }
            if ($err) {
                session()->setFlashdata("username", $username);
                session()->setFlashdata("warning", $err);
            }
            return redirect()->to('admins/lupapassword');
        }
        echo view("layout-login/header", $data);
        echo view("admins/v_lupapassword", $data);
        echo view('layout-login/footer', $data);
    }

    function resetpassword()
    {
        helper("cookie");
        $data = [];
        $data['templateJudul'] = "Reset Password";

        $m_admin = new AdminModel();
        $err = [];

        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        $validation = \Config\Services::validation();

        if ($email != '' and $token != '') {
            $dataAkun = $m_admin->getData($email);
            if ($dataAkun['token'] != $token) {
                $err[] = "Token tidak Valid";
            }
        } else {
            $err[] = "Parameter yang dikirim tidak valid";
        }

        if ($err) {
            session()->setFlashdata("warning", $err);
        }

        if ($this->request->getMethod() == 'post') {
            $aturan = [
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Panjang karakter untuk Password adalah 5 karakter'
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[5]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi Password harus diisi',
                        'min_length' => 'Panjang karakter untuk Konfirmasi Password adalah 5 karakter',
                        'matches' => 'Konfirmasi password tidak sesuai dengan password yang diisi'
                    ]
                ]
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $validation->getErrors());
            } else {
                $dataUpdate = [
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'token' => null,
                ];

                delete_cookie('cookie_username');
                delete_cookie('cookie_password');

                $m_admin->updateData($dataUpdate);
                session()->setFlashdata('success', 'Password berhasil di reset, silahkan login');
                return redirect()->to('admins');
            }
        }

        echo view("layout-login/header", $data);
        echo view("admins/v_resetpassword", $data);
        echo view('layout-login/footer', $data);
    }
}
