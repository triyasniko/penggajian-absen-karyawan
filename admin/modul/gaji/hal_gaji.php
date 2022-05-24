<?php
    $tgl = date('Y-m-d');
    $bulan = date('m');

    if(isset($_POST["btnCariKaryawan"])){
       
        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_karyawan"));
    
        if ($cek == 0) {
            echo "<script>window.alert('Data Karyawan Kosong')
            window.location='?page=gaji&act=add'</script>";
        } else {
            $queryAllKaryawan = mysqli_query($koneksi, "SELECT * FROM tb_karyawan");
            while($row = mysqli_fetch_assoc($queryAllKaryawan)) {
                $kodeKaryawan = $row['kode_karyawan'];
                $idKaryawan = $row['id_karyawan'];
                $statusKaryawan = $row['status_karyawan'];
                $jabatan = mysqli_query($koneksi, "SELECT * FROM tb_karyawan
                        INNER JOIN tb_jabatan ON tb_karyawan.id_jabatan=tb_jabatan.id_jabatan WHERE kode_karyawan='$kodeKaryawan'");
                $resJabatan = mysqli_fetch_assoc($jabatan);
            
        
                $queryTunjangan = mysqli_query($koneksi, "SELECT SUM(jumlah_tunjangan) as tunjangan FROM tb_tunjangan INNER JOIN tb_tunjangankaryawan ON tb_tunjangan.id_tunjangan = tb_tunjangankaryawan.id_tunjangan WHERE id_karyawan='$idKaryawan' ");
                $row_tunjangan = mysqli_fetch_array($queryTunjangan);
                $tunjangan = $row_tunjangan['tunjangan'];
                $total = $row_tunjangan['tunjangan'];
                
                if($statusKaryawan == "harian"){
                    $gapok = 0;
                }else{
                    $gapok = $b['gapok'];
                }
        
                $query_lembur = mysqli_query($koneksi, "SELECT * FROM tb_absenkaryawan WHERE id_karyawan='$idKaryawan' AND MONTH(tgl_absensi)='$bulan' AND status_absensi='hadir'");
                while($row_lembur = mysqli_fetch_assoc($query_lembur)){
                                                        
                    if(mysqli_num_rows($query_lembur)>0){
                        $total_jam_lembur+=$row_lembur['jam_lembur'];
                    }else{
                        $total_jam_lembur=0;
                    }
                }
                $jumlah_upah_lembur = $total_jam_lembur*17000;                                  
            
                
                $tgl_gaji = $tgl;
                $id = $idKaryawan;
                $total_gaji=$gapok+$tunjangan+$jumlah_upah_lembur;

                //query INSERT disini
                $save = mysqli_query($koneksi, "INSERT INTO tb_gaji (tgl_gaji,id_karyawan,gapok,tunjangan,bonus,total_jam_lembur,jumlah_upah_lembur,total_gaji)  
                VALUES('$tgl_gaji','$id','$gapok','$tunjangan','$bonus','$total_jam_lembur','$jumlah_upah_lembur','$total_gaji')") or die(mysqli_error($koneksi));

                // if ($save) {
                //     echo " <script>
                //         alert('Data Berhasil disimpan !');
                //         window.location='?page=gaji';
                //     </script>";
                // }
                echo $save;

            }
        }
    } 


?>