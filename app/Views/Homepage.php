<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="text-align: center;">Selamat datang, <strong><?= user()->username; ?></strong></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
       
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                   
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php
                            $bulan = date('F');
                            $tahun = date('Y');
                            $hari_ini = date('j');
                            $total_hari = date('t');
                            $total_hari = date('t', strtotime("$tahun-$bulan-01"));
                            $start_day = date('w', strtotime("$tahun-$bulan-01"));
                        ?>
                    <table class="table table-bordered text-center bg-light" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr class="bg-info text-white">
                                <th colspan="7"><?= $bulan . ' ' . $tahun; ?></th>
                            </tr>
                            <tr>
                                <th>Min</th>
                                <th>Sen</th>
                                <th>Sel</th>
                                <th>Rab</th>
                                <th>Kam</th>
                                <th>Jum</th>
                                <th>Sab</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                 date_default_timezone_set('Asia/Jakarta');
                                $bulan = date('m'); // Format angka bulan
                                $tahun = date('Y');
                                $hari_ini = date('j'); // Tanggal hari ini
                                $total_hari = date('t', strtotime("$tahun-$bulan-01")); // Total hari dalam bulan ini
                                $start_day = date('w', strtotime("$tahun-$bulan-01")); // Hari pertama bulan ini
                                $current_day = 1;

                                echo '<tr>';

                                // Mengisi sel kosong sebelum tanggal 1
                                for ($i = 0; $i < $start_day; $i++) {
                                    echo '<td></td>';
                                }

                                // Menampilkan tanggal-tanggal dalam minggu pertama
                                for ($i = $start_day; $i < 7; $i++) {
                                    echo ($current_day == $hari_ini) 
                                        ? '<td class="bg-warning font-weight-bold">' . $current_day . '</td>' 
                                        : '<td>' . $current_day . '</td>';
                                    $current_day++;
                                }
                                echo '</tr>';

                                // Perulangan untuk minggu-minggu berikutnya
                                while ($current_day <= $total_hari) {
                                    echo '<tr>';
                                    for ($i = 0; $i < 7; $i++) {
                                        if ($current_day > $total_hari) {
                                            echo '<td></td>'; // Mengisi sel kosong jika sudah melewati jumlah hari dalam bulan
                                        } else {
                                            echo ($current_day == $hari_ini) 
                                                ? '<td class="bg-warning font-weight-bold">' . $current_day . '</td>' 
                                                : '<td>' . $current_day . '</td>';
                                        }
                                        $current_day++;
                                    }
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>         

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<?= $this-> endSection(); ?>
