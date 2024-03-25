<?php
// if (isset($_SESSION['akun']['hak_access'])) {
    // if($_SESSION['akun']['hak_access'] == 1){
        require "./../../../config.php";
        $config->beginTransaction();

        try{
            $id_transaksi = $_POST['id_transaksi'];
            $id_items = "";
            
            if(isset($_POST['id_item']))
                $id_items = implode(",", array_map('intval', $_POST["id_item"]));
            else
                $id_items = "";

            // // Persiapkan pernyataan DELETE dengan klausa WHERE NOT IN
            $sqlDelete = "DELETE FROM item 
                         WHERE id_transaksi = :id_transaksi AND id_item NOT IN ($id_items)";
            $sqlEdit = "UPDATE item 
                    SET nama = :nama_barang, jumlah = :jumlah, harga = :harga, tgl = :tgl
                    WHERE id_item = :id_item";
            $sqlAdd = "INSERT INTO item (tgl, id_transaksi, nama, harga, jumlah) VALUES (?, ?, ?, ?, ?)";
            
            // echo "$sqlDelete <br> $sqlEdit <br> $sqlAdd";             
            $stmtDelete = $config->prepare($sqlDelete);
            $stmtEdit = $config->prepare($sqlEdit);
            $stmtAdd = $config->prepare($sqlAdd);

            // // Bind parameter untuk klausa WHERE pada pernyataan DELETE
            $stmtDelete->bindParam(':id_transaksi', $id_transaksi);

            // // Eksekusi pernyataan DELETE
            $stmtDelete->execute();

            foreach ($_POST["tgl_lama"] as $index => $tgl) {
                $id_item = $_POST["id_item"][$index];
                $nama_barang = $_POST["nama_barang_lama"][$index];
                $jumlah = $_POST["jumlah_lama"][$index];
                $harga = $_POST["harga_lama"][$index];

                $stmtEdit->bindParam(':nama_barang', $nama_barang);
                $stmtEdit->bindParam(':jumlah', $jumlah);
                $stmtEdit->bindParam(':harga', $harga);
                $stmtEdit->bindParam(':id_item', $id_item);
                $stmtEdit->bindParam(':tgl', $tgl);
                $stmtEdit->execute();
            }

            foreach ($_POST["tgl"] as $index => $tgl) {
                $nama_barang = $_POST["nama_barang"][$index];
                $jumlah = $_POST["jumlah"][$index];
                $harga = $_POST["harga"][$index];

                $stmtAdd->bindParam(1, $tgl);
                $stmtAdd->bindParam(2, $id_transaksi);
                $stmtAdd->bindParam(3, $nama_barang);
                $stmtAdd->bindParam(4, $harga);
                $stmtAdd->bindParam(5, $jumlah);
                $stmtAdd->execute();
            }

            $config->commit();

            echo '<script>window.location="' . BASE_URL . 'index.php?page=laporan&report=success&id=' . $id_transaksi . '"</script>';
        } catch (PDOException $e) {
        // Rollback transaction if any error occurs
        $config->rollback();
        die("Error: " . $e->getMessage());
    } finally {
        // Close statements
        $stmtDelete = null;
        $stmtAdd = null;
        $stmtEdit = null;
    }
    // }
    

// } else {
//     echo "Anda tidak memiliki izin untuk melakukan tindakan ini.";
// }


?>