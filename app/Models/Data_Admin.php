<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_Admin extends Model
{
    protected $table      = 'databarang_admin'; // Replace with your actual table name
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username',  'password']; // Add or remove fields as needed

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation rules
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Add custom methods here as needed
    public function ambildatabarang()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function caridaftarbarang()
    {
        $builder = $this->db->table('daftarbarang_adminqa');
        $query = $builder->get();
        return $query->getResultArray();
       
    }
    public function submitbarangbaru($data)
    {
        $builder = $this->db->table('databarang_admin');
        $builder->insert($data);
       
    }
    public function submitnamabarang($data)
    {
        $builder = $this->db->table('daftarbarang_adminqa');
        $builder->insert($data);
       
    }
    public function deletedaftarnamabarang($id)
    {
        $builder = $this->db->table('daftarbarang_adminqa');
        $builder->where('id', $id); //
        $query = $builder->delete();
        return $query ? true : false; // Indicate success or failure
    }
    public function ambildatabarangubah($kodebarang)
    {
        $builder = $this->db->table('databarang_admin');
        $builder->where('kodebarang', $kodebarang); //
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function submitubahbarang($data,$id)
    {
        $builder = $this->db->table('databarang_admin');
        $builder->where('id', $id);
        $builder->update($data);
    }
    public function ambildatabarangmasuk($kodebarang)
    {
        
        $builder = $this->db->table($this->table);
        $builder->where('kodebarang', $kodebarang); //
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function submitbarangmasuk($data)
    {
        $builder = $this->db->table('barangmasuk_adminqa');
        $builder->insert($data);
       
    }
    public function laporandatabarangmasuk()
    {
        $builder = $this->db->table('barangmasuk_adminqa');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function deletebarangmasuk($id)
    {
        $builder = $this->db->table('barangmasuk_adminqa');
        $builder->where('id', $id); //
        $query = $builder->delete();

        // Return a response indicating success
        return $query ? true : false; // Indicate success or failure
    }
    public function dataubahbarangmasuk($kodebarang)
    {
        $builder = $this->db->table('barangmasuk_adminqa');
        $builder->where('kodebarang', $kodebarang); //
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function submitubahbarangmasuk($data,$id)
    {
        $builder = $this->db->table('barangmasuk_adminqa');
        $builder->where('id', $id);
        $builder->update($data);
       
    }

    public function caridatamasuk($data)
    {
        // Mengasumsikan Anda sudah memiliki koneksi database yang disiapkan
        $builder = $this->db->table('barangmasuk_adminqa'); // Nama tabel yang sesuai
        $builder->where('tanggal_masuk BETWEEN ' . $this->db->escape($data['tgl_awal']) . ' AND ' . $this->db->escape($data['tgl_akhir'])); // Filter tanggal
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function ambildatabarangkeluar($kodebarang)
    {
        
        $builder = $this->db->table($this->table);
        $builder->where('kodebarang', $kodebarang); //
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function submitbarangkeluar($data)
    {
        $builder = $this->db->table('barangkeluar_adminqa');
        $builder->insert($data);
       
    }
    
    public function laporandatabarangkeluar()
    {
        $builder = $this->db->table('barangkeluar_adminqa');
        $query = $builder->get();
        return $query->getResultArray();
    }
   
    public function deletebarangkeluar($id)
    {
        $builder = $this->db->table('barangkeluar_adminqa');
        $builder->where('id', $id); //
        $query = $builder->delete();

        // Return a response indicating success
        return $query ? true : false; // Indicate success or failure
    }
    public function caridatakeluar($data)
    {
        // Mengasumsikan Anda sudah memiliki koneksi database yang disiapkan
        $builder = $this->db->table('barangkeluar_adminqa'); // Nama tabel yang sesuai
        $builder->where('tanggal_keluar BETWEEN ' . $this->db->escape($data['tgl_awal']) . ' AND ' . $this->db->escape($data['tgl_akhir'])); // Filter tanggal
        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan hasil sebagai array
    }
    
    public function itemcount()
    {
        $builder = $this->db->table('databarang_admin');
        return $builder->groupStart() // Memulai grup kondisi
                        ->where('jumlah <=', 10)->where('satuan', 'pcs') // Kondisi 1: jumlah <= 0
                        ->orWhere('jumlah <=', 20)->where('satuan', 'ampul') // Kondisi 2: jumlah <= 20
                        ->orWhere('jumlah <=', 200)->where('satuan', 'ml') // Kondisi 3: jumlah <= 200
                        ->orWhere('jumlah <=', 10)->where('satuan', 'vial') // Kondisi 4: jumlah <= 10
                        ->groupEnd() // Mengakhiri grup kondisi
                        ->get()->getResultArray(); // Menghitung jumlah row yang memenuhi kondisi
    }
    // public function cekexpired()
    // {
    //     $builder = $this->db->table('databarang_admin');
    //     // Ambil data barang yang expired atau akan expired dalam 4 bulan
    //     return $builder->where('expired <=', date('Y-m-d'))
    //                     ->orWhere('expired <=', date('Y-m-d', strtotime('+4 months')))
    //                     ->get()->getResultArray(); // Mengembalikan data barang yang expired
    // }
    public function lihatjumlah($kodebarang)
    {
        $builder = $this->db->table('databarang_admin');
        $builder->select('jumlah'); // Ambil hanya kolom jumlah
        $builder->where('kodebarang', $kodebarang); // Filter berdasarkan kodebarang
        $query = $builder->get();
       
        $result = $query->getRowArray();
        return $result['jumlah'];
    }

    // public function hitungbaranghabiskalkual()
    // {
    //     $builder = $this->db->table('databarang');
    //     return $builder->groupStart() // Memulai grup kondisi
    //                     ->where('jumlah <=', 10)->where('satuan', 'pcs') // Kondisi 1: jumlah <= 0
    //                     ->orWhere('jumlah <=', 20)->where('satuan', 'ampul') // Kondisi 2: jumlah <= 20
    //                     ->orWhere('jumlah <=', 200)->where('satuan', 'ml') // Kondisi 3: jumlah <= 200
    //                     ->orWhere('jumlah <=', 10)->where('satuan', 'vial') // Kondisi 4: jumlah <= 10
    //                     ->groupEnd() // Mengakhiri grup kondisi
    //                     ->countAllResults(); // Menghitung jumlah row yang memenuhi kondisi
    // }
    // public function hitungbarangedkalkual()
    // {
    //     $builder = $this->db->table('databarang');
    //     // Ambil data barang yang expired atau akan expired dalam 4 bulan
    //     return $builder->where('expired <=', date('Y-m-d'))
    //                     ->orWhere('expired <=', date('Y-m-d', strtotime('+4 months')))
    //                     ->countAllResults(); // Mengembalikan data barang yang expired
    // }
}

