<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = "contact";
    protected $primaryKey = "contact_id";
    protected $allowedFields = ['contact_location', 'contact_phone', 'contact_email'];

    public function insertContact($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['contact_id'])) {
            $aksi = $builder->save($data);
            $id = $data['contact_id'];
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

    public function listContact($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('contact_phone', $arr_katakunci[$x]);
            $builder->orLike('contact_email', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getContact($contact_id)
    {
        $builder = $this->table($this->table);

        $builder->where('contact_id', $contact_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteContact($contact_id)
    {
        $builder = $this->table($this->table);
        $builder->where('contact_id', $contact_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
