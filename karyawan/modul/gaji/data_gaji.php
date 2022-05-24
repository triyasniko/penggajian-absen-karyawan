<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="text-center h3 m-0 font-weight-bold text-primary">Data Penggajian</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Gaji Bersih</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT * FROM tb_gaji WHERE id_karyawan = '$sesi'");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= tgl_indo(date('Y-m-d', strtotime(($d['tgl_gaji'])))); ?></td>
                            <td>
                                <?php echo rupiah($d['total_gaji']); ?>
                            </td>
                            <td>
                                <a href="?page=gaji&act=detail_gaji&id_gaji=<?php echo $d['id_gaji']; ?>" class="btn btn-outline-primary"><i
                                            class="fa fa-info"></i> </a>
                                <a href="modul/gaji/cetak_gaji.php?gaji=<?= $_GET['gaji']; ?>&id=<?= $d['id_gaji'] ?>"
                                    target="_blank" class="btn btn-success text-white text-right"><i
                                        class="fa fa-print text-white"></i> </a>
                            </td>
                            <?php
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                </tr>
            </div>
        </div>
    </div>
</div>