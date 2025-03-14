<?php

namespace App\Controllers;

use App\Models\M_databarang; // Add this line to import the model
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
class Home extends BaseController
{

    protected $databarangModel;
    protected $dompdf;  // Add this property
    protected $session; // Deklarasi properti session
    protected $validation;
    public function __construct()
    {
        $this->databarangModel = new M_databarang();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        // Correct way to load validation service
    }

    public function index(): string
    {
        // $email= \config\Services::email();
        $data['itemcount'] = $this->databarangModel->itemcount();
        // dd($data);
        $data['cekexpired'] = $this->databarangModel->cekexpired();

        if (count($data['cekexpired']) > 0 || count($data['itemcount']) > 0) {
            if(count($data['cekexpired']) > 0 && count($data['itemcount']) > 0){
                $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan Habis & ED cek Dashboard');
                //buat isi email 
                // $alamat_email="ilhamjullypratama3007@gmail.com";
                // $email->setTo($alamat_email);
                // $alamat_pengirim="ilhamjullypratama3007@gmail.com";
                // $email->setFrom($alamat_pengirim);
                // $subject="SO Barang Kalkual";
                // $email->setSubject($subject);
                // // Tabel untuk itemcount
                // $isi_pesan = "Berikut List Barang Kalkual yang akan Habis <br><br>";
                // $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                // $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
                // foreach ($data['itemcount'] as $item) { // Iterasi melalui itemcount
                //     $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['satuan'] . '</td>'; // Satuan
                //     $isi_pesan .= '</tr>'; // Menutup baris
                // }
                // $isi_pesan .= '</table><br>'; // Menutup tabel dan menambahkan jarak

                // // Tabel untuk cekexpired
                // $isi_pesan .= "Berikut List Barang Kalkual yang akan ED <br><br>";
                // $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                // $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Expired</th></tr>'; // Header tabel
                // foreach ($data['cekexpired'] as $item) { // Iterasi melalui cekexpired
                //     $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['expired'] . '</td>'; // Expired
                //     $isi_pesan .= '</tr>'; // Menutup baris
                // }
                // $isi_pesan .= '</table>'; // Menutup tabel
                // $email->setMessage($isi_pesan); 
                // $email->send();
                return view('Homepage');   
            }elseif(count($data['itemcount']) > 0){
                $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan Habis cek Dashboard');

                // $alamat_email="ilhamjullypratama3007@gmail.com";
                // $email->setTo($alamat_email);
                // $alamat_pengirim="ilhamjullypratama3007@gmail.com";
                // $email->setFrom($alamat_pengirim);
                // $subject="SO Barang Kalkual";
                // $email->setSubject($subject);
                // $isi_pesan = "Berikut List Barang Kalkual yang akan Habis <br><br>"; // Menambahkan jarak ke bawah
                // $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                // $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
                // foreach ($data['itemcount'] as $item) { // Iterasi melalui itemcount
                //     $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                //     $isi_pesan .= '<td style="padding: 10px;">' . $item['satuan'] . '</td>'; // Satuan
                //     $isi_pesan .= '</tr>'; // Menutup baris
                // }
                // $isi_pesan .= '</table>'; // Menutup tabel
                // $email->setMessage($isi_pesan); 
                // $email->send();
                return view('Homepage');
            }
            $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan ED cek Dashboard');
            // $alamat_email="ilhamjullypratama3007@gmail.com";
            // $email->setTo($alamat_email);
            // $alamat_pengirim="ilhamjullypratama3007@gmail.com";
            // $email->setFrom($alamat_pengirim);
            // $subject="SO Barang Kalkual";
            // $email->setSubject($subject);
            // $isi_pesan = "Berikut List Barang Kalkual yang akan ED <br><br>"; // Menambahkan jarak ke bawah
            // $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
            // $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
            // foreach ($data['cekexpired'] as $item) { // Iterasi melalui itemcount
            //     $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
            //     $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
            //     $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
            //     $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
            //     $isi_pesan .= '<td style="padding: 10px;">' . $item['expired'] . '</td>'; // Satuan
            //     $isi_pesan .= '</tr>'; // Menutup baris
            // }
            // $isi_pesan .= '</table>'; // Menutup tabel
            // $email->setMessage($isi_pesan); 
            // $email->send();
            return view('Homepage'); 
        }
        $this->session->setFlashdata('pesanhompage', ' Tidak Ada barang yang akan ED dan Habis');
        return view('Homepage');
    }
    public function databarang(): string
    {
        $katakunci = $this->request->getGet('katakunci');
        if ($katakunci) {
            $cari = $this->databarangModel->cari($katakunci); // Eksekusi query pencarian
        } else {
            $cari = $this->databarangModel->paginate(4); // Ambil semua data dengan pagination
        }
        $data['katakunci'] = $katakunci;
        $data['title'] = "Data Barang Kalkual";
        $data['barang'] = $cari; // Simpan hasil pencarian atau semua data
        $data['pager'] = $this->databarangModel->pager;
        
        // Return view dengan data yang benar
        return view('So_barang/V_databarang', $data);
    }
    public function cetakdatabarang()
    {
        $data['barang'] = $this->databarangModel->ambildatabarang();
        $dompdf = new Dompdf();
        $html= view('So_barang/V_Cetak_databarang', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Data Barang Kalkual.pdf", ["Attachment" => 0]);
exit();

    }
    public function tambah_data_barang(): string
    {
        
        $data['barang'] = $this->databarangModel->caridaftarbarang();
        
        return view('So_barang/Form_tambah_barang_baru',$data );

    }
    public function submitbarangbaru()
    {
        // validasi input//
        if ($this->validate([
            'kodebarang' => 'required|is_unique[databarang.kodebarang]',
            'namabarang' => 'required',
            'satuan'     => 'required',
            'jumlahbarang'     => 'required',
            'expired'    => 'required',
            'coa'        => 'required',
            'msds'       => 'required',
            'tanggal'    => 'required',
            'merek'    => 'required',
            'tanggal_kedatangan'    => 'required',
        ],[
            'kodebarang'=>[
                'required' =>'Kode Barang Harus Di isi',
                'is_unique'=>'Kode Barang Sudah digunakan'
            ],
            'namabarang'=>[
                'required'=> 'Nama Barang Harus Di isi'
            ],
            'satuan'=>[
                'required'=> 'Satuan Barang Harus Di isi'
            ],
            'jumlahbarang'=>[
                'required'=> 'Jumlah Barang Harus Di isi'
            ],
            'expired'=>[
                'required'=> 'Expired Barang Harus Di isi'
            ],
            'coa'=>[
                'required'=> 'COA Barang Harus Di isi'
            ],
            'msds'=>[
                'required'=> 'MSDS Barang Harus Di isi'
            ],
            'tanggal'=>[
                'required'=> 'MSDS Barang Harus Di isi'
            ],
            'merek'=>[
                'required'=> 'Merek Barang Harus Di isi'
            ],
            'tanggal_kedatangan'=>[
                'required'=> 'Harus Di isi'
            ],
                     
        ])) { // Perbaiki di sini
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'expired' => $this->request->getVar('expired'),
                'nama' => $this->request->getVar('nama'),
                'coa' => $this->request->getVar('coa'),
                'msds' => $this->request->getVar('msds'),
                'tanggal' => $this->request->getVar('tanggal'),
                'merek' => $this->request->getVar('merek'),
                'tanggal_datang' => $this->request->getVar('tanggal_kedatangan'),
                
            ];
            $this->databarangModel->submitbarangbaru($data);
            $this->session->setFlashdata('pesan', 'Data berhasil ditambahkan!'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/databarang',);           
        }
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function ubahbarang($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->ambildatabarangubah($kodebarang);
        return view('So_barang/Form_ubah_barang',$data );
    }
    public function submit_ubah_barang($id)
    { 
       
        if ($this->validate([
            'kodebarang' => "required|is_unique[databarang.kodebarang.id, id, {$id}]",
            'namabarang' => 'required',
            'satuan'     => 'required',
            'jumlahbarang' => 'required',
            'expired'    => 'required',
            'coa'        => 'required',
            'msds'       => 'required',
            'merek'       => 'required',
        ],[
            'kodebarang'=>[
                'required' =>'Kode Barang Harus Di isi',
                'is_unique'=>'Kode Barang Sudah digunakan'
            ],
            'namabarang'=>[
                'required'=> 'Nama Barang Harus Di isi'
            ],
            'satuan'=>[
                'required'=> 'Satuan Barang Harus Di isi'
            ],
            'jumlahbarang'=>[
                'required'=> 'Jumlah Barang Harus Di isi'
            ],
            'expired'=>[
                'required'=> 'Expired Barang Harus Di isi'
            ],
            'coa'=>[
                'required'=> 'COA Barang Harus Di isi'
            ],
            'msds'=>[
                'required'=> 'MSDS Barang Harus Di isi'
            ],
            'merek'=>[
                'required'=> 'Merek Barang Harus Di isi'
            ],
            'tanggal_kedatangan'=>[
                'required'=> 'Merek Barang Harus Di isi'
            ],
                     
        ])) { // Perbaiki di sini
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'expired' => $this->request->getVar('expired'),
                'nama' => $this->request->getVar('nama'),
                'coa' => $this->request->getVar('coa'),
                'msds' => $this->request->getVar('msds'),
                'merek' => $this->request->getVar('merek'),
                'tanggal_datang' => $this->request->getVar('tanggal_kedatangan'),
                
            ];
            $this->databarangModel->submitubahbarang($data,$id);
            $this->session->setFlashdata('pesan', 'Data Berhasil Terupdate'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/databarang',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function delete($id)
    { 
        $this->databarangModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/databarang ');
    }
    public function submitnamabarang()
    { 
        if ($this->validate([
            'namabarang' => 'required',
        ],[
            'namabarang'=>[
                'required'=> 'Nama Harus Disi'
            ]
                     
        ])) { // Perbaiki di sini
            $data = [
                
                'namabarang' => $this->request->getVar('namabarang'),
                              
            ];
            $this->databarangModel->submitnamabarang($data);
            $this->session->setFlashdata('pesan', 'Data Berhasil Ditambahkan'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/tambah_data_barang');      
        }
        session()->setFlashdata('alert', 'Data Belum Ditambahkan');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function daftarnamabarang(): string
    { 
        return view('So_barang/Form_nama_barang', );

    }
    public function hapusnamabarang(): string
    { 
        $data['barang'] = $this->databarangModel->caridaftarbarang();
        return view('So_barang/V_list_nama_barang', $data);
    }
    public function deletedaftarnamabarang($id)
    { 
        $this->databarangModel->deletedaftarnamabarang($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/tambah_data_barang');
    }

// barang masuk
    public function barang_masuk($kodebarang): string
    {
       
        $data['masuk'] = $this->databarangModel->ambildatabarangmasuk($kodebarang);
        $data['title'] = "Tambah Barang Masuk";
        
        // Gabungkan $data dan $validasi
        return view('So_barang/Form_barang_masuk', array_merge($data,));
    }
    
    public function submit_barang_masuk(){

        // Correct way to set validation rules
        if ($this->validate([
            'jumlahbarang' => 'required',
            'tanggal'      => 'required',
            'keterangan'      => 'required',
        ],[
            'jumlahbarang'=>[
                'required' =>'jumlah barang harus diisi'
            ],
            'tanggal'=>[
                'required' =>'tanggal harus diisi'
            ],
            'keterangan'=>[
                'required' =>'keterangan harus diisi'
            ],
            

        ])) {
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'expired' => $this->request->getVar('expired'),
                'nama' => $this->request->getVar('nama'),
                'merek' => $this->request->getVar('merek'),
                'tanggal' => $this->request->getVar('tanggal'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];
            $this->databarangModel->submitbarangmasuk($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambah');
            return redirect()->to('/databarang');
        }
        // dd($this->validation);
        session()->setFlashdata('pesan', 'Data Belum Tersimpan');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function laporanbarangmasuk(): string
    {
        // You can now use the model in your methods
        $data['barang'] = $this->databarangModel->laporandatabarangmasuk();
        $data['title'] = "Laporan Barang Masuk";
        
        // Return a view or process the data as needed
        return view('So_barang/V_LBmasuk', $data);
    }

    public function deletebarangmasuk($id)
    { 
        $this->databarangModel->deletebarangmasuk($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/laporanbarangmasuk ');
    }
    public function caridatamasuk()
    { 
        if ($this->validate([
            'tgl_awal'  => 'required',
            'tgl_akhir' => 'required',

        ],[
            'tgl_awal'=>[
                'required' =>'Tanggal Awal Harus Disi'
            ],
            'tgl_akhir'=>[
                'required' =>'Tanggal Akhir Harus Disi'
            ],       
        ])) {
            $data = [
                'tgl_awal' => $this->request->getVar('tgl_awal'), // Corrected key for start date
                'tgl_akhir' => $this->request->getVar('tgl_akhir'), 
            ];
            $hasil['barang'] = $this->databarangModel->caridatamasuk($data);
            return view('So_barang/V_LBmasuk',$hasil); 
        }
        // else
        session()->setFlashdata('alert', 'Tanggal Awal dan Akhir Harus Sesuai');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function ubahbarangmasuk($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->dataubahbarangmasuk($kodebarang);
        
        return view('So_barang/Form_ub_masuk',$data );
    }
    public function submit_ubah_barang_masuk($id)
    { 
       
        if ($this->validate([
            'jumlahbarang' => 'required',
            'keterangan' => 'required',
        ],[
            'jumlahbarang'=>[
                'required'=> 'Jumlah Barang Harus Di isi'
            ],
            'keterangan'=>[
                'required'=> 'keterangan Barang Harus Di isi'
            ]
                     
        ])) { // Perbaiki di sini
            $data = [
                
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'keterangan' => $this->request->getVar('keterangan'),
                              
            ];
            $this->databarangModel->submitubahbarangmasuk($data,$id);
            $this->session->setFlashdata('pesan', 'Data Berhasil Terupdate'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/databarang',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }

    // barang keluar
    public function barang_keluar($kodebarang): string
    {
        
        $data['masuk'] = $this->databarangModel->ambildatabarangkeluar($kodebarang);
        $data['title'] = "Tambah Barang Keluar";
        
        // Gabungkan $data dan $validasi
        return view('So_barang/Form_barang_keluar', array_merge($data));
    }
    public function submit_barang_keluar($kodebarang){
        if ($this->validate([
            'jumlahbarang' => 'required',
            'tanggal'      => 'required',
            'keterangan'      => 'required',
        ],[
            'jumlahbarang'=>[
                'required' =>'jumlah barang harus diisi'
            ],
            'tanggal'=>[
                'required' =>'tanggal harus diisi'
            ],
            'keterangan'=>[
                'required' =>'keterangan harus diisi'
            ],
            

        ])) {
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'expired' => $this->request->getVar('expired'),
                'nama' => $this->request->getVar('nama'),
                'tanggal' => $this->request->getVar('tanggal'),
                'keterangan' => $this->request->getVar('keterangan'),
                'merek' => $this->request->getVar('merek'),
            ];
                $jumlahInput = intval($this->request->getVar('jumlahbarang'));
                // dd($jumlahInput); // Mengonversi input menjadi integer
                $stock = intval($this->databarangModel->lihatjumlah($kodebarang)); // Mengonversi hasil menjadi integer
                // dd($stock); 
                if ($jumlahInput > $stock) {
                    session()->setFlashdata('alert', 'Jumlah barang melebihi stok yang tersedia');
                    return redirect()->to('/databarang');
                } else {
                    
                    $this->databarangModel->submitbarangkeluar($data);
                    session()->setFlashdata('pesan', 'Data Berhasil Dikeluarkan ');
                    $email= \config\Services::email();
                    $data['itemcount'] = $this->databarangModel->itemcount();
                    $data['cekexpired'] = $this->databarangModel->cekexpired();
                    if (count($data['cekexpired']) > 0 || count($data['itemcount']) > 0) {
                        if(count($data['cekexpired']) > 0 && count($data['itemcount']) > 0){
                            $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan Habis & ED cek Dashboard');
                            //buat isi email 
                            $alamat_email=(['ilhamjullypratama3007@gmail.com','felicia.aniska@bintang7.com']);
                            $email->setTo($alamat_email);
                            $alamat_pengirim="ilhamjullypratama3007@gmail.com";
                            $email->setFrom($alamat_pengirim);
                            $subject="SO Barang Kalkual";
                            $email->setSubject($subject);
                            // Tabel untuk itemcount
                            $isi_pesan = "Berikut List Barang Kalkual yang akan Habis <br><br>";
                            $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                            $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
                            foreach ($data['itemcount'] as $item) { // Iterasi melalui itemcount
                                $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['satuan'] . '</td>'; // Satuan
                                $isi_pesan .= '</tr>'; // Menutup baris
                            }
                            $isi_pesan .= '</table><br>'; // Menutup tabel dan menambahkan jarak
            
                            // Tabel untuk cekexpired
                            $isi_pesan .= "Berikut List Barang Kalkual yang akan ED <br><br>";
                            $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                            $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Expired</th></tr>'; // Header tabel
                            foreach ($data['cekexpired'] as $item) { // Iterasi melalui cekexpired
                                $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['expired'] . '</td>'; // Expired
                                $isi_pesan .= '</tr>'; // Menutup baris
                            }
                            $isi_pesan .= '</table>'; // Menutup tabel
                            $email->setMessage($isi_pesan); 
                            $email->send();
                            return redirect()->to('/databarang ');
                        }elseif(count($data['itemcount']) > 0){
                            $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan Habis cek Dashboard');
            
                            $alamat_email="ilhamjullypratama3007@gmail.com";
                            $email->setTo($alamat_email);
                            $alamat_pengirim="ilhamjullypratama3007@gmail.com";
                            $email->setFrom($alamat_pengirim);
                            $subject="SO Barang Kalkual";
                            $email->setSubject($subject);
                            $isi_pesan = "Berikut List Barang Kalkual yang akan Habis <br><br>"; // Menambahkan jarak ke bawah
                            $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                            $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
                            foreach ($data['itemcount'] as $item) { // Iterasi melalui itemcount
                                $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                                $isi_pesan .= '<td style="padding: 10px;">' . $item['satuan'] . '</td>'; // Satuan
                                $isi_pesan .= '</tr>'; // Menutup baris
                            }
                            $isi_pesan .= '</table>'; // Menutup tabel
                            $email->setMessage($isi_pesan); 
                            $email->send();
                            return redirect()->to('/databarang ');
                        }
                        $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan ED cek Dashboard');
                        $alamat_email="ilhamjullypratama3007@gmail.com";
                        $email->setTo($alamat_email);
                        $alamat_pengirim="ilhamjullypratama3007@gmail.com";
                        $email->setFrom($alamat_pengirim);
                        $subject="SO Barang Kalkual";
                        $email->setSubject($subject);
                        $isi_pesan = "Berikut List Barang Kalkual yang akan ED <br><br>"; // Menambahkan jarak ke bawah
                        $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                        $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
                        foreach ($data['cekexpired'] as $item) { // Iterasi melalui itemcount
                            $isi_pesan .= '<tr>'; // Baris baru untuk setiap item
                            $isi_pesan .= '<td style="padding: 10px;">' . $item['kodebarang'] . '</td>'; // Kode Barang
                            $isi_pesan .= '<td style="padding: 10px;">' . $item['namabarang'] . '</td>'; // Nama Barang
                            $isi_pesan .= '<td style="padding: 10px;">' . $item['jumlah'] . '</td>'; // Jumlah
                            $isi_pesan .= '<td style="padding: 10px;">' . $item['expired'] . '</td>'; // Satuan
                            $isi_pesan .= '</tr>'; // Menutup baris
                        }
                        $isi_pesan .= '</table>'; // Menutup tabel
                        $email->setMessage($isi_pesan); 
                        $email->send();
                        return redirect()->to('/databarang ');
                    }



                    return redirect()->to('/databarang ');
                }}
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function laporanbarangkeluar(): string
    {
        
        // You can now use the model in your methods
        $data['barang'] = $this->databarangModel->laporandatabarangkeluar();
        $data['title'] = "Laporan Barang keluar";
        
        // Return a view or process the data as needed
        return view('So_barang/V_LBkeluar', $data);
    }
    public function deletebarangkeluar($id)
    { 
        $this->databarangModel->deletebarangkeluar($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/databarang ');
    }
    public function caridatakeluar()
    { 
        
        if ($this->validate([
            'tgl_awal'  => 'required',
            'tgl_akhir' => 'required',

        ],[
            'tgl_awal'=>[
                'required' =>'Tanggal Awal Harus Disi'
            ],
            'tgl_akhir'=>[
                'required' =>'Tanggal Akhir Harus Disi'
            ],       
        ])) {
            $data = [
                'tgl_awal' => $this->request->getVar('tgl_awal'), // Corrected key for start date
                'tgl_akhir' => $this->request->getVar('tgl_akhir'), 
            ];
            $hasil['barang'] = $this->databarangModel->caridatakeluar($data);
            return view('So_barang/V_LBkeluar',$hasil); 
        }
        // else
        session()->setFlashdata('alert', 'Tanggal Awal dan Akhir Harus Sesuai');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());// Pass results to the view     
    }
    public function ubahbarangkeluar($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->dataubahbarangkeluar($kodebarang);
        
        return view('So_barang/Form_ub_keluar',$data );
    }
    public function submit_ubah_barang_keluar($id)
    { 
       
        if ($this->validate([
            'jumlahbarang' => 'required',
             'keterangan' => 'required'
        ],[
            'jumlahbarang'=>[
                'required'=> 'Jumlah Barang Harus Di isi'
            ],
            'keterangan'=>[
                'required'=> 'Keteranagn Barang Harus Di isi'
            ]
                     
        ])) { 
            $data = [
                
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'keterangan' => $this->request->getVar('keterangan'),
                              
            ];
            $this->databarangModel->submitubahbarangkeluar($data,$id);
            $this->session->setFlashdata('pesan', 'Data Berhasil Terupdate'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/databarang',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }

  // ifitur lainya 
    public function cekbarangqa()
    { 
        $data['itemcount'] = $this->databarangModel->itemcount();
        $data['cekexpired'] = $this->databarangModel->cekexpired();
        // dd($data);
        return view('So_barang/V_cekQA',$data ); // Pass results to the view
    }
      public function dashboardqakalkual()
    { 
        $jumlahdata = $this->databarangModel->hitungbaranghabiskalkual();
        $jumlahdataed = $this->databarangModel->hitungbarangedkalkual();
        
        return view('So_barang/V_Dashboard', [
            'jumlahdata' => $jumlahdata,
            'jumlahdataed' => $jumlahdataed
        ]);
    }
    public function baranghabiskalkual()
    { 
        $data['itemcount'] = $this->databarangModel->itemcount();
        
        return view('So_barang/V_baranghabis',$data);
    }
    public function barangedkalkual()
    { 
        $data['cekexpired'] = $this->databarangModel->cekexpired();
        
        return view('So_barang/V_baranged',$data);
    }
    public function halamanerror()
    { 
        
        
        return view('Halaman_Error',);
    }
    public function homepage()
    { 
        
        
        return view('Homepage',);
    }
}





