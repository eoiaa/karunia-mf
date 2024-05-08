<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = "messages";
    protected $primaryKey = "messages_id";
    protected $allowedFields = ['messages_name', 'messages_email', 'messages_subject', 'messages_description'];

    public function insertMessage($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['messages_id'])) {
            $aksi = $builder->save($data);
            $id = $data['messages_id'];
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

    public function listMessage($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('messages_name', $arr_katakunci[$x]);
            $builder->orLike('messages_email', $arr_katakunci[$x]);
            $builder->orLike('messages_subject', $arr_katakunci[$x]);
            $builder->orLike('messages_description', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getMessage($messages_id)
    {
        $builder = $this->table($this->table);

        $builder->where('messages_id', $messages_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteMessage($messages_id)
    {
        $builder = $this->table($this->table);
        $builder->where('messages_id', $messages_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
