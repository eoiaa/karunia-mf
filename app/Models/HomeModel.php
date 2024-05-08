<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = "home";
    protected $primaryKey = "home_id";
    protected $allowedFields = ['home_jumbotron_image', 'home_jumbotron_title', 'home_jumbotron_description', 'home_jumbotron_button_text', 'home_jumbotron_button_link'];

    public function insertHome($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['home_id'])) {
            $aksi = $builder->save($data);
            $id = $data['home_id'];
        } else {
            $aksi = $builder->save($data);
            $id = $builder->getInsertID();
        }
        if ($aksi) {
            return $id;
        } else {
            return false;
        }
    }

    public function listHome($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('home_jumbotron_title', $arr_katakunci[$x]);
            $builder->orLike('home_jumbotron_description', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getHome($home_id)
    {
        $builder = $this->table($this->table);

        $builder->where('home_id', $home_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteHome($home_id)
    {
        $builder = $this->table($this->table);
        $builder->where('home_id', $home_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
