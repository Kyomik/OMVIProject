<?php

session_start();

// if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    // if (!empty(htmlentities($_GET['kategori']))) {
    //     $id= htmlentities($_GET['id']);
    //     $data[] = $id;
    //     $sql = 'DELETE FROM kategori WHERE id_kategori=?';
    //     $row = $config -> prepare($sql);
    //     $row -> execute($data);
    //     echo '<script>window.location="../../index.php?page=kategori&&remove=hapus-data"</script>';
    // }

    if(isset($_GET['akun']) && $_GET['akun'] == 'hapus' && isset($_GET['id'])) {
        // Ambil ID akun yang akan dihapus
        $id_akun = $_GET['id'];
    
        try {
            // Buat query untuk menghapus login yang terkait dengan akun
            $sql_delete_login = "DELETE FROM login WHERE id_akun = :id_akun";
            $stmt_delete_login = $config->prepare($sql_delete_login);
            $stmt_delete_login->bindParam(':id_akun', $id_akun, PDO::PARAM_INT);
            
            // Jalankan query penghapusan login terlebih dahulu
            $stmt_delete_login->execute();
    
            // Setelah menghapus login yang terkait, baru hapus akun
            $sql_delete_akun = "DELETE FROM akun WHERE id_akun = :id_akun";
            $stmt_delete_akun = $config->prepare($sql_delete_akun);
            $stmt_delete_akun->bindParam(':id_akun', $id_akun, PDO::PARAM_INT);
            
            // Jalankan query penghapusan akun
            $stmt_delete_akun->execute();
            
            // Redirect kembali ke halaman utama dengan parameter remove untuk menampilkan pesan sukses
            echo '<script>window.location="../../index.php?page=barang&&remove=hapus-data"</script>';
            exit();
        } catch(PDOException $e) {
            // Jika terjadi kesalahan, tampilkan pesan error
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Jika tidak ada parameter yang diberikan, redirect kembali ke halaman utama
        header("Location: ../index.php");
        exit();
    }
        
    

    if (!empty(htmlentities($_GET['jual']))) {
        $dataI[] = htmlentities($_GET['brg']);
        $sqlI = 'select*from barang where id_barang=?';
        $rowI = $config -> prepare($sqlI);
        $rowI -> execute($dataI);
        $hasil = $rowI -> fetch();

        /*$jml = htmlentities($_GET['jml']) + $hasil['stok'];

        $dataU[] = $jml;
        $dataU[] = htmlentities($_GET['brg']);
        $sqlU = 'UPDATE barang SET stok =? where id_barang=?';
        $rowU = $config -> prepare($sqlU);
        $rowU -> execute($dataU);*/

        $id = htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty(htmlentities($_GET['penjualan']))) {
        $sql = 'DELETE FROM penjualan';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }
    
    if (!empty(htmlentities($_GET['laporan']))) {
        $sql = 'DELETE FROM nota';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=laporan&remove=hapus"</script>';
    }

