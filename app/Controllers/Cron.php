<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Cron extends Controller
{
    public function reminder($token = null)
    {
        $serverToken = getenv('CRON_SECRET_TOKEN');

        if ($token !== $serverToken) {
            return $this->response->setStatusCode(401)->setBody('Unauthorized');
        }

        $db = \Config\Database::connect();

        // Ambil data barang yang jumlahnya kurang dari batas minimum
        $builder = $db->table('databarang')
            ->select('databarang.*, daftarbarang.minimum')
            ->join('daftarbarang', 'databarang.namabarang = daftarbarang.namabarang')
            ->where('databarang.jumlah < daftarbarang.minimum');
        
        $barangKurang = $builder->get()->getResult();

        if (empty($barangKurang)) {
            return 'Semua stok aman.';
        }

        // Siapkan isi email
        $pesan = "Berikut daftar barang yang stoknya kurang dari batas minimum:\n\n";

        foreach ($barangKurang as $barang) {
            $pesan .= "- {$barang->namabarang}: Jumlah {$barang->jumlah} (Minimum: {$barang->minimum})\n";
        }

        // Kirim email
        $this->kirimEmail('ilhamjullypratama3007@gmail.com', 'Peringatan Stok Barang Menipis', $pesan);

        return 'Reminder dikirim!';
    }

    private function kirimEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setFrom('noreply@contoh.com', 'Sistem Reminder');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage(nl2br($message)); // nl2br supaya enter di email kebaca

        if ($email->send()) {
            return true;
        } else {
            log_message('error', $email->printDebugger(['headers']));
            return false;
        }
    }
}
