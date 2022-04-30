<?php
// $tgl = date('d-m-Y');
// $jam = date("h:i:sa");
?>
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Silahkan Masukkan Keterangan Anda</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php //var_dump($data); ?>
                    <div class="form-group">
                        <label>Kode Karyawan</label>
                        <input type="hidden" class="form-control" name="id_karyawan"
                            value="<?= $data['id_karyawan']; ?>" readonly>
                        <input type="text" class="form-control" name="kode_karyawan"
                            value="<?= $data['kode_karyawan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" name="nama_karyawan"
                            value="<?= $data['nama_karyawan']; ?>" readonly>
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
if (isset($_POST['saveKeluar'])) {
    $date           = date('Y-m-d');
    $id             = $_POST['id_karyawan'];
    $jam2            = date("Y-m-d H:i:s");
    $daftar_kegiatan = $_POST['daftar_kegiatan'];
    
    $query_lembur = mysqli_query($koneksi, "SELECT * FROM tb_absenkaryawan WHERE id_karyawan='$id' AND tgl_absensi='$date' AND status_absensi='hadir'");
    // echo mysqli_num_rows($query_lembur)."<br>";
    // echo $date."<br>";
    // echo "jam keluar : ".$jam2."<br>";
    // var_dump($data=mysqli_fetch_assoc($query_lembur));
    $data=mysqli_fetch_assoc($query_lembur);
    // echo "<br>".$data['jam_masuk']."<br>";
    // echo "-------------------<br>";
    
    $totaljam=strtotime($jam2)-strtotime($data['jam_masuk']);
    // echo $totaljam."<br>";
    $format_jam=floor($totaljam / (60 * 60));
    // $format_menit=floor(($totaljam-$format_jam* (60 * 60))/60);
    // echo "<p>"."Total Jam : ".$format_jam." jam "."</p>";
    // echo "Lembur :";
    if($format_jam>8){
        $jam_lembur=$format_jam-8;
        // echo "<b>$jam_lembur</b>";
    }else{
        // jam_lembur = 0
        $jam_lembur=0;
        // echo "<b>$jam_lembur</b>";
    }
    // exit();
    
    //query UPDATE disini
    $save = mysqli_query($koneksi, "UPDATE tb_absenkaryawan SET 
    id_karyawan='$id',  
    tgl_absensi='$date',   
    jam_keluar='$jam2',
    daftar_kegiatan='$daftar_kegiatan',
    total_jam_kerja='$format_jam',
    jam_lembur='$jam_lembur',
    foto='-'   
    WHERE id_karyawan='$id' AND tgl_absensi='$date' ") 
    or die(mysqli_error($koneksi));
    
    if ($save) {
        echo " <script>
        alert('Data Berhasil Disimpan !');
        window.location='?page=absen';
        </script>";
    }
}


?>