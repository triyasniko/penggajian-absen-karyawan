<?php
include "../config/koneksi.php";

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(kode_karyawan) as kodeTerbesar FROM tb_karyawan");
$data = mysqli_fetch_array($query);
$kodeKaryawan = $data['kodeTerbesar'];

$urutan = (int) substr($kodeKaryawan, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

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
                        <label>Status Karyawan :</label>
                        <select name="status_karyawan" class="form-control" required>
                            <option value="">-- Pilih Status Karyawan --</option>
                            <option value="Tetap"> Tetap </option>
                            <option value="Harian">Harian </option>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>Status Perkawinan :</label>
                        <select name="status_menikah" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="1"> Single </option>
                            <option value="2"> Menikah </option>
                        </select>
                    </div>
                    <div class="form-group" id="contain_status_nikah">
                       
                    </div>
                    <div class="form-group" id="contain_jumlah_anak" >
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

if (isset($_POST['saveKaryawan'])) {
    $id         = $_POST['id_karyawan'];
    $kode         = $_POST['kode_karyawan'];
    $nama         = $_POST['nama_karyawan'];
    $nik       = $_POST['nik'];
    $username    = $_POST['kode_karyawan'];
    $pass        = $_POST['kode_karyawan'];
    $status         = $_POST['status_karyawan'];
    $status_menikah = $_POST['status_menikah'];
    $status_anak    = $_POST['status_memiliki_anak'];
    $jumlah_anak    = $_POST['jumlah_anak'];

    // echo $status_menikah."-".$status_anak."-".$jumlah_anak;
    // exit();
    $golongan_darah=$_POST['golongan_darah'];
    $jabatan        = $_POST['id_jabatan'];
    $alamat     = $_POST['alamat'];
    $pendidikan    = $_POST['pendidikan'];
    $sumber       = @$_FILES['foto']['tmp_name'];
    $target       = '../assets/img/karyawan/';
    $nama_gambar  = @$_FILES['foto']['name'];
    $pindah       = move_uploaded_file($sumber, $target . $nama_gambar);
    $date         = date('Y-m-d');
    
    //check value status_menikah, if 1 then status_menikah=menikah else status_menikah=single
    if ($status_menikah == 1) {
       // $status_menikah = "Single";
       $status_menikah = "1";
    } elseif($status_menikah == 2){
       // $status_menikah = "Menikah";
        $status_menikah = "2";
    }

    if ($status_anak == 1) {
        // $status_anak = "Belum ada anak";
        $status_anak = "1";
    } elseif($status_anak == 2){
        // $status_anak = "Sudah memiliki anak";
        $status_anak = "2";
    }

    //query INSERT disini
    $nama = addslashes($_POST['nama_karyawan']);
    $save = mysqli_query($koneksi, "INSERT INTO tb_karyawan 
            (id_karyawan,kode_karyawan,nama_karyawan,nik,id_jabatan,pendidikan,username,password,status_karyawan,status_menikah,status_anak,jumlah_anak,golongan_darah,alamat,foto)
            VALUES(NULL,'$kode','$nama','$nik', '$jabatan','$pendidikan','$username','$pass','$status','$status_menikah','$status_anak','$jumlah_anak','$golongan_darah','$alamat','$nama_gambar')") or die (mysqli_error($koneksi));

    if ($save) {
        echo " <script>
	          alert('Data Berhasil disimpan !');
	          window.location='?page=karyawan';
	          </script>";
    }
}

?>

<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="status_menikah"]').change(function(){
            let valStatus = $(this).val();
            // alert(valStatus);
            if(valStatus == 2){
                let comboStatusNikah = '<label>Memiliki Anak :</label>';
                comboStatusNikah += '<select name="status_memiliki_anak" class="form-control" required  >';
                comboStatusNikah += '<option value="">-- Pilih Status --</option><option value="1"> Menikah belum ada anak </option><option value="2"> Sudah memiliki anak </option>';
                comboStatusNikah += '</select>'

                $('#contain_status_nikah').html(comboStatusNikah);
                $('select[name="status_memiliki_anak"]').change(function(){
                    let valStatusAnak=$(this).val();
                    if(valStatusAnak == 2){
                        let formJumlahAnak = '<label>Jumlah anak :</label><input type="text" class="form-control" name="jumlah_anak" required="required" value="">';
                     
                        $('#contain_jumlah_anak').html(formJumlahAnak);
                    }else{
                        $('#contain_jumlah_anak').html('');
                    }
                });
            }else{
                $('#contain_status_nikah').html('');
                $('#contain_jumlah_anak').html('');
            }
        });


    });
</script>
