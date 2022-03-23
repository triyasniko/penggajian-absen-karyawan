<?php
$id = $_GET['id_jabatan'];
$data = mysqli_query($koneksi, "SELECT * from tb_jabatan where id_jabatan='$id'")or die(mysqli_error($koneksi));
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="text-center h3 m-0 font-weight-bold text-primary">Edit Data jabatan</div>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama jabatan</label>
                        <input type="hidden" name="id_jabatan" value="<?php echo $d['id_jabatan']; ?>">
                        <input type="text" class="form-control" name="nama_jabatan" value="<?php echo $d['nama_jabatan']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="text" class="form-control" name="gapok" value="<?php echo $d['gapok']; ?>">
                    </div>
                    <button name="updateJabatan" type="submit" class="btn btn-success mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>

<?php
}
?>

<?php
// cek nis
if (isset($_POST['updateJabatan'])) {
    $id = $_POST['id_jabatan'];
    $nama = $_POST['nama_jabatan'];
    $gapok = $_POST['gapok'];

    //query INSERT disini
    $save = mysqli_query($koneksi, "UPDATE tb_jabatan SET nama_jabatan='$nama',gapok='$gapok' WHERE id_jabatan='$id'") or die(mysqli_error($koneksi));

    if ($save) {
        echo " <script>
      alert('Data Berhasil Diubah !');
      window.location='?page=jabatan';
      </script>";
    }
}

?>