<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $table = "services";
    protected $primaryKey = "services_id";
    protected $allowedFields = ['services_image', 'services_name', 'services_description'];

    public function insertServices($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['services_id'])) {
            $aksi = $builder->save($data);
            $id = $data['services_id'];
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

    public function listServices($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('services_name', $arr_katakunci[$x]);
            $builder->orLike('services_description', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getServices($services_id)
    {
        $builder = $this->table($this->table);

        $builder->where('services_id', $services_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteServices($services_id)
    {
        $builder = $this->table($this->table);
        $builder->where('services_id', $services_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
