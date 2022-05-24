<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="text-center h3 m-0 font-weight-bold text-primary">Form Tambah Data Tunjangan</div>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control" name="id_jabatan">
                        <option value="-">-- Pilih --</option>
                        <?php $sql_jabatan = mysqli_query($koneksi, "SELECT * FROM tb_jabatan");
                        while ($data_jabatan = mysqli_fetch_array($sql_jabatan)) { ?>
                            <option value="<?= $data_jabatan['id_jabatan'] ?>"><?= $data_jabatan['nama_jabatan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Tunjangan </label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Tunjangan" name="nama_tunjangan" required="required">
                </div>
                <div class="form-group">
                    <label>Jumlah Tunjangan</label>
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Tunjangan" name="jumlah_tunjangan" required="required">
                </div>

                <button name="saveTunjangan" type="submit" class="btn btn-success mr-2">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
// cek nis
if (isset($_POST['saveTunjangan'])) {
    $nama               = $_POST['nama_tunjangan'];
    $jumlah_tunjangan   = $_POST['jumlah_tunjangan'];
    $id_jabatan         = $_POST['id_jabatan'];

    //query INSERT disini
    $save= mysqli_query($koneksi, "INSERT INTO tb_tunjangan (nama_tunjangan, jumlah_tunjangan, id_jabatan) VALUES ('$nama', '$jumlah_tunjangan', '$id_jabatan')");

    if ($save) {
        echo " <script>
            alert('Data Berhasil disimpan !');
            window.location='?page=tunjangan';
      </script>";
    }
}

?>