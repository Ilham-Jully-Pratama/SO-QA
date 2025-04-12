<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/databarang', 'Home::databarang');
$routes->get('ubahbarang/(:any)', 'Home::ubahbarang/$1',['filter'=>'role:admin_kalkual,']);
$routes->get('/submit_ubah_barang(:any)', 'Home::submit_ubah_barang/$1',['filter'=>'role:admin_kalkual']);
//tambah barang baru
$routes->get('/tambah_data_barang', 'Home::tambah_data_barang',['filter'=>'role:admin_kalkual']);
$routes->get('/submitbarangbaru', 'Home::submitbarangbaru',['filter'=>'role:admin_kalkual']);
$routes->delete('delete_barang/(:num)','Home::delete/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/daftarnamabarang', 'Home::daftarnamabarang',['filter'=>'role:admin_kalkual']);
$routes->post('/submitnamabarang', 'Home::submitnamabarang',['filter'=>'role:admin_kalkual']);
$routes->get('/hapusnamabarang', 'Home::hapusnamabarang',['filter'=>'role:admin_kalkual']);
$routes->delete('/deletedaftarnamabarang(:num)','Home::deletedaftarnamabarang/$1',['filter'=>'role:admin_kalkual']);
// barang masuk
$routes->get('barang_masuk/(:any)','Home::barang_masuk/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/submit_barang_masuk', 'Home::submit_barang_masuk',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/laporanbarangmasuk', 'Home::laporanbarangmasuk',['filter'=>'role:supervisor,admin_kalkual']);
$routes->delete('/deletebarangmasuk(:num)','Home::deletebarangmasuk/$1',['filter'=>'role:admin_kalkual']);
$routes->get('/ubah_barang_masuk(:any)', 'Home::ubahbarangmasuk/$1',['filter'=>'role:admin_kalkual']);
$routes->post('submit_ubah_barang_masuk/(:any)', 'Home::submit_ubah_barang_masuk/$1',['filter'=>'role:admin_kalkual']);
$routes->post('/caridatamasuk', 'Home::caridatamasuk',['filter'=>'role:supervisor,admin_kalkual']);
$routes->get('/caridatamasuk', 'Home::laporanbarangmasuk',['filter'=>'role:supervisor,admin_kalkual']);
// barang keluar
$routes->get('/barang_keluar/(:any)','Home::barang_keluar/$1');
$routes->get('/submit_barang_keluar(:any)', 'Home::submit_barang_keluar/$1');
$routes->get('/laporanbarangkeluar', 'Home::laporanbarangkeluar');
$routes->delete('/deletebarangkeluar(:num)','Home::deletebarangkeluar/$1',['filter'=>'role:admin_kalkual']);
$routes->post('/caridatakeluar','Home::caridatakeluar');
$routes->get('/caridatakeluar','Home::laporanbarangkeluar');
$routes->get('ubah_barang_keluar/(:any)', 'Home::ubahbarangkeluar/$1',['filter'=>'role:admin_kalkual']);
$routes->post('submit_ubah_barang_keluar/(:any)', 'Home::submit_ubah_barang_keluar/$1',['filter'=>'role:admin_kalkual']);
//user
$routes->get('/daftaruser', 'Kelola_user::daftaruser');
$routes->get('/updateuser(:any)', 'Kelola_user::updateuser/$1',['filter'=>'role:supervisor']);
$routes->delete('/deleteuser(:num)','Kelola_user::deleteuser/$1',['filter'=>'role:supervisor']);
$routes->post('/simpan_update_user(:num)','Kelola_user::simpan_update_user/$1');
$routes->post('/simpan_tambah_user','Kelola_user::simpan_tambah_user',['filter'=>'role:supervisor']);
// lainya 

$routes->get('/dashboardqakalkual', 'Home::dashboardqakalkual');
$routes->get('/baranghabiskalkual', 'Home::baranghabiskalkual');
$routes->get('/barangedkalkual', 'Home::barangedkalkual');
$routes->get('/halamanerror', 'Home::halamanerror',);
$routes->get('/Homepage', 'Home::homepage',);
$routes->get('/printdatabarang', 'Home::cetakdatabarang',);
$routes->get('/update_sokalkual', 'Home::update_so',[ 'filter'=>'role:admin_kalkual']);
$routes->get('/submit_update_so', 'Home::submit_update_so',[ 'filter'=>'role:admin_kalkual']);


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
$routes->get('/brg_keluar(:any)', 'Admin_QA::brg_keluar/$1');
$routes->get('/laporan_brg_keluar', 'Admin_QA::laporanbarangkeluar');
$routes->post('/submit_brg_keluar(:any)', 'Admin_QA::submit_barang_keluar/$1');
$routes->delete('/delete_brg_keluar(:any)', 'Admin_QA::deletebarangkeluar/$1',['filter'=>'role:admin_qa']);
$routes->post('/cari_brg_keluar', 'Admin_QA::caridatakeluar');
$routes->get('/cari_brg_keluar', 'Admin_QA::laporanbarangkeluar');

//lainya 
$routes->get('/dashboardadminqa', 'Admin_QA::dashboardqakalkual');
$routes->get('/baranghabisadminqa', 'Admin_QA::baranghabiskalkual');
$routes->get('/printdatabarang_admin', 'Admin_QA::cetakdatabarang',);
$routes->get('/update_so_adminqa', 'Admin_QA::update_so',[ 'filter'=>'role:admin_qa']);
$routes->get('/submit_update_so_adminqa', 'Admin_QA::submit_update_so',[ 'filter'=>'role:admin_qa']);


// QA Validasi.............................................................QA VALIDASI .................................................//
$routes->get('/databarang_validasi', 'Validasi_QA::databarang',);
$routes->get('/printdatabarang_validasi', 'Validasi_QA::cetakdatabarang',);

//tambah barang baru
$routes->get('/tambah_data_barang_validasi', 'Validasi_QA::tambah_data_barang',['filter'=>'role:admin_validasi']);
$routes->get('/daftarnamabarang_validasi', 'Validasi_QA::daftarnamabarang',['filter'=>'role:admin_validasi']);
$routes->get('/hapusnamabarang_validasi', 'Validasi_QA::hapusnamabarang',['filter'=>'role:admin_validasi']);
$routes->post('/submitnamabarang_validasi', 'Validasi_QA::submitnamabarang',['filter'=>'role:admin_validasi']);
$routes->delete('/deletedaftarnamabarang_validasi(:num)','Validasi_QA::deletedaftarnamabarang/$1',['filter'=>'role:admin_validasi']);
$routes->get('/submitbarangbaru_validasi', 'Validasi_QA::submitbarangbaru',['filter'=>'role:admin_validasi']);
//pengelolaan data barang
//ubah data barang
$routes->delete('delete_barang_validasi/(:num)','Validasi_QA::delete/$1',['filter'=>'role:admin_validasi']);
$routes->get('ubahbarang_validasi/(:any)', 'Validasi_QA::ubahbarang/$1',['filter'=>'role:admin_validasi,']);
$routes->post('submit_ubah_barang_validasi/(:any)', 'Validasi_QA::submit_ubah_barang/$1',['filter'=>'role:admin_validasi']);
//barang masuk
$routes->get('barang_masuk_validasi/(:any)','Validasi_QA::barang_masuk/$1',['filter'=>'role:admin_validasi']);
$routes->post('/submit_barang_masuk_validasi', 'Validasi_QA::submit_barang_masuk/$1',['filter'=>'role:admin_validasi']);
//barang keluar
$routes->get('barang_keluar_validasi/(:any)','Validasi_QA::barang_keluar/$1',['filter'=>'role:supervisor,admin_kalkual,user,admin_validasi']);
$routes->post('submit_barang_keluar_validasi/(:any)', 'Validasi_QA::submit_barang_keluar/$1',['filter'=>'role:admin_validasi']);
//pengelolaan laporan barang masuk
$routes->get('/laporanbarangmasuk_validasi', 'Validasi_QA::laporanbarangmasuk',['filter'=>'role:supervisor,admin_validasi']);
$routes->post('/caridatamasuk_validasi', 'Validasi_QA::caridatamasuk',['filter'=>'role:supervisor,admin_validasi']);
$routes->get('/caridatamasuk_validasi', 'Validasi_QA::laporanbarangmasuk',['filter'=>'role:supervisor,admin_validasi']);
$routes->delete('deletebarangmasuk_validasi/(:any)', 'Validasi_QA::deletebarangmasuk/$1',['filter'=>'role:admin_validasi']);
$routes->get('ubahbarangmasuk_validasi/(:any)', 'Validasi_QA::ubahbarangmasuk/$1',['filter'=>'role:admin_validasi']);
$routes->post('submit_ubah_barang_masuk_validasi/(:any)', 'Validasi_QA::submit_ubah_barang_masuk/$1',['filter'=>'role:admin_validasi']);
//pengelolaan laporan barang keluar
$routes->get('/laporanbarangkeluar_validasi', 'Validasi_QA::laporanbarangkeluar_validasi');
$routes->post('/caridata_keluar_validasi', 'Validasi_QA::caridatakeluar');
$routes->get('/caridata_keluar_validasi', 'Validasi_QA::laporanbarangkeluar_validasi');
$routes->delete('deletebarangkeluar_validasi/(:any)', 'Validasi_QA::deletebarangkeluar/$1',['filter'=>'role:admin_validasi']);
$routes->get('ubah_barang_keluar_validasi/(:any)', 'Validasi_QA::ubahbarangkeluar/$1',['filter'=>'role:admin_validasi']);
$routes->post('submit_ubah_barang_keluar_validasi/(:any)', 'Validasi_QA::submit_ubah_barang_keluar/$1',['filter'=>'role:admin_validasi']);
 // lainya 
 $routes->get('/dashboard_validasi', 'Validasi_QA::dashboardqakalkual');
 $routes->get('/baranghabis_validasi', 'Validasi_QA::baranghabiskalkual');
 $routes->get('/baranged_validasi', 'Validasi_QA::barangedkalkual');
 $routes->get('/update_so_validasi', 'Validasi_QA::update_so',[ 'filter'=>'role:admin_validasi']);
 $routes->get('/submit_update_so_validasi', 'Validasi_QA::submit_update_so',[ 'filter'=>'role:admin_validasi']);
// file remainder
 $routes->get('cron/reminder/(:segment)', 'Cron::reminder/$1');
 $routes->get('cron_validasi/reminder/(:segment)', 'Cron_validasi::reminder/$1');