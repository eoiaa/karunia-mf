<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = "about";
    protected $primaryKey = "about_id";
    protected $allowedFields = ['about_description_title', 'about_description_desc', 'about_description_right_section', 'about_vision', 'about_mission', 'about_company_history'];

    public function insertAbout($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['about_id'])) {
            $aksi = $builder->save($data);
            $id = $data['about_id'];
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

    public function listAbout($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('about_description_title', $arr_katakunci[$x]);
            $builder->orLike('about_description_desc', $arr_katakunci[$x]);
            $builder->orLike('about_description_right_section', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getAbout($about_id)
    {
        $builder = $this->table($this->table);

        $builder->where('about_id', $about_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteAbout($about_id)
    {
        $builder = $this->table($this->table);
        $builder->where('about_id', $about_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
