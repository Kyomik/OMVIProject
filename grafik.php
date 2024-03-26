<?php 
    header('Content-Type: application/json');

	if(isset($_GET['year'])){
        require "config.php";

        $year = $_GET['year'];

        try {
            $monthlyTotals = array();
            for ($i = 1; $i <= 12; $i++) {
                $query = "SELECT SUM(total_harga) AS total FROM TRANSAKSI WHERE YEAR(tgl_input) = ? AND MONTH(tgl_input) = ?";
                $statement = $config->prepare($query);
                $statement->execute([$year, $i]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $monthlyTotals[] = $result['total'] ? intval($result['total']) : 0;
            }

            $monthlyTotals[] = $query;

            echo json_encode($monthlyTotals);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return array(); 
        }
		
    }
?>