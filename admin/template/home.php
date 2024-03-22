
<h3>Dashboard</h3>
<br/>

<?php 
    
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
    $query_transaksi = "SELECT COUNT(*) AS jumlah_transaksi FROM TRANSAKSI";
    $statement_transaksi = $config->query($query_transaksi);
    $result_transaksi = $statement_transaksi->fetch(PDO::FETCH_ASSOC);
    $jumlah_transaksi = $result_transaksi['jumlah_transaksi'];
    


} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}


// Tutup koneksi database
$config = null;
    
?>



<div class="row" >
    <!--STATUS cardS -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Custamer</h6>
            </div>
            <div class="card-body" style="height:120px;" >
                <center >
                    <h1><?php echo number_format($jumlah_customer); ?></h1>
                </center>
            </div>
           
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa-brands fa-slack"></i> Data Teransaksi</h6>
            </div>
            <div class="card-body" style="height:120px;">
                <center>
                    <h1><?php echo number_format($jumlah_transaksi); ?></h1>
                </center>
            </div>
           
        </div>
    </div>
    <!-- /col-md-3-->  

</div>


  <!-- cart -->
  <div class="row ">
    <div class="col-xl-12 col-lg-8">
        <!-- Bar Chart -->
        <div class="card shadow mb-4" style="width: 100%;">
            <div class="card-header bg-primary text-white" >
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Chart</h6>               
            </div>
            <div class="card-body" style="height: 400px;"> 
                <div class="chart-bar" style="height: 100%;">
               
                        <div class="col-md-2 mb-2" style="margin-left: auto; margin-top: -70px;" >
                            <td>
                                <select class="form-control" id="#" name="#">
                                    <option  value="#">2023</option>
                                    <option  value="#">2024</option>
                                    <option value="#">2025</option>
                                    <option  value="#">2026</option>
                                    <option  value="#">2027</option>
                                    <option value="#">2028</option>
                                    
                                </select>
                            </td>

                        </div>
                        
                        <div style="margin-top: 50px;">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                            <canvas id="monthlyProfitChart" width="700" height="230"></canvas>
                            <script>
                                // Assume monthly profit data is retrieved from PHP
                                const monthlyProfits = [<?php echo "90000" ?>, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500];


                                // Months array for labeling x-axis
                                const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                                // Generate random colors for each bar
                                function generateRandomColor() {
                                    return '#' + Math.floor(Math.random()*1777215).toString(16);
                                }
                                const barColors = monthlyProfits.map(() => generateRandomColor());

                                // Create Chart.js instance
                                new Chart("monthlyProfitChart", {
                                    type: "bar",
                                    data: {
                                        labels: months,
                                        datasets: [{
                                            label: 'Monthly Profit',
                                            backgroundColor: barColors,
                                            data: monthlyProfits
                                        }]
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                        // title: {
                                        //     display: true,
                                        //     text: 'Monthly Profit'
                                        // },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>







