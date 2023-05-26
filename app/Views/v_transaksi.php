<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Top Navigation</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminlte') ?>/dist/css/adminlte.min.css">
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url('adminlte') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('adminlte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url('adminlte') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('adminlte') ?>/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="<?= base_url('Transaksi') ?>" class="navbar-brand">
          <span class="brand-text font-weight-light"><i class="fas fa-receipt text-primary"></i>Transaksi</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <?php if (session()->get('level' == '1')) { ?>
              <a class="nav-link" href="<?= base_url('Admin') ?>">
                <i class="fas fa-tachometer-alt"></i>
              </a>
            <?php } else { ?>
              <a class="nav-link" href="<?= base_url('Home/Logout') ?>">
                <i class="fas fa-sign-out-alt"></i>Logout
              <?php } ?>

          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="content">
        <div class="row">
          <!-- /.col-md-7 -->
          <div class="col-lg-7">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label>No Faktur</label>
                      <label class="form-control form-control-lg text-danger">
                        <?= $no_faktur ?>
                      </label>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Tanggal</label>
                      <label class="form-control form-control-lg"><?= date('d M Y') ?></label>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Jam</label>
                      <label class="form-control form-control-lg" id="jam"></label>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Kasir</label>
                      <label class="form-control form-control-lg text-primary"><?= session()->get('nama_user') ?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"></h5>
              </div>
              <div class="card-body bg-black text-right">
                <label class="display-4 text-blue">Rp 1,500,000,-</label>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <!-- .col-md-12 -->
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <?php echo form_open() ?>
                    <div class="row">
                      <div class="col-2 input-group">
                        <input name="kode_menu" id="kode_menu" class="form-control" placeholder="Kode Menu" autocomplete="off">
                        <span class="input-group-append">
                          <button class="btn btn-primary btn-flat">
                            <i class="fas fa-search"></i>
                          </button>
                          <button class="btn btn-danger btn-flat">
                            <i class="fas fa-times"></i>
                          </button>
                        </span>
                      </div>
                      <div class="col-2">
                        <input name="nama_menu" class="form-control" placeholder="Nama Menu" readonly>
                      </div>
                      <div class="col-2">
                        <input name="nama_kategori" class="form-control" placeholder="Kategori" readonly>
                      </div>
                      <div class="col-2">
                        <input name="harga" class="form-control" placeholder="Harga" readonly>
                      </div>
                      <div class="col-1">
                        <input id="qty" type="number" min="1" value="1" name="qty" class="form-control" placeholder="Qty">
                      </div>
                      <div class="col-3">
                        <button type="submit" class="btn btn-flat btn-primary"><i class="fas fa-receipt"></i>Tambah</button>
                        <button type="reset" class="btn btn-flat btn-warning"><i class="fas fa-sync"></i>Clear</button>
                        <button class="btn btn-flat btn-success"><i class="fas fa-cash-register"></i>Bayar</button>
                      </div>
                    </div>
                    <?php form_close() ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th>Kode Menu</th>
                          <th>Nama Menu</th>
                          <th>Kategori</th>
                          <th>Harga</th>
                          <th width="50px">Qty</th>
                          <th>Total Harga</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>121321321</td>
                          <td>ayam</td>
                          <td>makanan</td>
                          <td class="text-right">@ Rp 15,000</td>
                          <td class="text-center">2</td>
                          <td class="text-right">Rp 30,000</td>
                          <td class="text-center"><a class="btn btn-flat btn-danger"><i class="fa fa-times"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"></h5>
              </div>
              <div class="card-body bg-black text-center">
                <h1 class="text-blue">Satu Juta Lima Ratus Ribu Rupiah</h1>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <script>
    $(document).ready(function() {
      $('#kode_menu').focus();


      $('#kode_menu').keydown(function(e) {
        let kode_menu = $('#kode_menu').val();
        if (e.keyCode == 13) {
          e.preventDefault();
          if (kode_menu == '') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Kode Menu Kosong'
            });
          } else {
            CekMenu();
          }
        }
      });
    });

    function CekMenu() {
      $.ajax({
        type: "POST",
        url: "<?= base_url('Transaksi/CekMenu') ?>",
        data: {
          kode_menu: $('#kode_menu').val(),
        },
        dataType: "JSON",
        success: function(response) {
          if (response.nama_menu == '') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Kode Menu Tidak Terdaftar'
            });
          } else {
            $('[name = "nama_menu"]').val(response.nama_menu);
            $('[name = "nama_kategori"]').val(response.nama_kategori);
            $('[name = "harga"]').val(response.harga);
            $('#qty').focus();
          }
        }
      });
    }
  </script>

  <script>
    window.onload = function() {
      startTime();
    }

    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('jam').innerHTML = h + ':' + m + ':' + s;
      var t = setTimeout(function() {
        startTime();
      }, 1000);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i
      }
      return i;
    }
  </script>

</body>

</html>