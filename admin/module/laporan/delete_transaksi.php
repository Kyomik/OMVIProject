<?php 
if (isset($_SESSION['akun'])) {
    if($_SESSION['akun']['hak_access'] == 1){
    	if(isset($_GET['id_transaksi'])){
    		require "./../../../config.php";
	        $id_transaksi = $_GET['id_transaksi'];

	        try{
	        	$config->beginTransaction();

				$stmt_item = $config->prepare("DELETE FROM item WHERE id_transaksi = :id_transaksi");
			    $stmt_item->bindParam(':id_transaksi', $id_transaksi);
			    $stmt_item->execute();

			    // Hapus data dari tabel transaksi
			    $stmt_transaksi = $config->prepare("DELETE FROM transaksi WHERE id_transaksi = :id_transaksi");
			    $stmt_transaksi->bindParam(':id_transaksi', $id_transaksi);
			    $stmt_transaksi->execute();
			    
			    // Hapus data dari tabel customer
			    $stmt_customer = $config->prepare("DELETE FROM customer WHERE id_customer IN (SELECT id_customer FROM transaksi WHERE id_transaksi = :id_transaksi)");
			    $stmt_customer->bindParam(':id_transaksi', $id_transaksi);
			    $stmt_customer->execute();

			    // Commit transaksi jika semua operasi berhasil
			    $config->commit();

		        // Redirect to success page after deletion
		        echo '<script>window.location="' . BASE_URL . 'index.php?page=laporan&delete=success&id=' . $id_transaksi . '"</script>';
	        } catch (PDOException $e) {
		        $config->rollback();
		        die("Error: " . $e->getMessage());
		    } finally {

		    }
    	}
        
    }
    

} else {
    echo "Anda tidak memiliki izin untuk melakukan tindakan ini.";
}


?>
