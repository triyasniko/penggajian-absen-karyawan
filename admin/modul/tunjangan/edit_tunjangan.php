<?php
$id = $_GET['id_tunjangan'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_tunjangan INNER JOIN tb_jabatan ON tb_tunjangan.id_jabatan=tb_jabatan.id_jabatan where id_tunjangan='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Form Edit Data Tunjangan</h5>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_jabatan">Jabatan </label>
                    <select class="form-control" id="nama_jabatan" name="nama_jabatan">
                        <option>-- Pilih --</option>
                        <?php
                            $sqlJabatan = mysqli_query($koneksi, "SELECT * FROM tb_jabatan ORDER BY id_jabatan DESC");
                            while ($jabatan = mysqli_fetch_array($sqlJabatan)) {
                                if ($jabatan['id_jabatan'] == $d['id_jabatan']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option value='$jabatan[id_jabatan]' $selected>$jabatan[nama_jabatan]</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Tunjangan</label>
                    <input type="hidden" name="id_tunjangan" value="<?php echo $d['id_tunjangan']; ?>">
                    <input type="text" class="form-control" name="nama_tunjangan"
                        value="<?php echo $d['nama_tunjangan']; ?>">
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" class="form-control" name="jumlah_tunjangan"
                        value="<?php echo $d['jumlah_tunjangan']; ?>">
                </div>
                <button name="updateTunjangan" type="submit" class="btn btn-success mr-2">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
}
?>

<?php
// cek nis
if (isset($_POST['updateTunjangan'])) {
    $id = $_POST['id_tunjangan'];
    $nama = $_POST['nama_tunjangan'];
    $jumlah_tunjangan = $_POST['jumlah_tunjangan'];
    $id_jabatan = $_POST['nama_jabatan'];

    //query INSERT disini
    $save=mysqli_query($koneksi, "UPDATE tb_tunjangan SET nama_tunjangan='$nama', jumlah_tunjangan='$jumlah_tunjangan', id_jabatan='$id_jabatan' WHERE id_tunjangan='$id'");
  
    if ($save) {
        echo " <script>
      alert('Data Berhasil Diubah !');
      window.location='?page=tunjangan';
      </script>";
    }
}

?>