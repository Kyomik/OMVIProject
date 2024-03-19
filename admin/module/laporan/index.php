 <?php 
	$bulan_tes =array(
		'01'=>"Januari",
		'02'=>"Februari",
		'03'=>"Maret",
		'04'=>"April",
		'05'=>"Mei",
		'06'=>"Juni",
		'07'=>"Juli",
		'08'=>"Agustus",
		'09'=>"September",
		'10'=>"Oktober",
		'11'=>"November",
		'12'=>"Desember"
	);
?>

<div class="row">
	<div class="col-md-12">
		<h4>
			<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
						<button class="btn btn-danger">RESET</button>
					</a>-->
			<?php if(!empty($_GET['cari'])){ ?>
			<!-- Data Laporan Penjualan <?= $bulan_tes[$_POST['bln']];?> <?= $_POST['thn'];?> -->
			<?php }elseif(!empty($_GET['hari'])){?>
			<!-- Data Laporan Penjualan <?= $_POST['hari'];?> -->
			<?php }else{?>
			<!-- Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?> -->
			<?php }?>
		</h4>
		<br />
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mt-2">Cari Laporan Per Bulan</h5>
			</div>
			<div class="card-body p-0">
				<form method="post" action="index.php?page=laporan&cari=ok">
					<table class="table table-striped">
						<tr>
							<th>
								Pilih Bulan
							</th>
							<th>
								Pilih Tahun
							</th>
							<th>
								Aksi
							</th>
						</tr>
						<tr>
							<td>
								<select name="bln" class="form-control">
									<option selected="selected">Bulan</option>
									<?php
								$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
								$jlh_bln=count($bulan);
								$bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
								$no=1;
								for($c=0; $c<$jlh_bln; $c+=1){
									echo"<option value='$bln1[$c]'> $bulan[$c] </option>";
								$no++;}
							?>
								</select>
							</td>
							<td>
							<?php
								$now=date('Y');
								echo "<select name='thn' class='form-control'>";
								echo '
								<option selected="selected">Tahun</option>';
								for ($a=2017;$a<=$now;$a++)
								{
									echo "<option value='$a'>$a</option>";
								}
								echo "</select>";
							?>
							</td>
							<td>
								<input type="hidden" name="periode" value="ya">
								<button class="btn btn-primary">
									<i class="fa fa-search"></i> Cari
								</button>
								<a href="index.php?page=laporan" class="btn btn-success">
									<i class="fa fa-refresh"></i> Refresh</a>

								<?php if(!empty($_GET['cari'])){?>
								
								<?php }?>
							</td>
						</tr>
					</table>
				</form>

				<form method="POST" action="index.php?page=laporan&hari=cek">
					<table class="table table-striped">
						<tr>
							<th>
								Pilih Hari
							</th>
							<th>
								Aksi
							</th>
						</tr>
						<tr>
							<td>
								<input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
							</td>
							<td>
								<input type="hidden" name="periode" value="ya">
								<button class="btn btn-primary">
									<i class="fa fa-search"></i> Cari
								</button>
								<a href="index.php?page=laporan" class="btn btn-success">
									<i class="fa fa-refresh"></i> Refresh</a>

								<?php if(!empty($_GET['hari'])){?>
									
								<?php }?>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		
         <br />
         <br />
         <!-- view barang -->

    <?php

    // require '../../config.php';

    ?>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="dataTables_length" id="example1_length">
								<label>Show 
									<select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select> 
								</label>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div id="example1_filter" class="dataTables_filter" style="float: right;">
								<label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
							</div>
						</div>
					</div>
					<?php
						try {
							$tahun_sekarang = date('Y');
						   	$sql = "SELECT t.*, COUNT(i.id_item) AS jumlah_item, GROUP_CONCAT(CONCAT(i.id_item, ',', i.nama, ',', i.tgl, ',', i.harga, ':', i.jumlah) SEPARATOR '|') AS all_items, c.nama AS nama_customer, a.nama AS nama_akun
						            FROM transaksi t
						            INNER JOIN item i ON t.id_transaksi = i.id_transaksi
						            INNER JOIN akun a ON t.id_akun = a.id_akun
						            INNER JOIN customer c ON t.id_customer = c.id_customer
						            GROUP BY t.id_transaksi
						            LIMIT 10";

						    $stmt = $config->prepare($sql);
							$stmt->execute();
						} catch(PDOException $e) {
						    // Tangani kesalahan jika query gagal dijalankan
						    echo "Query failed: " . $e->getMessage();
						}
					?>
					<table class="table table-bordered w-100 table-sm">
    					<thead>
        					<tr style="background:#DFF0D8;color:#333;">
            					<th> No</th>
            					<th> ID TRANSAKSI</th>
            					<th> TGL PEMBUATAN</th>
            					<th> TGL TEMPO</th>
            					<th> ADMIN</th>
            					<th> JUMLAH ITEM</th>
            					<th> TOTAL HARGA</th>
            					<th> AKSI</th>
        					</tr>
    					</thead>
    					<tbody>
        					<?php
        						$index = 0; 
        						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
        					?>
            				<tr>
	                			<td><?php echo $index + 1; ?></td>
	                			<td><?php echo "OMFAI" . "-" . substr($tahun_sekarang, -2) . "-" . $row['id_transaksi']; ?></td>
	               				<td><?php echo $row['tgl_input']; ?></td>
	             				<td><?php echo $row['tgl_priode']; ?></td>
	                			<td><?php echo $row['nama_akun']; ?></td>
	                			<td><?php echo $row['jumlah_item']; ?></td>
	                			<td><?php echo $row['total_harga']; ?></td>
	                			<td>
	                    			<button id="detail_<?php echo $transaksi['id_transaksi']; ?>" type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
	                        			Details
	                    			</button>
	                    			<a href="#">
	                        			<button class="btn btn-danger btn-xs">Report</button>
	                    			</a>
	                			</td>
            				</tr>
        					<?php 
        						$index++;
		        				};
		        			?>
    					</tbody>
					</table>
				</div>			
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog" style="max-width: 1750px;">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        
                        <button id="closeButton" type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 50px;">&times;</button>
                    </div>
                        <div class="modal-body">
                    	<form class="row">
                        	<div class="col-sm-6">
	                        		<div class="card-body">
										<div class="table-responsive">
				                            <table class="table table-striped bordered table-responsive" width="100%" cellspacing="0">
				                            	<tfoot>
					                                <tr>
													<label>Admin</label>
														<td><input type="text" name="nama" readonly="readonly" placeholder="ardbee" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;">
														</td>
													</tr>
												</tfoot>
				                            </table>
			                        	</div>
	                            	</div>
                        	</div>
                        	<div class="col-sm-6">
	                        		<div class="card-body">
										<div class="table-responsive">
				                            <table class="table table-striped bordered table-responsive" id="datatable" width="100%" cellspacing="0">
				                            	<tfoot>
					                                <tr>
													<label>Customer</label>
														<td><input type="text" name="nama" readonly="readonly" placeholder="ilham dongo" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;">
														</td>
													</tr>
												</tfoot>
				                            </table>
			                        	</div>
		                        	</div>
                        	</div>

                        	<div class="col-sm-12">
                        		<div id="keranjang" class="table-resposive">
                        			<table class="table bordered">
										<tr>
											<td style="width:20%;"><b>Date of Entry</b></td>
											<td><input type="date" class="form-control" readonly="readonly" name="tgl_input"></td>
										</tr>
									</table>
									<table class="table bordered">
										<tr>
											<td style="width:20%;"><b>Due Date</b></td>
											<td><input type="date" class="form-control" readonly="readonly" name="tgl_input"></td>
										</tr>
									</table>

									<div class="col-sm-12">
										<h5> Data Items 
											<button id="addButton" class="btn btn-danger float-right" hidden="hidden" type="button">
											<b> Add </b></button>
										</h5>
										<div class="card-body">
											<table class="table bordered">
												<thead>
													<tr>
														<th>Date</th>
														<th>Unit</th>
														<th>Item & Description</th>
														<th>Rate</th>
														<th>Quantity</th>
														<th>Amount</th>
														<th></th>
													</tr>
												</thead>
												<tbody class="MTbody">
													<tr>
														<td><input type="date" name="tgl"></td>
														<td><input type="text" name="tes" readonly="readonly"></td>
														<td><input type="text" name="tes" readonly="readonly"></td>
														<td><input type="text" name="tes" readonly="readonly"></td>
														<td><input type="text" name="tes" readonly="readonly"></td>
														<td><input type="text" name="tes" readonly="readonly"></td>
														<td>
															<button id="deleteButton" style="color: red; border:none; background-color:transparent; ">❌</button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
                        		</div>
                        	</div>
                        </div>
                    	</form>
                        <div class="modal-footer">
                            <button id="editButton" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit</button>
                            <button id="deleteButton" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                        </div>
                </div>
            </div>
        </div>

<script>
    var editButton = document.querySelector('#editButton');
    var addButton = document.querySelector('#addButton');
    var closeButton = document.querySelector('#closeButton');

    editButton.addEventListener('click', function() {
        addButton.hidden = false; 
    });

    closeButton.addEventListener('click', function() {
        addButton.hidden = true; 
    });

    addButton.addEventListener('click', function() {
    	console.log("ilham babi");
    });
</script>