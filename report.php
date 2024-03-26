<?php
	require_once "vendor/autoload.php";

	 use Dompdf\Dompdf;
	 use Dompdf\Options;

		if(isset($_GET['id'])){
			$id_transaksi = $_GET['id'];
			require_once 'config.php';
			require_once 'template-report.php';
			try{
				$sql = "SELECT t.id_transaksi, t.tgl_input, t.tgl_priode, t.total_harga, COUNT(i.id_item) AS jumlah_item, GROUP_CONCAT(CONCAT(i.nama, ',', i.tgl, ',', i.harga, ',', i.jumlah) SEPARATOR '|') AS all_items, c.nama AS nama_customer, c.negara AS negara_customer, c.no_telp AS no_telp_customer, a.nama AS nama_akun, a.negara AS negara_akun, a.no_telp AS no_telp_akun
        FROM transaksi t
        INNER JOIN item i ON t.id_transaksi = i.id_transaksi
        INNER JOIN akun a ON t.id_akun = a.id_akun
        INNER JOIN customer c ON t.id_customer = c.id_customer 
        WHERE t.id_transaksi = :id_transaksi";
        
				// Siapkan statement PDO
				$stmt = $config->prepare($sql);

				// Bind parameter
				$stmt->bindParam(':id_transaksi', $id_transaksi, PDO::PARAM_INT);

				// Eksekusi statement
				$stmt->execute();
				$hasil = $stmt->fetchAll();
				$html = getTemplate($hasil[0]['id_transaksi'], $hasil[0]['tgl_input'], $hasil[0]['tgl_priode'], $hasil[0]['total_harga'], $hasil[0]['nama_customer'], $hasil[0]['negara_customer'], $hasil[0]['no_telp_customer'], $hasil[0]['nama_akun'], $hasil[0]['negara_akun'], $hasil[0]['no_telp_akun'], $hasil[0]['all_items']);		

				// $dompdf = new Dompdf();
				$options = new Options();
				$options->set('isRemoteEnabled', true);
				$dompdf = new Dompdf($options);
				$dompdf->loadHtml($html);



				$dompdf->render();
			// // Output the generated PDF to Browser
				$dompdf->stream();
						} catch (PDOException $e) {
			    // Tangani kesalahan
						    echo "Error: " . $e->getMessage();
						}
		}
		// error_reporting(E_ALL);
		// ini_set('display_errors', '1');
		// $imageData = file_get_contents("http://localhost" . BASE_URL . "travelnew.png");
		// var_dump($http_response_header);
?>