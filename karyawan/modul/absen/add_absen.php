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
                        <label>Waktu Absen</label>
                        <input type="text" class="form-control" name="jam_absensi" value="<?= $jam; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <select name="status_absensi" class="form-control" required>
                            <option value="">-- Pilih Keterangan --</option>
                            <option value="sakit"> Sakit </option>
                            <option value="izin"> Izin </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label>Tanggal</label><br> -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Mulai</label>
                                <input type="date" class="form-control" name="tgl_mulai" required>
                            </div>
                            <div class="col-md-6">
                                <label>Akhir</label>
                                <input type="date" class="form-control" name="tgl_akhir" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label>
                        <textarea name="keterangan" class="form-control" rows="5" cols="40">
                        </textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Bukti Izin/Sakit</label>
                        <input type="file" name="foto" required="required">
                        <p style="color: red">Silahkan masukkan bukti izin/sakit dengan ekstensi .png | .jpg | .jpeg</p>
                    </div>
                    <button name="saveIzin" type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

// cek nis
if (isset($_POST['saveIzin'])) {
    $id             = $_POST['id_karyawan'];
    $date           = date('Y-m-d');
    $jam            = date("Y-m-d H:i:s");
    $ket            = $_POST['keterangan'];
    $status         = $_POST['status_absensi'];
    $sumber         = @$_FILES['foto']['tmp_name'];
    $target         = '../assets/img/bukti/';
    $nama_gambar    = @$_FILES['foto']['name'];
    $pindah         = move_uploaded_file($sumber, $target . $nama_gambar);
    $tgl_mulai      = $_POST['tgl_mulai'];
    $tgl_akhir      = $_POST['tgl_akhir'];

    // check apakah absen sudah diisi
    $sql_checkabsen       = mysqli_query($koneksi, "SELECT * FROM tb_absenkaryawan WHERE id_karyawan = '$id' AND tgl_absensi='$date'");
    $hitungdata         = mysqli_num_rows($result);
    // var_dump ($hitungdata);
    // exit();
    // if ($count > 0) {
    //     echo " <script>
    //         alert('Absen sudah diisi !');
    //         window.location='?page=absen';
    //         </script>";
    // }else{
        // check apakah tgl_mulai lebih dari 4 hari
        $batas_input = date('Y-m-d', strtotime('-4 days', strtotime($date)));
        // echo $batas_input;
        if ($tgl_mulai < $batas_input) {
            echo "<script>alert('File lampiran gagal ditambahkan karena melewati batas hari maximal input!');</script>";
            echo "<script>location='index.php?page=absen';</script>";
        }else{
            // check tgl_mulai tidak boleh lebih dari tgl_akhir
            if ($tgl_mulai > $tgl_akhir) {
                echo "<script>alert('File lampiran gagal ditambahkan karena format tanggal mulai dan tanggal akhir salah!');</script>";
                echo "<script>location='index.php?page=absen';</script>";
                // exit();
            }else{
                $save = mysqli_query($koneksi, "INSERT INTO tb_absenkaryawan 
                                (id_absensikaryawan,id_karyawan,tgl_absensi,jam_masuk,jam_keluar,keterangan,status_absensi,foto,tgl_mulai,tgl_akhir)
                                VALUES(NULL,'$id','$date', '$jam','$jam','$ket','$status','$nama_gambar','$tgl_mulai','$tgl_akhir')")
                                or die(mysqli_error($koneksi));
                if ($save) {
                    echo "<script>alert('File lampiran berhasil ditambahkan');</script>";
                    echo "<script>location='index.php?page=absen';</script>";
                }
            }
        }
    // }

    
}

?>