<?php 
	// $id = $_SESSION['admin']['id_member'];
	// $hasil = $lihat -> member_edit($id);
?>
	<br>
	<?php if(isset($_GET['success'])){?>
	<div class="alert alert-success">
		<p>Edit Data Berhasil !</p>
	</div>
	<?php }?>
	<?php if(isset($_GET['remove'])){?>
	<div class="alert alert-danger">
		<p>Hapus Data Berhasil !</p>
	</div>
	<?php }?>
	<form class="row">
		<div class="col-sm-6">
			<div class="card card-primary mb-3">
				<div class="card-header bg-primary text-white">
					<h5>Data Admin</h5>
				</div>
				<div class="card-body">

					<div class="table-responsive">
						<div id="hasil_cari"></div>
						<div id="tunggu"></div>
					</div>
				
					<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
											<td>tes</td>
                                        </tr>
										<tr>
                                            <th>nomor telpon</th>
											<td>087856757585</td>
                                        </tr>
										<tr>
                                            <th>nama negara</th>
											<td>indonesia</td>
                                        </tr>
                                    </tfoot>
								
                                </table>
                            </div>
                    </div>

				</div>
			</div>
		</div>


		<div class="col-sm-6">
			<div class="card card-primary mb-3">
				<div class="card-header bg-primary text-white">
					<h5>Data Costumer</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<div id="hasil_cari"></div>
						<div id="tunggu"></div>
						<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tfoot>
                                        <tr>
                                            <th >Name</th>
											<td>tes</td>
                                        </tr>
										<tr>
                                            <th>nomor telpon</th>
											<td>087856757585</td>
                                        </tr>
										<tr>
                                            <th>nama negara</th>
											<td>indonesia</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    	</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card card-primary">
				<div class="card-header bg-primary text-white">
					<h5> Transaction
					<a class="btn btn-danger float-right" 
					href="fungsi/hapus/hapus.php?penjualan=jual">
						<b> Reset All </b></a>
					</h5>
				</div>
				<div class="card-body">
					<div id="keranjang" class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Date </b></td>
								<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Due Date</b></td>
								<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
							</tr>
						</table>
							<div class="col-sm-12">
								<div class="card card-primary">
									<div class="card-header bg-primary text-white">
										<h5> Data Items <a class="btn btn-danger float-right" href="fungsi/hapus/hapus.php?penjualan=jual">
											<b> Add </b></a>
										</h5>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Date</th>
														<th>Unit</th>
														<th>Item & Description</th>
														<th>Rate</th>
														<th>Quantity</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody class="card-body">
													<tr>
														<td value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
														<td>1</td>
														<td>Edinburgh</td>
														<td>61</td>
														<td>6</td>
														<td>$320,800</td>
													</tr>
													<tr>
														<td>08/03/2024</td>
														<td>2</td>
														<td>Senior Javascript Developer</td>
														<td>22</td>
														<td>50</td>
														<td>$433,060</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
			<br>
		</div>
		<div class="btn-container" style="width: 100%; border: 1px solid transparent;">
		<button class="btn btn-submit" style="border:1px solid #1cc88a; background-color: #1cc88a; color: white; display:inline-block; float: right; margin-right: 50px;"><b>Submit</b></button>
		</div>
	</form>

<script>
// AJAX call for autocomplete 
$(document).ready(function(){
	$("#cari").change(function(){
		$.ajax({
			type: "POST",
			url: "fungsi/edit/edit.php?cari_barang=yes",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#hasil_cari").hide();
				$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
			},
			success: function(html){
				$("#tunggu").html('');
				$("#hasil_cari").show();
				$("#hasil_cari").html(html);
			}
		});
	});
});
</script>
