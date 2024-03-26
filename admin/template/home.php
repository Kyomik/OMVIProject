  
    <!-- Tambahkan Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- Tambahkan html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <!-- Tambahkan jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <h4>Dashboard</h4>
    

    <?php 
        $hak_access = $_SESSION['akun']['hak_access'];

        try {
            $query_akun = "SELECT COUNT(*) AS jumlah_akun FROM akun"; 
            $statement_akun = $config->query($query_akun);
            $result_akun = $statement_akun->fetch(PDO::FETCH_ASSOC);
            $jumlah_akun = $result_akun['jumlah_akun'];
        } catch (PDOException $e) {
            echo 'error:' . $e->getMessage();
        }

        // Query untuk mengambil jumlah customer
        try {
            $query_customer = "SELECT COUNT(DISTINCT nama) AS jumlah_customer FROM customer";
            $statement_customer = $config->query($query_customer);
            $result_customer = $statement_customer->fetch(PDO::FETCH_ASSOC);
            $jumlah_customer = $result_customer['jumlah_customer'];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        // Query untuk mengambil jumlah transaksi
        try {
            $query_transaksi = "SELECT COUNT(total_harga) AS jumlah_transaksi, SUM(total_harga) AS total_harga FROM TRANSAKSI";
            $statement_transaksi = $config->query($query_transaksi);
            $result_transaksi = $statement_transaksi->fetch(PDO::FETCH_ASSOC);
            $jumlah_transaksi = $result_transaksi['jumlah_transaksi'];

            if ($result_transaksi && isset($result_transaksi['total_harga'])){
                $total_harga = $result_transaksi['total_harga'];                
            }  
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        function getMonthlyTransactionTotals($year, $config) {
            try {
                $monthlyTotals = array();
                for ($i = 1; $i <= 12; $i++) {
                    $query = "SELECT SUM(total_harga) AS total FROM TRANSAKSI WHERE YEAR(tgl_priode) = ? AND MONTH(tgl_priode) = ?";
                    $statement = $config->prepare($query);
                    $statement->execute([$year, $i]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    $monthlyTotals[] = $result['total'] ? intval($result['total']) : 0;

                    
                }
                return $monthlyTotals;
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                return array(); 
            }
        
    }
    ?>

    <div class="row">
        <?php 
            if ($hak_access == 1) {
                echo '<div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Admin</h6>
                            </div>
                            <div class="card-body" style="height:120px;">
                                <center>
                                    <h1>' . number_format($jumlah_akun) . '</h1>
                                </center>
                            </div>
                            <div class="card-footer">
                            <a href="index.php?page=barang">Tabel Akun <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        </div>
                    </div>';
                echo '<div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Customer</h6>
                            </div>
                            <div class="card-body" style="height:120px;">
                                <center>
                                    <h1>' . number_format($jumlah_customer) . '</h1>
                                </center>
                            </div>
                            <div class="card-footer">
                            <a href="index.php?page=jual"> Data Customer <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>';   

                echo '<div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6 class="pt-2"><i class="fa-brands fa-slack"></i> Data Transaksi</h6>
                            </div>
                            <div class="card-body" style="height:120px;">
                                <center>
                                    <h1>' . number_format($jumlah_transaksi) . '</h1>
                                </center>
                            </div>
                            <div class="card-footer">
                            <a href="index.php?page=laporan">Tabel Transaksi <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        </div>
                    </div>';
            }
        if ($hak_access == 0){
            echo '<div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Customer</h6>
                        </div>
                        <div class="card-body" style="height:120px;">
                            <center>
                                <h1>' .  number_format($jumlah_customer) . '</h1>
                            </center>
                        </div>
                    </div>
                </div>';


            echo '<div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h6 class="pt-2"><i class="fa-brands fa-slack"></i> Data Transaksi</h6>
                        </div>
                        <div class="card-body" style="height:120px;">
                            <center>
                                <h1>' . number_format($jumlah_transaksi) . '</h1>
                            </center>
                        </div>
                    </div>
                </div>';

        }
        ?>
    </div>



    <!-- Chart -->
    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card shadow mb-4" style="width: 100%;">
                <div class="card-header bg-success text-white">
                    <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Chart</h6>
                </div>
                <div class="card-body" style="height: 400px;"> 
                    <div class="chart-bar" style="height: 100%;">
                    
                        <div class="col-md-12 mb-2 mt-2">
                            <h6 class="text-center" style="margin-top: -10px;">Data Chart <span id="yearLabel"><?php echo $jumlah_customer ?></span></h6> 
                        </div><br>

                        <!-- ini untuk tahun -->
                        <div class="col-md-2 mb-2" style="margin-left: auto; margin-top: -115px;">
                            <td>
                            <select class="form-control" id="selectedYear" name="selectedYeart" onchange="updateChart()">
                                <?php
                                $startYear = 2023; 
                                $endYear = $startYear + 5; 
                                for ($year = $startYear; $year <= $endYear; $year++) {
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                                
                            </select>
                            </td>
                        </div>
                        <div style="margin-top: 50px;">
                            <canvas id="monthlyProfitChart" width="700" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        new Chart("monthlyProfitChart", {
            type: "bar",
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Monthly Profit',
                    backgroundColor: '#ADFF2F', 
                    data: <?php echo json_encode(getMonthlyTransactionTotals($startYear, $config)); ?>
                }]
            },
            
            options: {
                legend: {
                    display: false
                },  
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 120000000, 
                            stepSize: 10000000, 
                            callback: function(value, index, values) {
                                return (value / 1000000 ).toFixed(0) + ' juta'; 
                            }
                        }
                    }]
                }
            }
        });

        // Function to update chart based on selected year
        function updateChart() {
            const selectedYear = document.getElementById("selectedYeart").value;
            const monthlyProfits = <?php echo json_encode(getMonthlyTransactionTotals("selectedYeart", $config)); ?>;
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            const chart = Chart.getChart("monthlyProfitChart");
            chart.data.labels = months;
            chart.data.datasets[0].data = monthlyProfits;
            chart.update();
        }
    
   
</script>

