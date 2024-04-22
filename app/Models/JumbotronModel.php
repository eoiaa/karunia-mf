<?php

namespace App\Models;

use CodeIgniter\Model;

class JumbotronModel extends Model
{
    protected $table = "jumbotron";
    protected $primaryKey = "jumbotron_id";
    protected $allowedFields = ['jumbotron_image', 'jumbotron_title', 'jumbotron_description', 'jumbotron_button_text', 'jumbotron_button_link'];

    public function insertJumbotron($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['jumbotron_id'])) {
            $aksi = $builder->save($data);
            $id = $data['jumbotron_id'];
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

    public function listJumbotron($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('jumbotron_title', $arr_katakunci[$x]);
            $builder->orLike('jumbotron_description', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getJumbotron($jumbotron_id)
    {
        $builder = $this->table($this->table);

        $builder->where('jumbotron_id', $jumbotron_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteJumbotron($jumbotron_id)
    {
        $builder = $this->table($this->table);
        $builder->where('jumbotron_id', $jumbotron_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
