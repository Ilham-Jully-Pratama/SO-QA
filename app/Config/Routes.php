<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/databarang', 'Home::databarang');
$routes->get('/ubahbarang(:any)', 'Home::ubahbarang/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/submit_ubah_barang(:any)', 'Home::submit_ubah_barang/$1',['filter'=>'role:admin_kalkual']);
//tambah barang baru
$routes->get('/tambah_data_barang', 'Home::tambah_data_barang',['filter'=>'role:admin_kalkual']);
$routes->get('/submitbarangbaru', 'Home::submitbarangbaru',['filter'=>'role:admin_kalkual']);
$routes->delete('/delete_barang(:num)','Home::delete/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/daftarnamabarang', 'Home::daftarnamabarang',['filter'=>'role:admin_kalkual']);
$routes->post('/submitnamabarang', 'Home::submitnamabarang',['filter'=>'role:admin_kalkual']);

$routes->get('/hapusnamabarang', 'Home::hapusnamabarang',['filter'=>'role:admin_kalkual']);
$routes->delete('/deletedaftarnamabarang(:num)','Home::deletedaftarnamabarang/$1',['filter'=>'role:admin_kalkual']);
// barang masuk
$routes->get('/barang_masuk(:any)','Home::barang_masuk/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/submit_barang_masuk', 'Home::submit_barang_masuk',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/laporanbarangmasuk', 'Home::laporanbarangmasuk',['filter'=>'role:supervisor,admin_kalkual']);
$routes->delete('/deletebarangmasuk(:num)','Home::deletebarangmasuk/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/ubah_barang_masuk(:any)', 'Home::ubahbarangmasuk/$1',['filter'=>'role:admin_kalkual']);
$routes->post('/submit_ubah_barang_masuk(:any)', 'Home::submit_ubah_barang_masuk/$1',['filter'=>'role:admin_kalkual']);
$routes->post('/caridatamasuk', 'Home::caridatamasuk',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/caridatamasuk', 'Home::laporanbarangmasuk',['filter'=>'role:supervisor,admin_kalkual']);
// barang keluar
$routes->get('/barang_keluar(:any)','Home::barang_keluar/$1',['filter'=>'role:supervisor,admin_kalkual,user,admin_qa']);
$routes->get('/submit_barang_keluar(:any)', 'Home::submit_barang_keluar/$1',['filter'=>'role:supervisor,admin_kalkual,user,admin_qa']);
$routes->get('/laporanbarangkeluar', 'Home::laporanbarangkeluar',['filter'=>'role:supervisor,admin_kalkual,user,admin_qa']);
$routes->delete('/deletebarangkeluar(:num)','Home::deletebarangkeluar/$1',['filter'=>'role:admin_kalkual']);
$routes->post('/caridatakeluar','Home::caridatakeluar',['filter'=>'role:supervisor,admin_kalkual,user,admin_qa']);
$routes->get('/caridatakeluar','Home::laporanbarangkeluar',['filter'=>'role:supervisor,admin_kalkual,user,admin_qa']);
$routes->get('/ubah_barang_keluar(:any)', 'Home::ubahbarangkeluar/$1',['filter'=>'role:admin_kalkual']);
$routes->post('/submit_ubah_barang_keluar(:any)', 'Home::submit_ubah_barang_keluar/$1',['filter'=>'role:admin_kalkual']);
//user
$routes->get('/daftaruser', 'Kelola_user::daftaruser');
$routes->get('/updateuser(:any)', 'Kelola_user::updateuser/$1',['filter'=>'role:supervisor']);
$routes->delete('/deleteuser(:num)','Kelola_user::deleteuser/$1',['filter'=>'role:supervisor']);
$routes->post('/simpan_update_user(:num)','Kelola_user::simpan_update_user/$1');
$routes->post('/simpan_tambah_user','Kelola_user::simpan_tambah_user',['filter'=>'role:supervisor']);
// lainya 

$routes->get('/cekbarangqa', 'Home::cekbarangqa',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/dashboardqakalkual', 'Home::dashboardqakalkual',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/baranghabiskalkual', 'Home::baranghabiskalkual',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/barangedkalkual', 'Home::barangedkalkual',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/halamanerror', 'Home::halamanerror',);

// admin QA ------------------------------------------------------- admin QA-------------------------------------------------
$routes->get('/databarangadminqa', 'Admin_QA::databarang',);
$routes->get('/tambah_data_barangadminqa', 'Admin_QA::tambah_data_barangadminqa',['filter'=>'role:admin_qa']);
$routes->get('/daftarnamabarang_adminqa', 'Admin_QA::daftarnamabarang_adminqa',['filter'=>'role:admin_qa']);
$routes->post('/submitnamabarang_adminqa', 'Admin_QA::submitnamabarang_adminqa',['filter'=>'role:admin_qa']);
$routes->get('/hapusnamabarang_adminqa', 'Admin_QA::hapusnamabarang_adminqa',['filter'=>'role:admin_qa']);
$routes->delete('/deletedaftarnamabarang_adminqa(:num)','Admin_QA::deletedaftarnamabarang_adminqa/$1',['filter'=>'role:admin_qa']);
//submit barang baru
$routes->get('/submitbarangbaruadmin', 'Admin_QA::submitbarangbaruadmin',['filter'=>'role:admin_qa']);
$routes->get('/ubah_barang_admin(:any)', 'Admin_QA::ubahbarang/$1',['filter'=>'role:admin_qa']);
$routes->post('/submit_ubahbarang_adminqa(:any)', 'Admin_QA::submit_ubahbarang_adminqa/$1',['filter'=>'role:admin_qa']);
$routes->delete('/hapus_barang(:any)', 'Admin_QA::delete/$1',['filter'=>'role:admin_qa']);
//barang masuk
$routes->get('/brg_masuk(:any)', 'Admin_QA::brg_masuk/$1',['filter'=>'role:admin_qa']);
$routes->post('/submit_brg_masuk', 'Admin_QA::submit_barang_masuk/$1',['filter'=>'role:admin_qa']);
$routes->get('/laporan_brg_masuk', 'Admin_QA::laporanbarangmasuk',['filter'=>'role:supervisor,admin_qa']);
$routes->delete('/delete_brg_masuk(:any)', 'Admin_QA::deletebarangmasuk/$1',['filter'=>'role:admin_qa']);
$routes->get('/ubah_brg_masuk(:any)', 'Admin_QA::ubahbarangmasuk/$1',['filter'=>'role:admin_qa']);
$routes->post('/submit_ubah_brg_masuk(:any)', 'Admin_QA::submit_ubah_brg_masuk/$1',['filter'=>'role:admin_qa']);
$routes->post('/cari_brg_masuk', 'Admin_QA::caridatamasuk',['filter'=>'role:supervisor,admin_qa']);
$routes->get('/cari_brg_masuk', 'Admin_QA::laporanbarangmasuk',['filter'=>'role:supervisor,admin_qa']);
//barang keluar
$routes->get('/brg_keluar(:any)', 'Admin_QA::brg_keluar/$1',['filter'=>'role:admin_qa,supervisor,user']);
$routes->get('/laporan_brg_keluar', 'Admin_QA::laporanbarangkeluar',['filter'=>'role:supervisor,admin_qa,user']);
$routes->post('/submit_brg_keluar(:any)', 'Admin_QA::submit_barang_keluar/$1',['filter'=>'role:admin_qa,user']);
$routes->delete('/delete_brg_keluar(:any)', 'Admin_QA::deletebarangkeluar/$1',['filter'=>'role:admin_qa']);
$routes->post('/cari_brg_keluar', 'Admin_QA::caridatakeluar',['filter'=>'role:supervisor,admin_qa,user']);
$routes->get('/cari_brg_keluar', 'Admin_QA::laporanbarangkeluar',['filter'=>'role:supervisor,admin_qa,user']);