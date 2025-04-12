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

        // Buat isi email dalam format HTML tabel
        $pesan = '
        <html>
        <head>
          <style>
            body {
              font-family: Arial, sans-serif;
              background-color: #f4f4f4;
              color: #333;
              margin: 0;
              padding: 0;
            }
            .email-container {
              width: 600px;
              margin: 0 auto;
              background-color: #ffffff;
              border-radius: 8px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .email-header {
              background-color: #007bff;
              color: white;
              padding: 20px;
              text-align: center;
              border-top-left-radius: 8px;
              border-top-right-radius: 8px;
            }
            .email-body {
              padding: 20px;
            }
            .email-footer {
              background-color: #f8f9fa;
              text-align: center;
              padding: 10px;
              border-bottom-left-radius: 8px;
              border-bottom-right-radius: 8px;
              font-size: 12px;
            }
            table {
              width: 100%;
              border-collapse: collapse;
              margin: 20px 0;
            }
            th, td {
              padding: 10px;
              text-align: left;
              border: 1px solid #ddd;
            }
            th {
              background-color: #f1f1f1;
            }
            h3 {
              color: #333;
            }
          </style>
        </head>
        <body>
          <div class="email-container">
            <div class="email-header">
              <h1>Peringatan Stok Barang Menipis</h1>
            </div>
            <div class="email-body">
              <h3>Berikut daftar barang yang stoknya kurang dari batas minimum:</h3>
              <table>
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Batas Minimum</th>
                  </tr>
                </thead>
                <tbody>';

        foreach ($barangKurang as $barang) {
            $pesan .= '
              <tr>
                <td>' . htmlspecialchars($barang->namabarang) . '</td>
                <td>' . htmlspecialchars($barang->jumlah) . '</td>
                <td>' . htmlspecialchars($barang->minimum) . '</td>
              </tr>';
        }

        $pesan .= '
            </tbody>
          </table>
        </div>
        <div class="email-footer">
          <p>&copy; 2025 QA Bintang7. Semua hak dilindungi. |</p>
        </div>
      </div>
    </body>
  </html>';

        // Kirim email
        $this->kirimEmail('ilhamjullypratama3007@gmail.com', 'Peringatan Stok Barang Menipis', $pesan);

        return 'Reminder dikirim!';
    }

    private function kirimEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setFrom('noreply@QA_B7.com', 'Sistem Reminder');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->setMailType('html'); // <<< Pastikan menggunakan HTML

        if ($email->send()) {
            return true;
        } else {
            log_message('error', $email->printDebugger(['headers']));
            return false;
        }
    }
}
