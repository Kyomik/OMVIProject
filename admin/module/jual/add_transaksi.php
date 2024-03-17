<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "./../../../config.php";

    // Validasi input
    $required_fields = ['tgl_input', 'tgl_priode', 'id_akun', 'total_harga', 'nama', 'no_telp', 'negara'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die("Error: $field is required.");
        }
    }

    // Begin transaction
    $config->begin_transaction();

    try {
        // Insert customer data
        $sql_customer = "INSERT INTO customer (nama, no_telp, negara) VALUES (?, ?, ?)";
        $stmt_customer = $config->prepare($sql_customer);
        $stmt_customer->bind_param("sss", $_POST["nama"], $_POST["no_telp"], $_POST["negara"]);
        $stmt_customer->execute();
        $last_customer_id = $stmt_customer->insert_id;

        // Insert transaction data
        $sql_transaction = "INSERT INTO transaksi (tgl_input, tgl_priode, id_akun, total_harga) VALUES (?, ?, ?, ?)";
        $stmt_transaction = $config->prepare($sql_transaction);
        $stmt_transaction->bind_param("sssd", $_POST["tgl_input"], $_POST["tgl_priode"], $_POST["id_akun"], $_POST["total_harga"]);
        $stmt_transaction->execute();
        $last_transaction_id = $stmt_transaction->insert_id;

        // Insert item data
        $sql_item = "INSERT INTO item (tgl, id_transaksi, nama, harga, jumlah) VALUES (?, ?, ?, ?, ?)";
        $stmt_item = $config->prepare($sql_item);

        // Bind parameters
        $stmt_item->bind_param("sdsdd", $tgl, $id_transaksi, $nama, $harga, $jumlah);

        // Iterate through each item data
        foreach ($_POST["tgl"] as $index => $tgl) {
            // Assign values to parameters
            $id_transaksi = $last_transaction_id;
            $nama = $_POST["nama"][$index];
            $harga = $_POST["harga"][$index];
            $jumlah = $_POST["jumlah"][$index];

            // Execute prepared statement
            $stmt_item->execute();
        }

        // Close prepared statement for item
        $stmt_item->close();

        // Commit transaction
        $config->commit();
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $config->rollback();
        die("Error: " . $e->getMessage());
    } finally {
        // Close statements
        $stmt_customer->close();
        $stmt_transaction->close();
    }

    // Close connection
    $config->close();
}
?>
