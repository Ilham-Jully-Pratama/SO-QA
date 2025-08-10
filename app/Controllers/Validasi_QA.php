<?php

namespace App\Controllers;

use App\Models\M_databarang_validasi; // Add this line to import the model
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
class Validasi_QA extends BaseController
{

    protected $databarangModel;
    protected $dompdf;  // Add this property
    protected $session; // Deklarasi properti session
    protected $validation;
    public function __construct()
    {
        $this->databarangModel = new M_databarang_validasi();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        // Correct way to load validation service
    }

    public function index(): string
    {
    
        return view('Homepage');
    }
    public function databarang(): string
    {
        $katakunci = $this->request->getGet('katakunci');
        if ($katakunci) {
            $cari = $this->databarangModel->cari($katakunci); // Eksekusi query pencarian
        } else {
            $cari = $this->databarangModel->ambildatabarang(5); // Ambil semua data dengan pagination
        }
        $terakhir_so=$this->databarangModel->tanggal_terakhir_so();
        $data = [
            'katakunci'       => $katakunci,
            'title'           => "Data Barang Validasi",
            'barang'          => $cari,
            'pager'           => $this->databarangModel->pager,
            'terakhir_so' => $terakhir_so, // Tambahkan tanggal terakhir stock opname
        ];
        // Return view dengan data yang benar
        return view('QA_Validasi/V_databarang_validasi', $data);
    }
    public function cetakdatabarang()
    {
        $data['barang'] = $this->databarangModel->cetakdatabarang();
        $dompdf = new Dompdf();
        $html= view('QA_Validasi/V_Cetak_databarang_validasi', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Data Barang Validasi.pdf", ["Attachment" => 0]);
        exit();
    }
    public function tambah_data_barang(): string
    {
        
        $data['barang'] = $this->databarangModel->caridaftarbarang();
        
        return view('QA_Validasi/Form_tambah_barang_baru_validasi',$data );

    }
    public function submitbarangbaru()
    {
        // validasi input//
        if ($this->validate([
            'kodebarang' => 'required|is_unique[databarang_validasi.kodebarang]',
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
            return redirect()->to('/databarang_validasi',);           
        }
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function ubahbarang($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->ambildatabarangubah($kodebarang);
        return view('QA_Validasi/Form_ubah_barang_validasi',$data );
    }
    public function submit_ubah_barang($id)
    { 
       
        if ($this->validate([
            'kodebarang' => "required|is_unique[databarang_validasi.kodebarang.id, id, {$id}]",
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
            return redirect()->to('/databarang_validasi',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function delete($id)
    { 
        $this->databarangModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/databarang_validasi ');
    }
    public function submitnamabarang()
    { 
        if ($this->validate([
            'namabarang' => 'required',
            'minimum' => 'required',
        ],[
            'namabarang'=>[
                'required'=> 'Nama Harus Disi'
            ],
            'minimum'=>[
                'required'=> 'Batas Minimum Harus Diisi'
            ],
                     
        ])) { // Perbaiki di sini
            $data = [
                
                'namabarang' => $this->request->getVar('namabarang'),
                'minimum' => $this->request->getVar('minimum'),
                              
            ];
            $this->databarangModel->submitnamabarang($data);
            $this->session->setFlashdata('pesan', 'Data Berhasil Ditambahkan'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/tambah_data_barang_validasi');      
        }
        session()->setFlashdata('alert', 'Data Belum Ditambahkan');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function daftarnamabarang(): string
    { 
        return view('QA_Validasi/Form_nama_barang_validasi', );

    }
    public function hapusnamabarang(): string
    { 
        $data['barang'] = $this->databarangModel->caridaftarbarang();
        return view('QA_Validasi/V_list_nama_barang_Validasi', $data);
    }
    public function deletedaftarnamabarang($id)
    { 
        $this->databarangModel->deletedaftarnamabarang($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/tambah_data_barang_validasi');
    }

// barang masuk
    public function barang_masuk($kodebarang): string
    {
       
        $data['masuk'] = $this->databarangModel->ambildatabarangmasuk($kodebarang);
        $data['title'] = "Tambah Barang Masuk Validasi";
        
        // Gabungkan $data dan $validasi
        return view('QA_Validasi/Form_barang_masuk_validasi', array_merge($data,));
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
            return redirect()->to('/databarang_validasi');
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
        return view('QA_Validasi/V_LBmasuk_validasi', $data);
    }

    public function deletebarangmasuk($id)
    { 
        $this->databarangModel->deletebarangmasuk($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/laporanbarangmasuk_validasi ');
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
            return view('QA_Validasi/V_LBmasuk_validasi',$hasil); 
        }
        // else
        session()->setFlashdata('alert', 'Tanggal Awal dan Akhir Harus Sesuai');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function ubahbarangmasuk($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->dataubahbarangmasuk($kodebarang);
        
        return view('QA_Validasi/Form_ub_masuk_validasi',$data );
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
            return redirect()->to('/databarang_validasi',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }

    // barang keluar
    public function barang_keluar($kodebarang): string
    {
        
        $data['masuk'] = $this->databarangModel->ambildatabarangkeluar($kodebarang);
        $data['title'] = "Tambah Barang Keluar Validasi";
        
        // Gabungkan $data dan $validasi
        return view('QA_Validasi/Form_barang_keluar_validasi', array_merge($data));
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
            

        ])) 
        {
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
                $stockData = $this->databarangModel->lihatjumlah($kodebarang);
                $stock = intval($stockData['jumlah'] ?? 0);
                // Mengonversi hasil menjadi integer
                // dd($stock); 
                if ($jumlahInput > $stock) {
                    session()->setFlashdata('alert', 'Jumlah barang melebihi stok yang tersedia');
                    return redirect()->to('/databarang_validasi');
                } else {
                    
                    $this->databarangModel->submitbarangkeluar($data);
                    session()->setFlashdata('pesan', 'Data Berhasil Dikeluarkan ');
                    $email= \config\Services::email();
                    $data['itemcount'] = $this->databarangModel->itemcountbycode($kodebarang);
                    if (count($data['itemcount']) > 0) {
                        $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan ED cek Dashboard');
                        $alamat_email="ilhamjullypratama3007@gmail.com";
                        $email->setTo($alamat_email);
                        $alamat_pengirim="ilhamjullypratama3007@gmail.com";
                        $email->setFrom($alamat_pengirim);
                        $subject="SO Barang Validasi";
                        $email->setSubject($subject);
                        $isi_pesan = "Berikut List Barang Kalkual yang akan ED <br><br>"; // Menambahkan jarak ke bawah
                        $isi_pesan .= '<table border="1" style="border-collapse: collapse;">'; // Membuat tabel dengan border
                        $isi_pesan .= '<tr><th style="padding: 10px;">Kode Barang</th><th style="padding: 10px;">Nama Barang</th><th style="padding: 10px;">Jumlah</th><th style="padding: 10px;">Satuan</th></tr>'; // Header tabel
                        foreach ($data['itemcount'] as $item) {
                                     $isi_pesan .= '<tr>
                                    <td style="padding: 10px;">' . $item['kodebarang'] . '</td>
                                    <td style="padding: 10px;">' . $item['namabarang'] . '</td>
                                    <td style="padding: 10px;">' . $item['jumlah'] . '</td>
                                    <td style="padding: 10px;">' . $item['satuan'] . '</td>
                                   </tr>';}
                        $isi_pesan .= '</table>'; // Menutup tabel
                        $email->setMessage($isi_pesan); 
                        $email->send();
                        return redirect()->to('/databarang_validasi ');
                    }
                    return redirect()->to('/databarang_validasi ');
                }}
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function laporanbarangkeluar_validasi(): string
    {
        
        // You can now use the model in your methods
        $data['barang'] = $this->databarangModel->laporandatabarangkeluar();
        $data['title'] = "Laporan Barang keluar";
        
        // Return a view or process the data as needed
        return view('QA_Validasi/V_LBkeluar_validasi', $data);
    }
    public function deletebarangkeluar($id)
    { 
        $this->databarangModel->deletebarangkeluar($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/databarang_validasi');
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
        
        return view('QA_Validasi/Form_ub_keluar_validasi',$data );
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
            return redirect()->to('/databarang_validasi',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }

  // ifitur lainya 
      public function dashboardqakalkual()
    { 
        $jumlahdata = $this->databarangModel->hitungbaranghabiskalkual();
        $jumlahdataed = $this->databarangModel->hitungbarangedkalkual();
        
        return view('QA_Validasi/V_Dashboard_validasi', [
            'jumlahdata' => $jumlahdata,
            'jumlahdataed' => $jumlahdataed
        ]);
    }
    public function baranghabiskalkual()
    { 
        $data['itemcount'] = $this->databarangModel->itemcount();
        
        return view('QA_Validasi/V_baranghabis',$data);
    }
    public function barangedkalkual()
    { 
        $data['cekexpired'] = $this->databarangModel->cekexpired();
        
        return view('QA_Validasi/V_baranged',$data);
    }
    public function halamanerror()
    { 
        
        
        return view('Halaman_Error',);
    }
    public function homepage()
    { 
        
        
        return view('Homepage',);
    }
    public function update_so()
    { 
        $data['so'] = $this->databarangModel->riwayat_so();
        return view('QA_Validasi/V_UpdateSO',$data);
    }
    public function submit_update_so(){

        // Correct way to set validation rules
        if ($this->validate([
            'tanggal_so' => 'required',
            'keterangan'   => 'required',
        ],[
            'tanggal_so'=>[
                'required' =>'jumlah barang harus diisi'
            ],
            'keterangan'=>[
                'required' =>'keterangan harus diisi'
            ],
            

        ])) {
            $data = [
                'tanggal_so' => $this->request->getVar('tanggal_so'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];
            $this->databarangModel->submitdata_update_so($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambah');
            return redirect()->to('/update_so_validasi');
        }
        // dd($this->validation);
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }


}
