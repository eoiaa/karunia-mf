<?php

namespace App\Models;

use CodeIgniter\Model;

class AchievementModel extends Model
{
    protected $table = "achievement";
    protected $primaryKey = "achievement_id";
    protected $allowedFields = ['achievement_image', 'achievement_title', 'achievement_description', 'achievement_date', 'achievement_timestamp', 'achievement_category'];

    public function insertAchievement($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['achievement_id'])) {
            $aksi = $builder->save($data);
            $id = $data['achievement_id'];
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

    public function listAchievement($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('achievement_title', $arr_katakunci[$x]);
            $builder->orLike('achievement_description', $arr_katakunci[$x]);
            $builder->orLike('achievement_category', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getAchievement($achievement_id)
    {
        $builder = $this->table($this->table);

        $builder->where('achievement_id', $achievement_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteAchievement($achievement_id)
    {
        $builder = $this->table($this->table);
        $builder->where('achievement_id', $achievement_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
