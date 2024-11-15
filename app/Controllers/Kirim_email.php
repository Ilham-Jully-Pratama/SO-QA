<?php

namespace App\Controllers;

use App\Models\M_databarang; // Add this line to import the model
use App\Controllers\BaseController;
class Home extends BaseController
{

    protected $databarangModel; // Add this property
    protected $session; // Deklarasi properti session
    protected $validation;
    public function __construct()
    {
        $this->databarangModel = new M_databarang(); // Initialize the model
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation(); // Correct way to load validation service
    }
    public function kirim_email(){
        $email= \config\Services::email();
        $alamat_email="ilhamjullypratama3007@gmail.com";
        $email->setTo($alamat_email);
        $alamat_pengirim="ilhamjullypratama3007@gmail.com";
        $email->setFrom($alamat_pengirim);
        $subject="test email";
        $email->setSubject($subject);
        $isi_pesan=" ini latihan kirim email  ";
        $email->setMessage($isi_pesan); 
        
        // Tambahkan baris ini untuk mengirim email
        if ($email->send()) {
            return "Email berhasil dikirim.";
        } else {
            return "Gagal mengirim email: " . $email->printDebugger();
        }
    }
}





