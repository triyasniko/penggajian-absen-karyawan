<?php
session_start();
unset($_SESSION['Admin']);
session_destroy();
echo "<script>window.location='../index.php';</script>";
