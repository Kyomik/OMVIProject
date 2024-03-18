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
		<div class="card card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-sm" id="example1" >
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
				</table>
			</div>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?akun=tambah" method="POST">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" placeholder="nama" required 
                                            class="form-control" name="nama"></td>
                                </tr>

                                <tr>
                                    <td>No Telpon</td>
                                    <td><input type="text" placeholder="no telpon" required 
                                            class="form-control" name="no_telp"></td>
                                </tr>

                                <tr>
                                    <td>Hak akses</td>
                                    <td>
                                        <select class="form-control" style="width:100%;" id="hakAksesSelect" name="hakAkses" >
                                            <option  value="admin">Admin</option>
                                            <option  value="user">User</option>
                                           
                                        </select>
                                    </td>
                                </tr>
                               
        
                                <tr>
                                    <td>username</td>
                                    <td><input type="text" placeholder="username" required class="form-control"
                                            name="username"></td>
                                </tr>

                                <tr>
                                    <td>password</td>
                                    <td><input type="text" placeholder="password" required class="form-control"
                                            name="password"></td>
                                </tr>
                              
                               
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

