<?php

namespace App\Controllers;
use Myth\Auth\Models\GroupModel;
use App\Controllers\BaseController;
use App\Models\M_kelola_user;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class Kelola_user extends BaseController
{
    protected $datauser;
    protected $validation;

    public function __construct()
    {
        $this->datauser = new M_kelola_user(); // Initialize the model
        $this->validation = \Config\Services::validation();

    }
    public function daftaruser()
    {
        $data['users'] = $this->datauser->getusers();
        // dd($data);
        return view('V_kelolauser', $data,);
    }
    public function updateuser($id)
    {
        $data['users'] = $this->datauser->getupdate_users($id);
        // dd($data);
        return view('Form_update_user', $data,);
    }
    public function simpan_update_user($id)
    {
        $userId = $id;
        $groupId = $this->request->getVar('role'); // Assuming 'role' is the input name for the group ID

        $groupModel = new GroupModel(); // Use the correct GroupModel

        // Remove user from all groups and add to the new group
        $groupModel->removeUserFromAllGroups(intval($userId));
        $groupModel->addUserToGroup(intval($userId), intval($groupId));

        return redirect()->to(base_url('/daftaruser'));
    }

    public function deleteuser($id)
    {
        $this->datauser->delete($id);
        return redirect()->to('/daftaruser ');
    }
    
}
