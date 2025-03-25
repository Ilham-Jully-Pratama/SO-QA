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
                                $start_day = date('w', strtotime("$tahun-$bulan-01"));
                                $current_day = 1;
                                echo '<tr>';
                                for ($i = 0; $i < $start_day; $i++) {
                                    echo '<td></td>';
                                }
                                for ($j = $start_day; $j < 7; $j++) {
                                    echo ($current_day == $hari_ini) ? '<td class="bg-warning font-weight-bold">' . $current_day . '</td>' : '<td>' . $current_day . '</td>';
                                    $current_day++;
                                }
                                echo '</tr>';
                                while ($current_day <= $total_hari) {
                                    echo '<tr>';
                                    for ($k = 0; $k < 7; $k++) {
                                        if ($current_day > $total_hari) {
                                            echo '<td></td>';
                                        } else {
                                            echo ($current_day == $hari_ini) ? '<td class="bg-warning font-weight-bold">' . $current_day . '</td>' : '<td>' . $current_day . '</td>';
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
