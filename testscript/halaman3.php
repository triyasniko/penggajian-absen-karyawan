<?php
    session_start();
    
    echo $_SESSION['namalengkap'];
    echo "<br>";
    echo $_SESSION['umur'];
    echo "<br>";
    echo $_SESSION['alamat'];
    echo "<br>";
    echo $_SESSION['hobi'];
    echo "<br>";
?>
<h1>Ini halaman 3</h1>
<a href="halaman1.php">Ke Halaman 1</a>
<a href="halaman2.php">Ke Halaman 2</a>
<a href="halaman3.php">Ke Halaman 3</a>