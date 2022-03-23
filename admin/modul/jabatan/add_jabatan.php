<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="text-center h3 m-0 font-weight-bold text-primary">Tambah Data Jabatan</div>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Jabatan </label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Jabatan" name="nama_jabatan" required="required">
                </div>
                <div class="form-group">
                    <label>Gaji Pokok</label>
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Gaji" name="gapok" required="required">
                </div>

                <button name="saveJabatan" type="submit" class="btn btn-success mr-2">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
// cek nis
if (isset($_POST['saveJabatan'])) {
    $id = $_POST['id_jabatan'];
    $nama = $_POST['nama_jabatan'];
    $gapok = $_POST['gapok'];

    //query INSERT disini
    $save = mysqli_query($koneksi, "INSERT INTO tb_jabatan VALUES(NULL,'$nama','$gapok')")or die(mysqli_error($koneksi));

    if ($save) {
        echo " <script>
      alert('Data Berhasil disimpan !');
      window.location='?page=jabatan';
      </script>";
    }
}

?>