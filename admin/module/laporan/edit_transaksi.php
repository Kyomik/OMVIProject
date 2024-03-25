<?php
session_start();

if (!isset($_SESSION['akun']) || $_SESSION['akun']['hak_access'] != 1) {
    header("Location: login.php");
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_transaksi = $_POST['data_transaksi'];
    foreach ($data_transaksi as $transaksi) {

    }

    header("Location: transaksi.php");
    exit(); 
}
?>
