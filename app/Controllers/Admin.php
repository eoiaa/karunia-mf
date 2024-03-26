<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    function __construct(){
        $this->m_admin = new AdminModel();
        $this->validation = \Config\Services::validation();
    }
    public function login(): string
    {
        $data = [];
        if($this->request->getMethod() == 'post'){
            $rules = [
                'username'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Username harus diisi'
                    ]
                    ],
                'password'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Password harus diisi'
                    ]
                ]
            ];
            if(!$this->validate($rules)){
                session()->setFlashdata("warning", $this->validation->getErrors());
                return redirect()->to("admin");
            }
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');

            $dataAkun = $this->m_admin->getData($username);
            if(!password_verify($password, $dataAkun['password'])){
                $err[] = "Akun yang anda masukkan tidak sesuai.";
                session->setFlashData('username',$username);
                session->setFlashData('warning',$err);
                return redirect()->to("admin");
            }
            $dataAkun = $this->m_admin->getData($password);
        }
        return view('admin/v_login', $data);
    }
}
