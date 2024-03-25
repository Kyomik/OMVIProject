<?php
session_start();
// if (!empty($_SESSION['admin'])) {
    require '../../config.php';

    if (isset($_GET['akun']) ) {
        $id_akun = htmlentities($_POST['id']);
        $nama = htmlentities($_POST['nama']);
        $no_telp = htmlentities($_POST['no_telp']); 
        $hak_access = htmlentities($_POST['hak_access']); 
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $password = hash('sha256', $password);
        try {
            $config->beginTransaction();
        
            // Update tabel akun
            $sql_akun = "UPDATE akun SET nama=:nama, no_telp=:no_telp, hak_access=:hak_access WHERE id_akun=:id_akun";
            $stmt_akun = $config->prepare($sql_akun);
            $stmt_akun->bindParam(':nama', $nama);
            $stmt_akun->bindParam(':no_telp', $no_telp);
            $stmt_akun->bindParam(':hak_access', $hak_access);
            $stmt_akun->bindParam(':id_akun', $id_akun);
            $stmt_akun->execute();
        
            // Update tabel login
            $sql_login = "UPDATE login SET password=:password WHERE id_akun=:id_akun";
            $stmt_login = $config->prepare($sql_login);
            $stmt_login->bindParam(':password', $password);
            $stmt_login->bindParam(':id_akun', $id_akun);
            $stmt_login->execute();
        
            $config->commit();
        
            // Arahkan pengguna ke halaman lain setelah proses selesai
            echo '<script>window.location="../../index.php?page=barang/edit&akun='.$id_akun.'&success=edit-data"</script>';
            exit();
        } catch (PDOException $e) {
            $config->rollBack();
            echo "Error: " . $e->getMessage();
        }
    } // ini untuk edit foto    
    else {
        if (isset($_GET['profile'])){
            $id_akun = $_POST['id_akun'];
            $dir = '../../assets/img/user/';
            $file_name = $_FILES['gambar']['name'];
            $file_size = $_FILES['gambar']['size'];
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $file_type = $_FILES['gambar']['type'];
            
            $name = time() . basename($_FILES['gambar']['name']); 
            
            if (move_uploaded_file($file_tmp, $dir.$name)) { 
                $sql = 'UPDATE akun SET gambar=?  WHERE id_akun=?';
                $stmt = $config->prepare($sql);
                $stmt->execute(array($name, $id_akun));
                
                $_SESSION['akun']['gambar'] = $file_name;
                echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
                exit;
            } else {
                echo '<script>alert("Gagal mengunggah gambar! Silakan coba lagi.");window.location="../../index.php?page=user"</script>';
                exit;
            }
        }// ini untuk endit password
         else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['password'])) {
                    $id = $_POST['id_akun'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $password = hash('sha256', $password);
                    $sql = 'UPDATE login SET username=?, password=? WHERE id_akun=?';
                    $row = $config->prepare($sql);
                    $row->execute([$username, $password, $id]);
                    echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
                }
            }
        }
    }
    
    ?>

