<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i>Add Menu
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>

            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <h4>Periksa Lagi</h4>
                    <?php foreach ($errors as $key => $error) { ?>
                        <li><?= esc($error) ?></li>
                    <?php } ?>
                </div>
            <?php } ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Kode Menu</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($menu as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $value['kode_menu'] ?></td>
                            <td><?= $value['nama_menu'] ?></td>
                            <td class="text-center"><?= $value['nama_kategori'] ?></td>
                            <td class="text-center">Rp <?= number_format($value['harga'], 0) ?></td>
                            <td class="text-center"><?= $value['stok'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?= $value['id_menu'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?= $value['id_menu'] ?>"><i class=" fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- modal add data-->
<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data <?= $subjudul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo form_open('Menu/InsertData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Kode Menu</label>
                    <input name="kode_menu" class="form-control" value="<?= old('kode_menu') ?>" placeholder="Kode Menu" required>
                </div>
                <div class="form-group">
                    <label for="">Nama Menu</label>
                    <input name="nama_menu" class="form-control" value="<?= old('nama_menu') ?>" placeholder=" Nama Menu" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="id_kategori" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input name="harga" class="form-control" value="<?= old('harga') ?>" placeholder=" Harga" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Stok</label>
                    <input name="stok" type="number" class="form-control" value="<?= old('stok') ?>" placeholder=" Stok" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php foreach ($menu as $key => $value) { ?>
    <!-- modal edit data-->
    <div class="modal fade" id="edit-data<?= $value['id_menu'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php echo form_open('Menu/UpdateData/' . $value['id_menu']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Menu</label>
                        <input name="kode_menu" class="form-control" value="<?= $value['kode_menu'] ?>" placeholder="Kode Menu" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Menu</label>
                        <input name="nama_menu" class="form-control" value="<?= $value['nama_menu'] ?>" placeholder=" Nama Menu" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <option value="">--Pilih Kategori--</option>
                            <?php foreach ($kategori as $key => $k) { ?>
                                <option value="<?= $k['id_kategori'] ?>" <?= $value['id_kategori'] == $k['id_kategori'] ? 'Selected' : '' ?>><?= $k['nama_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input name="harga" class="form-control" value="<?= $value['harga'] ?>" placeholder=" Harga" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input name="stok" type="number" class="form-control" value="<?= $value['stok'] ?>" placeholder=" Stok" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?php foreach ($menu as $key => $value) { ?>
    <!-- modal delete data-->
    <div class="modal fade" id="delete-data<?= $value['id_menu'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Apakah Anda Yakin Untuk Menghapus <strong><?= $value['nama_menu'] ?></strong>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Menu/DeleteData/' . $value['id_menu']) ?>" class="btn btn-danger btn-flat">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "info": true,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>