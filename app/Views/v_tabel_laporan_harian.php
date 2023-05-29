<b>No Faktur :</b> <?= $no_faktur ?>
<hr>
<table class="table table-bordered table-striped">
    <tr class="text-center">
        <th>No</th>
        <th>Jam</th>
        <th>No Faktur</th>
        <th>Kode Menu</th>
        <th>Nama Menu</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>QTY</th>
        <th>Total Harga</th>
    </tr>
    <?php $no = 1;
    foreach ($dataharian as $key => $value) {
        $grandtotal[] = $value['total_harga'];
    ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= $value['jam'] ?></td>
            <td><?= $value['no_faktur'] ?></td>
            <td><?= $value['kode_menu'] ?></td>
            <td><?= $value['nama_menu'] ?></td>
            <td><?= $value['nama_kategori'] ?></td>
            <td class="text-right">Rp. <?= number_format($value['harga'], 0) ?></td>
            <td><?= $value['qty'] ?></td>
            <td class="text-right">Rp. <?= number_format($value['total_harga'], 0) ?></td>
        </tr>

    <?php } ?>

    <tr>
        <td class="text-center bg-gray" colspan="8">
            <h5>Grand Total</h5>
        </td>
        <td class="text-right">
            Rp. <?= $dataharian == null ? '' : number_format(array_sum($grandtotal), 0) ?>
        </td>
    </tr>
</table>