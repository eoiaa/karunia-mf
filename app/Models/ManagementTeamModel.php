<?php

namespace App\Models;

use CodeIgniter\Model;

class ManagementTeamModel extends Model
{
    protected $table = "management_team";
    protected $primaryKey = "management_team_id";
    protected $allowedFields = ['management_team_image', 'management_team_job', 'management_team_name', 'management_team_description'];

    public function insertManagementTeam($data)
    {
        helper('global_fungsi_helper');
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['management_team_id'])) {
            $aksi = $builder->save($data);
            $id = $data['management_team_id'];
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

    public function listManagementTeam($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        #kata kunci = hello world
        $arr_katakunci = explode(" ", $katakunci);

        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('management_team_job', $arr_katakunci[$x]);
            $builder->orLike('management_team_name', $arr_katakunci[$x]);
            $builder->orLike('management_team_description', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getManagementTeam($management_team_id)
    {
        $builder = $this->table($this->table);

        $builder->where('management_team_id', $management_team_id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function deleteManagementTeam($management_team_id)
    {
        $builder = $this->table($this->table);
        $builder->where('management_team_id', $management_team_id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
