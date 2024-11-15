<?php
namespace App\Models;

use CodeIgniter\Model;

class M_kelola_user extends Model
{ 
    protected $table      = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'email', 'password_hash','active'];

    public function getusers(){
        return $this-> select('users.id, username, email, g.name role')
                ->join('auth_groups_users gs', 'users.id = gs.user_id', 'left') // Mengubah join menjadi left join
                ->join('auth_groups g', 'g.id = gs.group_id', 'left') // Mengubah join menjadi left join
                ->findAll();
    }

    public function getupdate_users($id){
        return $this-> select('users.id, username, email, g.name role')
                ->join('auth_groups_users gs', 'users.id = gs.user_id', 'left') // Mengubah join menjadi left join
                ->join('auth_groups g', 'g.id = gs.group_id', 'left') // Mengubah join menjadi left join
                ->where('users.id', $id)
                ->get()
                ->getResultArray();
    }
}