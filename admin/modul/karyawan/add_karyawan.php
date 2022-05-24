<?php
// https://www.malasngoding.com
// menghubungkan dengan koneksi database
include "../config/koneksi.php";

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(kode_karyawan) as kodeTerbesar FROM tb_karyawan");
$data = mysqli_fetch_array($query);
$kodeKaryawan = $data['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeKaryawan, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "FLC";
$kodeKaryawan = $huruf . sprintf("%03s", $urutan);
?>
<?php
$level = "karyawan";
?>
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Karyawan</h6>
        </div>
        <div class="card-body">

            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Karyawan :</label>
                        <input type="text" class="form-control" name="kode_karyawan" required="required" value="<?php echo $kodeKaryawan ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama :</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama_karyawan" required="required">
                    </div>
                    <div class="form-group">
                        <label>NIK :</label>
                        <input type="text" class="form-control" placeholder="Masukkan NIK" name="nik" required="required">
                    </div>
                    <div class="form-group">
                        <label>Jabatan :</label>
                        <select class="form-control" name="id_jabatan">
                            <?php $c = mysqli_query($koneksi, "SELECT * FROM tb_jabatan");
                            while ($dc = mysqli_fetch_array($c)) { ?>
                                <option value="<?= $dc['id_jabatan'] ?>"><?= $dc['nama_jabatan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir :</label>
                        <select class="form-control" name="pendidikan" required>
                            <option value="">--Pilih Pendidikan--</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA Sederajat">SMA Sederajat</option>
                            <option value="D3">D3</option>
                            <option value="S1 Sederajat">S1 Sederajat</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Karyawan</label>
                        <select name="status_karyawan" class="form-control" required>
                            <option value="">-- Pilih Status Karyawan --</option>
                            <option value="tetap"> Tetap </option>
                            <option value="harian">Harian </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golongan Darah :</label>
                        <select class="form-control" name="golongan_darah" required>
                            <option value="">--Pilih Golongan Darah--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat :</label>
                        <textarea name="alamat" required="required" class="form-control" placeholder="Masukkan Alamat Lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto :</label>
                        <input type="file" name="foto" required="required">
                        <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
                    </div>
                    

                    <button name="saveKaryawan" type="submit" class="btn btn-success mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php

// cek nis
if (isset($_POST['saveKaryawan'])) {
    $id         = $_POST['id_karyawan'];
    $kode         = $_POST['kode_karyawan'];
    $nama         = $_POST['nama_karyawan'];
    $nik       = $_POST['nik'];
    $username    = $_POST['kode_karyawan'];
    $pass        = $_POST['kode_karyawan'];
    $status         = $_POST['status_karyawan'];
    $golongan_darah=$_POST['golongan_darah'];
    $jabatan        = $_POST['id_jabatan'];
    $alamat     = $_POST['alamat'];
    $pendidikan    = $_POST['pendidikan'];
    $sumber       = @$_FILES['foto']['tmp_name'];
    $target       = '../assets/img/karyawan/';
    $nama_gambar  = @$_FILES['foto']['name'];
    $pindah       = move_uploaded_file($sumber, $target . $nama_gambar);
    $date         = date('Y-m-d');
    


    //query INSERT disini
    $nama = addslashes($_POST['nama_karyawan']);
    $save = mysqli_query($koneksi, "INSERT INTO tb_karyawan VALUES(NULL,'$kode','$nama','$nik', 
	          	'$jabatan','$pendidikan','$username','$pass','$status','$golongan_darah','$alamat','$nama_gambar')");

    if ($save) {
        echo " <script>
	          alert('Data Berhasil disimpan !');
	          window.location='?page=karyawan';
	          </script>";
    }
}

?>