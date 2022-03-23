<?php
$tgl = date('d-m-Y');
?>
<?php
$jam = date("h:i:sa");
?>
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Silahkan Masukkan Keterangan Anda</h6>
        </div>
        <div class="card-body">
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
                        <label>Kegiatan Yang Sudah Dikerjakan :</label>
                        <textarea name="daftar_kegiatan" class="form-control" rows="5" cols="40">
                        </textarea>
                    </div>
                    
                    <button name="saveKeluar" type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// cek nis
if (isset($_POST['saveKeluar'])) {
    $datenow        = date('d');
    $id             = $_POST['id_karyawan'];
    $date           = date('Y-m-d');
    $jam1            = date("h:i:sa");
    $jam2            = date("h:i:sa");
    $daftar_kegiatan = $_POST['daftar_kegiatan'];
    $status         = 'hadir';
    $valid          = 'N';
    $sumber         = @$_FILES['foto']['tmp_name'];
    $target         = '../assets/img/bukti/';
    $nama_gambar    = @$_FILES['foto']['name'];
    $pindah         = move_uploaded_file($sumber, $target . $nama_gambar);


    //query UPDATE disini
    $save = mysqli_query($koneksi, "UPDATE tb_absenkaryawan SET 
    id_karyawan='$id',  
    tgl_absensi='$date',   
    jam_keluar='$jam2',
    daftar_kegiatan='$daftar_kegiatan'   
    WHERE id_karyawan='$id' AND tgl_absensi='$date' ");

    if ($save) {
        echo " <script>
      alert('Data Berhasil Disimpan !');
      window.location='?page=absen';
      </script>";
    }
}


?>