<?php
$id_gaji = $_GET['id_gaji'];
// $data = mysqli_query($koneksi, "SELECT * FROM tb_gaji WHERE id_gaji = '$id_gaji'");
// while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                Detail Gaji
            </div>
            <div class=" card-body">
                <div class="card-deck">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM tb_gaji WHERE id_gaji = '$id_gaji'");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                <tbody>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td><?= tgl_indo(date('Y-m-d', strtotime(($d['tgl_gaji'])))); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gaji Pokok</th>
                                        <td>
                                            <?php echo rupiah($d['gapok']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tunjangan</th>
                                        <td><?= rupiah($d['tunjangan']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Jam Lembur</th>
                                        <td><?= $d['total_jam_lembur']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Upah Lembur</th>
                                        <td><?= rupiah($d['jumlah_upah_lembur']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tidak Hadir</th>
                                        <td><?= $d['tidakhadir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Potongan</th>
                                        <td><?= rupiah($d['potongan_tidakhadir']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Gaji</th>
                                        <td><?= rupiah($d['total_gaji']); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php //} ?>