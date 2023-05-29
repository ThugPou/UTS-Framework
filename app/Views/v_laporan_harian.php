<?php

use App\Controllers\Laporan;
?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No Faktur : </label>
                        <div class="col-sm-10 input-group">
                            <input name="no_faktur" id="no_faktur" type="text" class="form-control">
                            <span class="input-group-append">
                                <button onclick="ViewTabelLaporan()" class=" btn btn-primary">
                                    <i class="fas fa-file-alt"></i> View Laporan
                                </button>
                                <button onclick="PrintLaporan()" class=" btn btn-danger">
                                    <i class="fas fa-print"></i> Print Laporan
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr>
                    <div class="tabel">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    function ViewTabelLaporan() {
        let no_faktur = $('#no_faktur').val()
        if (no_faktur == "") {
            swal.fire('Pilih No Faktur terlebih dahulu!');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Laporan/ViewLaporanHarian') ?>",
                data: {
                    no_faktur: no_faktur,
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.data) {
                        $('.tabel').html(response.data)
                    }
                }
            });
        }
    }

    function PrintLaporan() {
        let no_faktur = $('#no_faktur').val()
        if (no_faktur == "") {
            swal.fire('Pilih tanggal terlebih dahulu!');
        } else {
            NewWin = window.open('<?= base_url('Laporan/PrintLaporanHarian') ?>/' + no_faktur, 'NewWin', 'toolbar=no, width=1500,height=800,scrollbars=yes');
        }
    }
</script>