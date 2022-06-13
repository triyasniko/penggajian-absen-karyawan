<?php
$tgl = date('d-m-Y');
?>
<?php
$jam = date("h:i:sa");
?>

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Absensi Karyawan</h6>
        </div>
        <div class="card-body">
            <p style="color: red">Silahkan isi absen setiap hari kerja</p>
            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Karyawan</label>
                        <input type="hidden" class="form-control" name="id_karyawan" value="<?= $data['id_karyawan']; ?>" readonly>
                        <input type="text" class="form-control" name="kode_karyawan" value="<?= $data['kode_karyawan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" name="nama_karyawan" value="<?= $data['nama_karyawan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tgl_absensi" value="<?= $tgl ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="text" class="form-control" name="jam_absensi" value="<?= $jam ?>" readonly>
                    </div>
                    <button name="saveMasuk" type="submit" class="btn btn-primary mr-2">Absen Masuk</button>
                    
                    <a href="?page=absen&act=saveKeluar" class="btn btn-success mr-2" disabled='disabled'>Absen Keluar</a>
                    <a href="?page=absen&act=add" class="btn btn-danger mr-2">Klik tombol ini jika berhalangan hadir/absen</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

// cek nis
if (isset($_POST['saveMasuk'])) {
    $id             = $_POST['id_karyawan'];
    $date           = date('Y-m-d');
    $jam1            = date("Y-m-d H:i:s");
    $jam2            = date("Y-m-d H:i:s");

    // $ket            = $_POST['keterangan'];
    $status         = 'hadir';
    // $valid         = 'N';
    // $sumber         = @$_FILES['foto']['tmp_name'];
    // $target         = '../assets/img/bukti/';
    // $nama_gambar    = @$_FILES['foto']['name'];
    // $pindah         = move_uploaded_file($sumber, $target . $nama_gambar);

    $result       = mysqli_query($koneksi, "SELECT * FROM tb_absenkaryawan WHERE id_karyawan = '$id' AND tgl_absensi='$date'");
    $count         = mysqli_num_rows($result);
    if ($count > 0) {
        echo " <script>
            alert('Absen masuk sudah diisi !');
            window.location='?page=absen';
            </script>";
    } else {
        $save = mysqli_query($koneksi, "
                INSERT INTO 
                tb_absenkaryawan(id_absensikaryawan, id_karyawan,tgl_absensi,jam_masuk,jam_keluar,status_absensi,foto)
                VALUES(NULL,'$id','$date', '$jam1','$jam2','$status','-')") or die(mysqli_error($koneksi));

        if ($save) {
            echo " <script>
	          alert('Data Berhasil disimpan !');
	          window.location='?page=absen';
	          </script>";
        }
    }
}

?>
