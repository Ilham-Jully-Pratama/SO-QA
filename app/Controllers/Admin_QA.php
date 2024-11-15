<?php

namespace App\Controllers;

use App\Models\Data_Admin; // Add this line to import the model
use App\Controllers\BaseController;
class Admin_QA extends BaseController
{

    protected $databarangModel; // Add this property
    protected $session; // Deklarasi properti session
    protected $validation;
    public function __construct()
    {
        $this->databarangModel = new Data_Admin(); // Initialize the model
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation(); // Correct way to load validation service
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
                return view('Homepage');   
            }elseif(count($data['itemcount']) > 0){
                $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan Habis cek Dashboard');
                return view('Homepage');
            }
            $this->session->setFlashdata('notif', 'Ada barang QA Kalkual yang akan ED cek Dashboard');
            return view('Homepage'); 
        }
        $this->session->setFlashdata('pesanhompage', ' Tidak Ada barang yang akan ED dan Habis');
        return view('Homepage');
    }
    public function databarang(): string
    {
        
        // You can now use the model in your methods
        $data['barang'] = $this->databarangModel->ambildatabarang();
        $data['title'] = "Data Barang Admin ";
        $data['barang'] = $this->databarangModel->paginate(4);
        $data['pager'] = $this->databarangModel->pager;
        // Return a view or process the data as needed
        return view('Admin_QA/So_barang/V_databarang', $data,);
    }
    public function tambah_data_barangadminqa(): string
    {
        
        $data['barang'] = $this->databarangModel->caridaftarbarang();
        
        return view('Admin_QA/So_barang/Form_tambah_barang_baru',$data );

    }
    public function submitbarangbaruadmin()
    {
        // validasi input//
        if ($this->validate([
            'kodebarang' => 'required|is_unique[databarang.kodebarang]',
            'namabarang' => 'required',
            'satuan'     => 'required',
            'jumlahbarang'     => 'required',
            'tanggal'    => 'required',
            'tanggal_datang'=>'required',
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
            'tanggal'=>[
                'required'=> 'Tanggal Barang Harus Di isi'
            ],
               'tanggal_datang'=>[
                'required'=> 'Tanggal Barang Datang Barang Harus Di isi'
            ], 
            
        ])) { // Perbaiki di sini
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'nama' => $this->request->getVar('nama'),
                'tanggal' => $this->request->getVar('tanggal'),
                'tanggal_datang' => $this->request->getVar('tanggal_datang'),
                
            ];
            $this->databarangModel->submitbarangbaru($data);
            $this->session->setFlashdata('pesan', 'Data berhasil ditambahkan!'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/databarangadminqa',);           
        }
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function submitnamabarang_adminqa()
    { 
        if ($this->validate([
            'namabarang' => 'required',
        ],[
            'namabarang'=>[
                'required'=> 'Nama Harus Disi'
            ]
                     
        ])) { 
            $data = [
                
                'namabarang' => $this->request->getVar('namabarang'),
                              
            ];
            $this->databarangModel->submitnamabarang($data);
            $this->session->setFlashdata('pesan', 'Data Berhasil Ditambahkan'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/tambah_data_barangadminqa');      
        }
        session()->setFlashdata('alert', 'Data Belum Ditambahkan');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function daftarnamabarang_adminqa(): string
    { 
        return view('Admin_QA/So_barang/Form_nama_barang');
    }
    public function hapusnamabarang_adminqa(): string
    { 
        $data['barang'] = $this->databarangModel->caridaftarbarang();
        return view('Admin_QA/So_barang/V_list_nama_barang', $data);
    }
    public function deletedaftarnamabarang_adminqa($id)
    { 
        $this->databarangModel->deletedaftarnamabarang($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/tambah_data_barangadminqa');
    }
    public function ubahbarang($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->ambildatabarangubah($kodebarang);
        return view('Admin_QA/So_barang/Form_ubah_barang',$data );
    }
    public function submit_ubahbarang_adminqa($id)
    { 
       
        if ($this->validate([
            'kodebarang' => "required|is_unique[databarang.kodebarang.id, id, {$id}]",
            'namabarang' => 'required',
            'satuan'     => 'required',
            'jumlahbarang' => 'required',
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
                     
        ])) { // Perbaiki di sini
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'nama' => $this->request->getVar('nama'),
                
            ];
            $this->databarangModel->submitubahbarang($data,$id);
            $this->session->setFlashdata('pesan', 'Data Berhasil Terupdate'); // Pastikan ini adalah string, bukan array
            return redirect()->to('/databarangadminqa',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function delete($id)
    { 
        $this->databarangModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/databarangadminqa');
    }

    public function brg_masuk($kodebarang): string
    {
       
        $data['masuk'] = $this->databarangModel->ambildatabarangmasuk($kodebarang);
        $data['title'] = "Tambah Barang Masuk";
        
        // Gabungkan $data dan $validasi
        return view('Admin_QA/So_barang/Form_barang_masuk', array_merge($data,));
    }
    
    public function submit_barang_masuk(){

        // Correct way to set validation rules
        if ($this->validate([
            'jumlahbarang' => 'required',
            'tanggal'      => 'required',
            'keterangan'      => 'required',
        ],[
            'jumlahbarang'=>[
                'required' =>'jumlah barang harus Di isi'
            ],
            'tanggal'=>[
                'required' =>'tanggal harus Di isi'
            ],
            'keterangan'=>[
                'required' =>'Keterangan harus Di isi'
            ],
           
        ])) {
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'nama' => $this->request->getVar('nama'),
                'tanggal_masuk' => $this->request->getVar('tanggal'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];
            $this->databarangModel->submitbarangmasuk($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambah');
            return redirect()->to('/databarangadminqa');
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
        return view('Admin_QA/So_barang/V_LBmasuk', $data);
    }

    public function deletebarangmasuk($id)
    { 
        $this->databarangModel->deletebarangmasuk($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/laporan_brg_masuk ');
    }
    public function ubahbarangmasuk($kodebarang)
    { 
        
        $data['masuk'] = $this->databarangModel->dataubahbarangmasuk($kodebarang);
        
        return view('Admin_QA/So_barang/Form_ub_masuk',$data );
    }

    public function submit_ubah_brg_masuk($id)
    { 
        if ($this->validate([
            'jumlahbarang' => 'required',
            'tanggal' => 'required',
        ],[
            'jumlahbarang'=>[
                'required'=> 'Jumlah Barang Harus Di isi'
            ],
            'tanggal'=>[
                'required'=> 'Tanggal Masuk Barang Harus Di isi'
            ],         
        ])) { // Perbaiki di sini
            $data = [
                
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'tanggal_masuk' => $this->request->getVar('tanggal'),
                              
            ];
            $this->databarangModel->submitubahbarangmasuk($data,$id);
            $this->session->setFlashdata('pesan', 'Data Berhasil Terupdate');
            return redirect()->to('/databarangadminqa',);           
        }
        session()->setFlashdata('pesan', 'Data Belum Terupdate');
        // Ensure the validation object is passed correctly
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
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
            return view('Admin_QA/So_barang/V_LBmasuk',$hasil); 
        }
        // else
        session()->setFlashdata('alert', 'Tanggal Awal dan Akhir Harus Sesuai');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    public function brg_keluar($kodebarang): string
    {
        $data['masuk'] = $this->databarangModel->ambildatabarangkeluar($kodebarang);
        $data['title'] = "Tambah Barang Keluar";
        
        // Gabungkan $data dan $validasi
        return view('Admin_QA/So_barang/Form_barang_keluar', array_merge($data));
    }
    public function laporanbarangkeluar(): string
    {
        
        // You can now use the model in your methods
        $data['barang'] = $this->databarangModel->laporandatabarangkeluar();
        $data['title'] = "Laporan Barang keluar";
        
        // Return a view or process the data as needed
        return view('Admin_QA/So_barang/V_LBkeluar', $data);
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
                'required' =>'tanggal harus diisi'
            ],
            

        ])) {
            $data = [
                'kodebarang' => $this->request->getVar('kodebarang'),
                'namabarang' => $this->request->getVar('namabarang'),
                'satuan' => $this->request->getVar('satuan'),
                'jumlah' => $this->request->getVar('jumlahbarang'),
                'keterangan' => $this->request->getVar('keterangan'),
                'nama' => $this->request->getVar('nama'),
                'tanggal_keluar' => $this->request->getVar('tanggal'),
            ];
                $jumlahInput =(int) $this->request->getVar('jumlahbarang');
                // dd($jumlahInput); // Mengonversi input menjadi integer
                $stock =(int) $this->databarangModel->lihatjumlah($kodebarang); // Mengonversi hasil menjadi integer
                // dd($stock); 
                if ($jumlahInput > $stock) {
                    session()->setFlashdata('alert', 'Jumlah barang melebihi stok yang tersedia');
                    return redirect()->to('/databarangadminqa');
                } else {
                    $this->databarangModel->submitbarangkeluar($data);
                    session()->setFlashdata('pesan', 'Data Berhasil Dikeluarkan ');
                    $email= \config\Services::email();
                    $data['itemcount'] = $this->databarangModel->itemcount();
                    if (count($data['itemcount']) > 0) 
                        {
                            $this->session->setFlashdata('notif', 'Ada barang yang akan habis ');
                            //buat isi email 
                            $alamat_email=(['ilhamjullypratama3007@gmail.com']);
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
                            $email->setMessage($isi_pesan); 
                            $email->send();
                            return redirect()->to('/databarangadminqa ');
                        }
                    }
                    return redirect()->to('/databarangadminqa ');
                }
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
    
    public function deletebarangkeluar($id)
    { 
        $this->databarangModel->deletebarangkeluar($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/databarangadminqa ');
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
            return view('Admin_QA/So_barang/V_LBkeluar',$hasil); 
        }
        // else
        session()->setFlashdata('alert', 'Tanggal Awal dan Akhir Harus Sesuai');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());// Pass results to the view     
    }
    
    // public function cekbarangqa()
    // { 
    //     $data['itemcount'] = $this->databarangModel->itemcount();
    //     $data['cekexpired'] = $this->databarangModel->cekexpired();
    //     // dd($data);
    //     return view('So_barang/V_cekQA',$data ); // Pass results to the view
    // }
    
    

    
    

    // public function dashboardqakalkual()
    // { 
    //     $jumlahdata = $this->databarangModel->hitungbaranghabiskalkual();
    //     $jumlahdataed = $this->databarangModel->hitungbarangedkalkual();
        
    //     return view('So_barang/V_Dashboard', [
    //         'jumlahdata' => $jumlahdata,
    //         'jumlahdataed' => $jumlahdataed
    //     ]);
    // }
    // public function baranghabiskalkual()
    // { 
    //     $data['itemcount'] = $this->databarangModel->itemcount();
        
    //     return view('So_barang/V_baranghabis',$data);
    // }
    
    // public function barangedkalkual()
    // { 
    //     $data['cekexpired'] = $this->databarangModel->cekexpired();
        
    //     return view('So_barang/V_baranged',$data);
    // }
    // public function halamanerror()
    // { 
        
        
    //     return view('Halaman_Error',);
    // }
}





