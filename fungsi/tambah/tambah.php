<?php

session_start();
// if (!empty($_SESSION['admin'])) {
    require '../../config.php';

    if (!empty($_GET['akun'])) {

      
        $nama = htmlentities($_POST['nama']);
        $no_telp = htmlentities($_POST['no_telp']);
        $hak_access = htmlentities($_POST['hakAkses']);
        // $gambar = htmlentities($_POST['gambar']);
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $password = hash('sha256', $password); 
       
        try {
            // Mulai transaksi
            $config->beginTransaction();
        
            // Query SQL untuk menyisipkan data ke dalam tabel akun
            $sql_insert_akun = "INSERT INTO akun (nama, no_telp, hak_access) VALUES (:nama, :no_telp, :hak_access)";
            $stmt_akun = $config->prepare($sql_insert_akun);
            $stmt_akun->bindParam(':nama', $nama);
            $stmt_akun->bindParam(':no_telp', $no_telp);
            $stmt_akun->bindParam(':hak_access', $hak_access);
            $stmt_akun->execute();
        
            // Ambil ID akun yang baru saja dimasukkan
            $id_akun_baru = $config->lastInsertId();
        
            // Query SQL untuk menyisipkan data ke dalam tabel login
            $sql_insert_login = "INSERT INTO login (username, password, id_akun) VALUES (:username, :password, :id_akun)";
            $stmt_login = $config->prepare($sql_insert_login);
            $stmt_login->bindParam(':username', $username);
            $stmt_login->bindParam(':password', $password);
            $stmt_login->bindParam(':id_akun', $id_akun_baru);
            $stmt_login->execute();
        
            // Commit transaksi
            $config->commit();
        
            echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
        } catch (PDOException $e) {
            // Rollback transaksi jika terjadi kesalahan
            $config->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
    
    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];

        // get tabel barang id_barang
        $sql = 'SELECT * FROM barang WHERE id_barang = ?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        $hsl = $row->fetch();

        if ($hsl['stok'] > 0) {
            $kasir =  $_GET['id_kasir'];
            $jumlah = 1;
            $total = $hsl['harga_jual'];
            $tgl = date("j F Y, G:i");

            $data1[] = $id;
            $data1[] = $kasir;
            $data1[] = $jumlah;
            $data1[] = $total;
            $data1[] = $tgl;

            $sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
            $row1 = $config -> prepare($sql1);
            $row1 -> execute($data1);

            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }
// }
