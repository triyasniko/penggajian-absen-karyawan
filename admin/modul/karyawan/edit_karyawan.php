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
                            <label>NIK :</label>
                            <input type="text" class="form-control" placeholder="Masukkan NIK" value="<?php echo $d['nik']; ?>" name="nik" required="required">
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
                            <label>Pendidikan Terakhir :</label>
                            <select class="form-control" name="pendidikan">
                                <option>-- Pilih Pendidikan--</option>
                                <option value="SD" <?php if($d['pendidikan']=="SD"){ echo "selected";} ?> >SD</option>
                                <option value="SMP" <?php if($d['pendidikan']=="SMP"){ echo "selected";} ?> >SMP</option>
                                <option value="SMA" <?php if($d['pendidikan']=="SMA Sederajat"){ echo "selected";} ?> >SMA Sederajat</option>
                                <option value="D3" <?php if($d['pendidikan']=="D3"){ echo "selected";} ?> >D3</option>
                                <option value="S1 Sederajat" <?php if($d['pendidikan']=="S1 Sederajat"){ echo "selected";} ?> >S1 Sederajat</option>
                                <option value="S2" <?php if($d['pendidikan']=="S2"){ echo "selected";} ?> >S2</option>
                                <option value="S3" <?php if($d['pendidikan']=="S3"){ echo "selected";} ?> >S3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Karyawan :</label>
                            <select class="form-control" name="status_karyawan">
                                <option>-- Pilih Status--</option>
                                <option value="Tetap" <?php if($d['status_karyawan']=="Tetap"){ echo "selected";} ?> >Tetap</option>
                                <option value="Harian" <?php if($d['status_karyawan']=="Harian"){ echo "selected";} ?> >Harian</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <label>Status Perkawinan :</label>
                            <select name="status_menikah" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <option <?php if($d['status_menikah']=="Single"){ echo "selected";} ?> value="1"> Single </option>
                                <option <?php if($d['status_menikah']=="Menikah"){ echo "selected";} ?> value="2"> Menikah </option>
                            </select>
                        </div>
                        <div class="form-group" id="contain_status_nikah">
                            <label>Memiliki Anak :</label>
                            <select name="status_memiliki_anak" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <option <?php if($d['status_memiliki_anak']=="Belum ada anak"){ echo "selected";} ?> value="1"> Menikah belum ada anak </option>
                                <option <?php if($d['status_memiliki_anak']=="Sudah memiliki anak"){ echo "selected";} ?> value="2"> Sudah memiliki anak </option>
                            </select>
                        </div>
                        <div class="form-group" id="contain_jumlah_anak"  style="display:none;">
                            <label>Jumlah Anak :</label>
                            <input type="text" class="form-control" name="jumlah_anak" value="<?php echo $d['jumlah_anak'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <textarea name="alamat" required="required" class="form-control" placeholder="Masukkan Alamat Lengkap">
                                <?php echo $d['alamat']; ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input name="foto" type="file" class="form-control" value="<?php echo $d['foto']; ?>">
                        </div>

                        <button name="updateKaryawan" type="submit" class="btn btn-success mr-2">Simpan</button>
                        <button class="btn btn-light mr-2" a href="index.php">Kembali</button></a>
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
			nama_karyawan='$_POST[nama_karyawan]',nik='$_POST[nik]', 
            id_jabatan='$_POST[nama_jabatan]',pendidikan='$_POST[pendidikan]',
            status_karyawan='$_POST[status_karyawan]', 
            status_menikah='$_POST[status_menikah]', 
            status_anak='$_POST[status_anak]',jumlah_anak='$_POST[jumlah_anak]',
            alamat='$_POST[alamat]'
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

<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#contain_status_nikah').hide();
        $('select[name="status_menikah"]').change(function(){
            let valStatus = $(this).val();
            if(valStatus == 2){
                $('#contain_status_nikah').show();
                $('select[name="status_memiliki_anak"]').change(function(){
                    let valStatusAnak=$(this).val();
                    if(valStatusAnak == 2){
                        $('#contain_jumlah_anak').show();
                    }else{
                        $('#contain_jumlah_anak').hide();
                    }
                });
            }else{
                $('#contain_status_nikah').hide();
                $('#contain_jumlah_anak').hide();
            }
        });


    });
</script>