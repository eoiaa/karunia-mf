<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Socials extends BaseController
{
    public function index()
    {
        $data = [];
        $validation = \Config\Services::validation();
        $m_posts = new PostsModel();
        helper('global_fungsi_helper');
        $halaman_controller = "socials";
        $halaman_label = "Social Media";

        if ($this->request->getMethod() == 'post') {
            $konfigurasi_name = 'set_socials_instagram';
            $dataSimpan = [
                'konfigurasi_value' => $this->request->getVar('set_socials_instagram')
            ];
            konfigurasi_set($konfigurasi_name, $dataSimpan);

            $dataSimpan = [
                'konfigurasi_value' => $this->request->getVar('set_socials_facebook')
            ];
            konfigurasi_set($konfigurasi_name, $dataSimpan);

            $dataSimpan = [
                'konfigurasi_value' => $this->request->getVar('set_socials_twitter')
            ];
            konfigurasi_set($konfigurasi_name, $dataSimpan);

            session()->setFlashdata('success', 'Data Berhasil Disimpan');
            return redirect()->to('admins/socials');
        }
        $konfigurasi_name = 'set_socials_instagram';
        $data['set_socials_instagram'] = isset(konfigurasi_get($konfigurasi_name)['konfigurasi_value']);

        $konfigurasi_name = 'set_socials_facebook';
        $data['set_socials_facebook'] = isset(konfigurasi_get($konfigurasi_name)['konfigurasi_value']);

        $konfigurasi_name = 'set_socials_twitter';
        $data['set_socials_twitter'] = isset(konfigurasi_get($konfigurasi_name)['konfigurasi_value']);

        echo view('layout-admin/header', $data);
        echo view('layout-admin/navbar', $data);
        echo view('admins/v_socials', $data);
        echo view('layout-admin/footer', $data);
    }
}
