<?php
    session_start();
if (isset($_SESSION['akun'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "./../../../config.php";

        $id_akun = $_SESSION['akun']['id_akun'];
        // Validasi input
        // $required_fields = ['tgl_input', 'tgl_priode', 'id_akun', 'total_harga', 'nama', 'no_telp', 'negara', 'nama_barang'];
        // foreach ($required_fields as $field) {
        //     if (empty($_POST[$field])) {
        //         die("Error: $field is required.");
        //     }
        // }

        // Begin transaction
        $config->beginTransaction();

        try {
            $sql_akun = "UPDATE akun SET negara = ? WHERE id_akun = ?";
            $stmt_akun = $config->prepare($sql_akun);
            $negara_akun = $_POST["negara_akun"];
            $stmt_akun->bindParam(1, $negara_akun);
            $stmt_akun->bindParam(2, $id_akun);
            $stmt_akun->execute();
     
            // Insert customer data
            $sql_customer = "INSERT INTO customer (nama, no_telp, negara) VALUES (?, ?, ?)";
            $stmt_customer = $config->prepare($sql_customer);
            $nama = $_POST["nama"];
            $no_telp = $_POST["no_telp"];
            $negara_customer = $_POST["negara_customer"];
            $stmt_customer->bindParam(1, $nama);
            $stmt_customer->bindParam(2, $no_telp);
            $stmt_customer->bindParam(3, $negara_customer);
            $stmt_customer->execute();
            $last_customer_id = $config->lastInsertId();

            // Insert transaction data
            $sql_transaction = "INSERT INTO transaksi (tgl_input, tgl_priode, id_akun, total_harga, id_customer) VALUES (?, ?, ?, ?, ?)";
            $stmt_transaction = $config->prepare($sql_transaction);
            $tgl_input = $_POST["tgl_input"];
            $tgl_priode = $_POST["tgl_priode"];
            $total_harga = $_POST["total_harga"];
            $stmt_transaction->bindParam(1, $tgl_input);
            $stmt_transaction->bindParam(2, $tgl_priode);
            $stmt_transaction->bindParam(3, $id_akun);
            $stmt_transaction->bindParam(4, $total_harga);
            $stmt_transaction->bindParam(5, $last_customer_id);
            $stmt_transaction->execute();
            $last_transaction_id = $config->lastInsertId();
            // $last_transaction_id = "tes";

            // Insert item data
            $sql_item = "INSERT INTO item (tgl, id_transaksi, nama, harga, jumlah) VALUES (?, ?, ?, ?, ?)";
            $stmt_item = $config->prepare($sql_item);

            // $items_data = array();

            // Iterate through each item data
            foreach ($_POST["tgl"] as $index => $tgl) {
                // Assign values to parameters
                $id_transaksi = $last_transaction_id;
                $nama = $_POST["nama_barang"][$index];
                $harga = $_POST["harga"][$index];
                $jumlah = $_POST["jumlah"][$index];
                // $item = [$tgl, $nama, $harga, $jumlah];
               
                // array_push($items_data, $item);
                // Execute prepared statement
                $stmt_item->bindParam(1, $tgl);
                $stmt_item->bindParam(2, $id_transaksi);
                $stmt_item->bindParam(3, $nama);
                $stmt_item->bindParam(4, $harga);
                $stmt_item->bindParam(5, $jumlah);
                $stmt_item->execute();
            }

        // Commit transaction
            $config->commit();

            // $customer_data = array(
            //     'nama' => $nama,
            //     'no_telp' => $no_telp,
            //     'negara' => $negara_costumer
            // );
            // $akun_data = array(
            //     'negara' => $negara_akun
            // );
            // $transaksi_terakhir = array(
            //     'id_transaksi' => $last_transaction_id,
            //     'tgl_input' => $tgl_input,
            //     'tgl_priode' => $tgl_priode,
            //     'total_harga' => $total_harga,
            //     'customer_data' => $customer_data,
            //     'akun_data' => $akun_data,
            //     'items_data' => $items_data
            // );

            // $cookie_value = json_encode($transaksi_terakhir);

            echo '<script>window.location="' . BASE_URL . 'index.php?page=laporan&report=success&id=' . $last_transaction_id . '"</script>';
        } catch (PDOException $e) {
            // Rollback transaction if any error occurs
            $config->rollback();
            die("Error: " . $e->getMessage());
        } finally {
            // Close statements
            $stmt_customer = null;
            $stmt_transaction = null;
            $stmt_item = null;
        }
    }
    // Close connection
}

?>