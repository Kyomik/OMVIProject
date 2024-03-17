<h3>Dashboard</h3>
<br/>
<?php 
   
	// $sql=" select * from barang where stok <= 3";
	// $row = $config -> prepare($sql);
	// $row -> execute();
	// $r = $row -> rowCount();
	// if($r > 0){
?>
<?php
	// 	echo "
	// 	<div class='alert alert-warning'>
	// 		<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
	// 		<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
	// 	</div>
	// 	";	
	// }
?>
<?php 
// $hasil_barang = $lihat -> barang_row();
?>

<?php 
// $hasil_kategori = $lihat -> kategori_row();
?>

<?php 
// $stok = $lihat -> barang_stok_row();
?>

<?php 
// $jual = $lihat -> jual_row();
?>
<div class="row">
    <!--STATUS cardS -->
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Custamer</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang);?>1</h1>
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
    
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Data Item</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($stok['jml']);?>5</h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>
                    Item <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div>
    <!-- /col-md-3-->
    <!-- STATUS cardS -->
   
    
</div>