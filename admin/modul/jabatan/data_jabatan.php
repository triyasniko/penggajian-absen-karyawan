<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Jabatan</h5>
        <div class="card-body">
            <a href="?page=jabatan&act=add" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah
                Jabatan</a></button>
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered text-center" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT * FROM tb_jabatan")or die(mysqli_error($koneksi));
                        while ($d = mysqli_fetch_array($data)) {
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d['nama_jabatan']; ?></td>
                            <td><?= rupiah($d['gapok']); ?></td>
                            <td>
                                <a href="?page=jabatan&act=detail&id_jabatan=<?= $d['id_jabatan']; ?>"
                                    class="btn btn-primary text-white text-right"> <i
                                        class="fa fa-user text-white"></i></a>
                                <a href="?page=jabatan&act=edit&id_jabatan=<?= $d['id_jabatan']; ?>"
                                    class="btn btn-warning text-white text-right"> <i
                                        class="fa fa-user-edit text-white"></i></a>
                                <a href="?page=jabatan&act=del&id_jabatan=<?= $d['id_jabatan']; ?>"
                                    class="btn btn-danger text-white text-right"> <i
                                        class="fas fa-trash-alt fa-1x text-white"></i></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>