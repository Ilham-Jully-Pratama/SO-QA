<?php

namespace App\Controllers;

use App\Models\Data_Admin; // Add this line to import the model
use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
class Admin_QA extends BaseController
{

    protected $databarangModel;
    protected $dompdf;  // Add this property
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
            'title'           => "Data Barang Admin",
            'barang'          => $cari,
            'pager'           => $this->databarangModel->pager,
            'terakhir_so' => $terakhir_so, // Tambahkan tanggal terakhir stock opname
        ];
        return view('Admin_QA/So_barang/V_databarang', $data);
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
            'minimum' => 'required',
        ],[
            'namabarang'=>[
                'required'=> 'Nama Harus Disi'
            ],
            'minimum'=>[
                'required'=> 'Jumlah Minimum Harus Disi'
            ],
                     
        ])) { 
            $data = [
                
                'namabarang' => $this->request->getVar('namabarang'),
                'minimum' => $this->request->getVar('minimum'),
                              
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
     
    public function dashboardqakalkual()
    { 
        $jumlahdata = $this->databarangModel->hitungbaranghabiskalkual();
        
        return view('Admin_QA/So_barang/V_Dashboard', [
            'jumlahdata' => $jumlahdata,
           
        ]);
    }
    public function baranghabiskalkual()
    { 
        $data['itemcount'] = $this->databarangModel->itemcount();
        
        return view('Admin_QA/So_barang/V_baranghabis',$data);
    }
    
    public function cetakdatabarang()
    {
        $data['barang'] = $this->databarangModel->cetakdatabarang();
        $dompdf = new Dompdf();
        $html= view('Admin_QA/So_barang/V_Cetak_databarang', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Data Barang Kalkual.pdf", ["Attachment" => 0]);
        exit();
    }

    public function update_so()
    { 
        $data['so'] = $this->databarangModel->riwayat_so();
        return view('Admin_QA/So_barang/V_UpdateSO',$data);
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
            return redirect()->to('/update_so_adminqa');
        }
        // dd($this->validation);
        session()->setFlashdata('alert', 'Data Belum Tersimpan');
        return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
    }
}





