<?php 
    session_start();

    $namalengkap="Muhammad Rizal";
    $umur="20";
    $alamat="Jl.Kaliurang";
    $hobi="Membaca";

    $_SESSION['namalengkap']=$namalengkap;
    $_SESSION['umur']=$umur;
    $_SESSION['alamat']=$alamat;
    $_SESSION['hobi']=$hobi;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Session</title>
</head>
<body>
    <p>
        <?php echo $namalengkap; ?><br>
        <?php echo $umur; ?><br>
        <?php echo $alamat; ?><br>
        <?php echo $hobi; ?><br>
    </p>
    <h1>Ini halaman 1</h1>
    <a href="halaman1.php">Ke Halaman 1</a>
    <a href="halaman2.php">Ke Halaman 2</a>
    <a href="halaman3.php">Ke Halaman 3</a>
</body>
</html>