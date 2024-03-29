<?php

session_start();
if (isset($_SESSION['akun'])) {
    if($_SESSION['akun']['hak_access'] == 1){
        require "./../../../config.php";
        $config->beginTransaction();

        try{
            $id_transaksi = $_POST['id_transaksi'];
            $total_harga = $_POST['total_harga'];
            $id_items = "";
            
            if(isset($_POST['id_item']))
                $id_items = implode(",", array_map('intval', $_POST["id_item"]));
            else
                $id_items = "";

            // // Persiapkan pernyataan DELETE dengan klausa WHERE NOT IN

            $sqlUpdate = "UPDATE transaksi 
                        SET total_harga = :total_harga
                        WHERE id_transaksi = :id_transaksi";
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
            $stmtUpdate = $config->prepare($sqlUpdate);

            // // Bind parameter untuk klausa WHERE pada pernyataan DELETE
            $stmtDelete->bindParam(':id_transaksi', $id_transaksi);
            $stmtUpdate->bindParam(':id_transaksi', $id_transaksi);
            $formated = str_replace(',', '', $total_harga);
            $stmtUpdate->bindParam(':total_harga', $formated);
            // // Eksekusi pernyataan DELETE
            $stmtDelete->execute();
            $stmtUpdate->execute();

            foreach ($_POST["tgl_lama"] as $index => $tgl) {
                $id_item = $_POST["id_item"][$index];
                $nama_barang = $_POST["nama_barang_lama"][$index];
                $jumlah = $_POST["jumlah_lama"][$index];
                $harga = $_POST["harga_lama"][$index];

                $stmtEdit->bindParam(':nama_barang', $nama_barang);
                $stmtEdit->bindParam(':jumlah', $jumlah);
                $formated = str_replace(',', '', $harga);
                $stmtEdit->bindParam(':harga', $formated);
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
                $formated = str_replace(',', '', $harga);
                $stmtAdd->bindParam(4, $formated);
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
    }
} else {
    echo "Anda tidak memiliki izin untuk melakukan tindakan ini.";
}


?>