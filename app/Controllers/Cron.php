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
            ->select('databarang.kodebarang, databarang.namabarang, databarang.jumlah,databarang.satuan, daftarbarang.minimum')
            ->join('daftarbarang', 'databarang.namabarang = daftarbarang.namabarang')
            ->where('databarang.jumlah < daftarbarang.minimum');
        
        $barangKurang = $builder->get()->getResult();

        // Hitung tanggal 4 bulan berikutnya
        $tanggal4BulanDepan = date('Y-m-d', strtotime('+4 months'));

        // Ambil data barang yang akan kedaluwarsa sebelum tanggal 4 bulan berikutnya
        $builderED = $db->table('databarang')
            ->select('databarang.kodebarang, databarang.satuan, databarang.jumlah, databarang.namabarang, databarang.expired, daftarbarang.minimum')
            ->join('daftarbarang', 'databarang.namabarang = daftarbarang.namabarang')
            ->where('databarang.expired <', $tanggal4BulanDepan); 
 
        $barangED = $builderED->get()->getResult();

        if (empty($barangKurang) && empty($barangED)) {
            return 'Semua stok aman dan tidak ada barang yang akan kedaluwarsa.';
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
              padding: 10px;
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
              <h1>Peringatan Stok Barang Menipis & Barang yang Akan ED QA Kalkual</h1>
            </div>
            <div class="email-body">
              <h3>Berikut daftar barang yang stoknya kurang dari batas minimum:</h3>
              <table>
                <thead>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                     <th>Satuan</th>
                    <th>Batas Minimum</th>
                  </tr>
                </thead>
                <tbody>';

        foreach ($barangKurang as $barang) {
            $pesan .= '
              <tr>
                <td>' . htmlspecialchars($barang->kodebarang) . '</td>
                <td>' . htmlspecialchars($barang->namabarang) . '</td>
                <td>' . htmlspecialchars($barang->jumlah) . '</td>
                <td>' . htmlspecialchars($barang->satuan) . '</td>
                <td>' . htmlspecialchars($barang->minimum) . '</td>
              </tr>';
        }

        $pesan .= '
            </tbody>
          </table>

          <h3>Berikut daftar barang yang akan kedaluwarsa Dalam Rentang 4 bulan lagi :</h3>
          <table>
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Kedaluwarsa</th>
                <th>Jumlah</th>
                 <th>Satuan</th>
              </tr>
            </thead>
            <tbody>';

        foreach ($barangED as $barang) {
            $pesan .= '
              <tr>
                <td>' . htmlspecialchars($barang->kodebarang) . '</td>
                <td>' . htmlspecialchars($barang->namabarang) . '</td>
                <td>' . htmlspecialchars($barang->expired) . '</td>
                <td>' . htmlspecialchars($barang->jumlah) . '</td>
                 <td>' . htmlspecialchars($barang->satuan) . '</td>
              </tr>';
        }

        $pesan .= '
            </tbody>
          </table>
        </div>
        <div class="email-footer">
          <p>&copy; 2025 QA . Semua hak dilindungi.</p>
        </div>
      </div>
    </body>
  </html>';

        // Kirim email
        $this->kirimEmail('ilhamjullypratama3007@gmail.com', 'Peringatan Stok Barang Menipis dan Barang yang Akan ED QA Kalkual', $pesan);

        return 'Reminder dikirim!';
    }

    private function kirimEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setFrom('noreply@QA.com', 'Sistem Reminder');
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
