<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = "brand";
    protected $primaryKey = "brand_id";
    protected $allowedFields = ['brand_logo', 'brand_name'];

    public function insertBrand($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['brand_id'])) {
            $aksi = $builder->save($data);
            $id = $data['brand_id'];
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

    public function listBrand($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('brand_name', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getBrand($brand_id)
    {
        $builder = $this->table($this->table);

        $builder->where('brand_id', $brand_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteBrand($brand_id)
    {
        $builder = $this->table($this->table);
        $builder->where('brand_id', $brand_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
