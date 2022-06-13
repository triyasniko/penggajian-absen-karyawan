<h2>Add gaji 2</h2>
<?php 
    $bulan = date('m');
    if(isset($_POST['btnAddGaji'])){
        $queryAbsen=mysqli_query($koneksi, "SELECT * FROM tb_absenkaryawan WHERE MONTH(tgl_absensi)='$bulan' AND status_absensi='hadir' ");
        $row=mysqli_fetch_array($queryAbsen);
        var_dump($row);

        
    }
?>