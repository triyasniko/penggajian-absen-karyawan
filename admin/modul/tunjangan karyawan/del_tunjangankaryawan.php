<?php
// menangkap data id yang di kirim dari url
$id = $_GET['id'];
var_dump($id);
exit();

// menghapus data dari database
mysqli_query($koneksi, "DELETE FROM tb_tunjangankaryawan WHERE id_tunjangankaryawan='$id'") or die(mysqli_error($koneksi));

// mengalihkan halaman kembali ke index.php
echo " <script>
      alert('Data Berhasil Dihapus !');
      window.location='?page=tunjangankaryawan';
      </script>";
