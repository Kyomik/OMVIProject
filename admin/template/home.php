<h3>Dashboard</h3>
<br/>

<?php 
    
    $query_transaksi = "SELECT COUNT(*) AS jumlah_transaksi FROM TRANSAKSI";
    $statement_transaksi = $config->query($query_transaksi);
    $result_transaksi = $statement_transaksi->fetch(PDO::FETCH_ASSOC);
    $jumlah_transaksi = $result_transaksi['jumlah_transaksi'];
    
?>


<?php 
// $trw = $lihat -> transaksi_stok_row();
?>

<div class="row" >
    <!--STATUS cardS -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Custamer</h6>
            </div>
            <div class="card-body" style="height:120px;" >
                <center>
                    <h1><?php echo number_format($jumlah_customer);?>1</h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel
                    Custamer <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Data Teransaksi</h6>
            </div>
            <div class="card-body" style="height:120px;">
                <center>
                    <h1><?php echo number_format($jumlah_transaksi); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>
                    Item <i class='fa fa-angle-double-right'></i></a>
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
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Chart</h6>
            </div>
            <div class="card-body" style="height: 400px;"> 
                <div class="chart-bar" style="height: 100%;">

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="monthlyProfitChart" width="700" height="200"></canvas>
                        <script>
                            // Assume monthly profit data is retrieved from PHP
                            const monthlyProfits = [2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500];

                            // Months array for labeling x-axis
                            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                            // Generate random colors for each bar
                            function generateRandomColor() {
                                return '#' + Math.floor(Math.random()*16777215).toString(16);
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







