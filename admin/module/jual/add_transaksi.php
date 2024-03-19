<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "./../../../config.php";

    // Validasi input
    $required_fields = ['tgl_input', 'tgl_priode', 'id_akun', 'total_harga', 'nama', 'no_telp', 'negara', 'nama_barang'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die("Error: $field is required.");
        }
    }

    // Begin transaction
    $config->beginTransaction();

    try {
        // Insert customer data
        $sql_customer = "INSERT INTO customer (nama, no_telp, negara) VALUES (?, ?, ?)";
        $stmt_customer = $config->prepare($sql_customer);
        $nama = $_POST["nama"];
        $no_telp = $_POST["no_telp"];
        $negara = $_POST["negara"];
        $stmt_customer->bindParam(1, $nama);
        $stmt_customer->bindParam(2, $no_telp);
        $stmt_customer->bindParam(3, $negara);
        $stmt_customer->execute();
        $last_customer_id = $config->lastInsertId();

        // Insert transaction data
        $sql_transaction = "INSERT INTO transaksi (tgl_input, tgl_priode, id_akun, total_harga, id_customer) VALUES (?, ?, ?, ?, ?)";
        $stmt_transaction = $config->prepare($sql_transaction);
        $tgl_input = $_POST["tgl_input"];
        $tgl_priode = $_POST["tgl_priode"];
        $id_akun = $_POST["id_akun"];
        $total_harga = $_POST["total_harga"];
        $stmt_transaction->bindParam(1, $tgl_input);
        $stmt_transaction->bindParam(2, $tgl_priode);
        $stmt_transaction->bindParam(3, $id_akun);
        $stmt_transaction->bindParam(4, $total_harga);
        $stmt_transaction->bindParam(5, $last_customer_id);
        $stmt_transaction->execute();
        $last_transaction_id = $config->lastInsertId();

        // Insert item data
        $sql_item = "INSERT INTO item (tgl, id_transaksi, nama, harga, jumlah) VALUES (?, ?, ?, ?, ?)";
        $stmt_item = $config->prepare($sql_item);

        // Iterate through each item data
        foreach ($_POST["tgl"] as $index => $tgl) {
            // Assign values to parameters
            $id_transaksi = $last_transaction_id;
            $nama = $_POST["nama_barang"][$index];
            $harga = $_POST["harga"][$index];
            $jumlah = $_POST["jumlah"][$index];

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

    // Close connection
    $config = null;
}
?>
