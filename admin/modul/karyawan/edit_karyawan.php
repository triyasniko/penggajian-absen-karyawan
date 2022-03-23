<?php
$id = $_GET['id_karyawan'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id_karyawan='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Karyawan</h6>
            </div>
            <div class="card-header py-2">
                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Karyawan :</label>
                            <input type="hidden" class="form-control" name="id_karyawan" value="<?php echo $d['id_karyawan']; ?>">
                            <input type="text" class="form-control" name="nama_karyawan" value="<?php echo $d['nama_karyawan']; ?>">
                        </div>
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
                            <label>Foto</label>
                            <input name="foto" type="file" class="form-control" value="<?php echo $d['foto']; ?>">
                        </div>

                        <button name="updateKaryawan" type="submit" class="btn btn-success mr-2">Simpan</button>
                        <button class="btn btn-success mr-2" a href="index.php">Kembali</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php

    if (isset($_POST['updateKaryawan'])) {
        $gambar = @$_FILES['foto']['name'];
        if (!empty($gambar)) {
            move_uploaded_file($_FILES['foto']['tmp_name'], "karyawan/images/$gambar");
            $ganti = mysqli_query($koneksi, "UPDATE tb_karyawan SET foto='$gambar' 
	    	WHERE id_karyawan='$_POST[id_karyawan]' ");
        }
        $updatekaryawan = mysqli_query($koneksi, "UPDATE tb_karyawan SET 
			nama_karyawan='$_POST[nama_karyawan]', id_jabatan='$_POST[nama_jabatan]'
			WHERE id_karyawan='$_POST[id_karyawan]' ");

        if ($updatekaryawan) {
            echo " <script>
	  alert('Data Berhasil diperbarui !');
	  window.location='?page=karyawan';
	  </script>";
        }
    }

    ?>

<?php
}
?>

</body>

</html>