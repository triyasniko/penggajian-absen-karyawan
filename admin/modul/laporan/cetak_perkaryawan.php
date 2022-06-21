<?php
include '../../../config/koneksi.php';
include '../../../config/rupiah.php';

?>
<?php
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * from tb_gaji where id_gaji='$id'");
while ($d = mysqli_fetch_array($data)) {
?>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif, Geneva, Tahoma, sans-serif;
        }

        h3 {
            font-family: 'Times New Roman', Times, serif, Geneva, Tahoma, sans-serif;
        }
    </style>
    <center>
        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM tb_aplikasi");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <img src="../../../assets/img/app/<?= $d['foto'] ?>" class="img-thumbnail" style="height: 100px;width: 100px;">
        <?php } ?>
        <br>
        <h3><b>Laporan Penggajian Karyawan</b></h3>
        <p><b><?= $d['nama_instansi']; ?></p></b>
        <hr style="font-weight:bold; font-size: 12px;">
    </center>

    <body>

        <table width="100%" border="1" style="border-collapse: collapse;" cellpadding="3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Jumlah Upah Lembur</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql_tampil = "SELECT * FROM tb_karyawan INNER JOIN tb_gaji ON tb_karyawan.id_karyawan = tb_gaji.id_karyawan WHERE id_gaji='$id'";
                $query_tampil = mysqli_query($koneksi, $sql_tampil);
                $no = 1;
                while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
                ?>
                    <tr>
                        <td><?= $no++; ?>.</td>
                        <td><?= date('d-m-Y', strtotime(($data['tgl_gaji']))); ?></td>
                        <td><?= $data['kode_karyawan'] ?> </td>
                        <td><?= $data['nama_karyawan'] ?> </td>
                        <td><?= rupiah($data['gapok']) ?> </td>
                        <td><?= rupiah($data['tunjangan']) ?> </td>
                        <td><?php echo rupiah($data['jumlah_upah_lembur']); ?></td>
                        <td><?php echo rupiah($data['potongan_tidakhadir']); ?></td>
                        <td>
                            <?php echo rupiah($data['total_gaji']);?>
                        </td>

                    </tr>
            <?php
                    $no++;
                }
            }
            ?>
            </tbody>
        </table>

    </body>


    <script>
        window.print();
    </script>