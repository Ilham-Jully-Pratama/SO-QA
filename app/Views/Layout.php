<!DOCTYPE html>
<html lang="en">

   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Quality Assurance</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?= base_url() ?>/css/metisMenu.min.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="<?= base_url() ?>/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?= base_url() ?>/css/dataTables/dataTables.responsive.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url() ?>/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= base_url() ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <style>
            .swal2-popup {
                font-size: 1.6rem !important; /* Diperbaiki: spasi sebelum !important */
            }
            .is-invalid {
               border-color: #dc3545; /* Red border */
           }
           
           #searchInput {
            width: 50%; /* Menyesuaikan lebar dengan elemen container (misal, 100% dari lebar elemen parent) */
            max-width: 130px; /* Membatasi lebar maksimal input */
            height: 35px; /* Menentukan tinggi input */
            padding: 8px 16px; /* Padding di dalam input untuk jarak teks dengan sisi */
            border-radius: 10px; /* Sudut melengkung pada input */
            border: 1px solid #ccc; /* Warna dan tipe border */
            font-size: 14px; /* Ukuran font */
            box-sizing: border-box; /* Agar padding tidak menambah ukuran lebar */
            transition: border-color 0.3s ease; /* Efek transisi pada border */
        }

        /* Menambahkan efek focus ketika input diklik */
        #searchInput:focus {
            border-color: #007BFF; /* Ganti warna border saat input fokus */
            outline: none; /* Menghilangkan outline default */
        }


        </style>
        <script src="<?= base_url() ?>/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>/js/metisMenu.min.js"></script>
        <script src="<?= base_url() ?>/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>/js/dataTables/dataTables.bootstrap.min.js"></script>
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
   </head>
   
   <body>

   <div id="wrapper">

            <!-- Navigation -->
            <?= $this->include('Header'); ?>
            <?= $this->include('Sidebar'); ?>
            <!-- /.sidebar -->
            <?= $this->renderSection('content'); ?>
            <!-- /.content -->
   </div>

        
        
<!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url() ?>/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
        
     
<!-- Custom Theme JavaScript -->
        <script src="<?= base_url() ?>/js/startmin.js"></script>
<!-- DataTables JavaScript -->
       
<!-- alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
        <script>//flash tidak berhasil
                var flash =$('#flash2').data('flash');
                if(flash){
                Swal.fire({
                position: "top-center",
                icon: "error",
                text: "Patikan Form Disi dengan Benar",
                title: flash,
                showConfirmButton: false,
                timer: 1500
                // allowOutsideClick: true,
                // showCancelButton: true,
                })
                }
        </script>
        <script>//flash berhasil
                var flash =$('#flash').data('flash');
                if(flash){
                Swal.fire({
                position: "top-center",
                icon: "success",
                title: flash,
                showConfirmButton: false,
                timer: 1500
                // allowOutsideClick: true,
                // showCancelButton: true,
                })
                }
        </script>
        <script>//flash homepage
                var flash =$('#flash3').data('flash');
                if(flash){
                        Swal.fire({
                        title: "PERHATIAN",
                        text: flash,
                        icon: "warning",
                        iconColor:"red"
                        });
                }
        </script>
        <script>//flash homepage ok
                var flash =$('#flash4').data('flash');
                if(flash){
                        Swal.fire({
                        title: "PERHATIAN",
                        text: flash,
                        icon: "success",
                        
                        });
                }
        </script>
       
   </body>
</html>
