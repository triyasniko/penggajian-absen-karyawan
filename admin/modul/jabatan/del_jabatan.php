<?php
// menangkap data id yang di kirim dari url
$id = $_GET['id_jabatan'];

// menghapus data dari database
mysqli_query($koneksi, "DELETE FROM tb_jabatan WHERE id_jabatan='$id'")or die(mysqli_error($koneksi));

// mengalihkan halaman kembali ke index.php
echo " <script>
      alert('Data Berhasil Dihapus !');
      window.location='?page=jabatan';
      </script>";
