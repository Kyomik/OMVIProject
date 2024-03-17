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
				
			</div>
		</div>
		</form>
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
						$sql = "SELECT t.id_transaksi, t.tgl_input, t.tgl_priode, a.nama AS admin, t.total_harga, COUNT(i.jumlah) AS jumlah_item FROM transaksi t
							INNER JOIN item i ON t.id_transaksi = i.id_transaksi
							INNER JOIN akun a ON t.id_akun = a.id_akun
							GROUP BY t.id_transaksi
							LIMIT 10";
					?>
					<table class="table table-bordered w-100 table-sm" >
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th > No</th>
								<th> ID TRANSAKSI</th>
								<th> TGL PEMBUATAN</th>
								<th> TGL TEMPO</th>
								<th> ADMIN</th>
								<th> JUMLA ITEM</th>
								<th> TOTAL HARGA</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>27</td>
								<td>03/03/2024</td>
								<td>25/03/2024</td>
								<td>Bee</td>
								<td>10</td>
								<td>Rp. 2. 500. 000</td>
								<td>
								<button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
            					Details
            					</button>
									<a href="#">
										<button class="btn btn-danger btn-xs">Report</button>
									</a>
								</td>
							</tr>
						</tbody>
							<?php 
								$no=1; 
								if(!empty($_GET['cari'])){
									$periode = $_POST['bln'].'-'.$_POST['thn'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> periode_jual($periode);
								}elseif(!empty($_GET['hari'])){
									$hari = $_POST['hari'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> hari_jual($hari);
								}else{
									$hasil = $lihat -> jual();
								}
							?>
					</table>
					<div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination" style="float:right;"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item next disabled" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
					</div>
				</div>
			</div>
			<script>
    			let data_item = [];
			</script>
		</div>
	</div>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
    	<div class="modal-dialog">
    		<!-- Modal Content -->
    		<div class="modal-content" style="border-radius:0px;">
    			<div class="modal-header" style="background:#285c64;color:#fff;">
                        <h5 class="modal-title">Details</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="admin/module/laporan/details_modal.php">
                	<div class="modal-body">
                		<table class="table table-striped bordered">
							<?php
								$format = $lihat -> nama();
							?>
								<tr>
                                    <td>Admin</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                            class="form-control" name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                            class="form-control" name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembuatan</td>
                                    <td><input type="date" class="form-control" name="tgl_input"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Priode</td>
                                    <td><input type="date" required class="form-control"
                                            name="tgl_priode"></td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td><input type="number" required class="form-control"
                                            name="unit"></td>
                                </tr>
                                <tr>
                                    <td>Item & Description</td>
                                    <td><input type="text" required class="form-control"
                                            name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td><input type="number" required class="form-control"
                                            name="harga"></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td><input type="number" required class="form-control" 
                                    		name="jumlah"></td>
                                </tr>   			
                		</table>
                	</div>
                	<div class="modal-footer">
                	   	<button type="submit" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-report" data-dismiss="modal">Hapus</button>
                    </div>
                </form>
    		</div>
    	</div>
    </div>



