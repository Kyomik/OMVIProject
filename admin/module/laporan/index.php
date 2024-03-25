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

?php 
	if(isset($_GET['success'])){
		echo "<script>cuteAlert({
		  type: 'question',
		  title: 'Confirm Title',
		  message: 'Confirm Message',
		  confirmText: 'Okay',
		  cancelText: 'Cancel'
		}).then((e)=>{
		if ( e == ('confirm')){
			generateReport()
		} else {
		    removeSuccessParameterFromURL();
		}
		})</script>";
	}
?>
<script type="text/javascript">
		// Mendapatkan URL saat ini
	function removeSuccessParameterFromURL(){
		let currentURL = window.location.href;

		// Menghapus semua parameter kecuali parameter 'page'
		let updatedURL = currentURL.replace(/([&\?](?!page\b)[^&]*)/g, '');

		// Mengecek apakah URL telah diubah
		if (currentURL !== updatedURL) {
		    // Mengganti URL tanpa reload halaman
		    window.history.replaceState({}, document.title, updatedURL);
		}
	}

	function generateReport(){
		let baseUrl = window.location.origin
		let generateUrl = baseUrl + '/OMVIProject/report.php'

		window.open(generateUrl)
	}
</script>
<div class="row">
	<div class="col-md-12">
		<!-- <h4> -->
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
		<!-- </h4> -->
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
										   	$sql = "SELECT t.*, COUNT(i.id_item) AS jumlah_item, GROUP_CONCAT(CONCAT(i.id_item, ',', i.nama, ',', i.tgl, ',', i.harga, ',', i.jumlah) SEPARATOR '|') AS all_items, c.nama AS nama_customer, a.nama AS nama_akun
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
									<script type="text/javascript">
										let allItemsString = '';
										let allItems = '';
										let list_transaksi = [];
										let transaksi = {
											id_transaksi: '',
											customer: '',
											data_items: [],
											total: '' 
										};
										let kerangka_item = {}
									</script>
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
			                				<script type="text/javascript">
			                					allItemsString = "<?php echo $row['all_items'];?>"
			                					allItems = allItemsString.split('|');
			                					
			                					transaksi.id_transaksi = "<?php echo $row['id_transaksi'];?>";
												transaksi.customer = "<?php echo $row['nama_customer'];?>"
												transaksi.total = "<?php echo $row['total']?>"

			                					allItems.forEach(function(item) {
												    let itemDetails = item.split(',');
												    kerangka_item.id  = itemDetails[0];
												    kerangka_item.nama = itemDetails[1];
												    kerangka_item.date = itemDetails[2];
												    kerangka_item.price = itemDetails[3];
												    kerangka_item.qty = itemDetails[4];

												    transaksi.data_items.push(kerangka_item)
												    kerangka_item = {};
												})
												
												list_transaksi.push(transaksi)
												transaksi = {
													id_transaksi: "",
													customer: "",
													data_items: [],
													total : ""
												}


			                				</script>
			                    			<button id="<?php echo $row['id_transaksi']; ?>" class="btn btn-primary btn-md mr-2 detailButton" data-toggle="modal" data-target="#myModal">
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
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="min-width: 1450px;">
		<!-- Modal content-->
		<div class="modal-content" style=" border-radius:0px;">
        	<div class="modal-header" style="background:#285c64;color:#fff;">
                <button id="closeButton" type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 50px;">&times;</button>
			</div>
			<div class="modal-body">
				<form class="row" action="transaksi.php" id="editForm">
	            	<div class="col-sm-12">
						<div class="card-body" style="float: right; margin-right: 50px;">
							<div class="table-responsive">
								<table class="table table-striped bordered table-responsive" width="100%" cellspacing="0">
									<tfoot>
										<tr>
											<label>Id Transaksi</label>
												<td><input type="text" name="nama" readonly="readonly" id="modal-id_transaksi" style="width:100%; background-color: transparent; color:black; opacity: 1; border-radius: 0.35rem; border: none; padding: 0.375rem 0.75rem;">
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
								<table class="table table-striped bordered table-responsive" width="100%" cellspacing="0">
									<tfoot>
										<tr>
											<label>Admin</label>
												<td><input type="text" name="nama" readonly="readonly" id="modal-nama_akun" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;">
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
											<td><input type="text" name="nama_customer" readonly="readonly" class="modal-nama_customer" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;">
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
									<td><input type="date" class="form-control" readonly="readonly" id="modal-tgl_input" name="tgl_input"></td>
								</tr>
							</table>
							<table class="table bordered">
								<tr>
									<td style="width:20%;"><b>Due Date</b></td>
									<td><input type="date" class="form-control" readonly="readonly" name="tgl_input" id="modal-tgl_priode"></td>
								</tr>
							</table>
								<div class="col-sm-12">
											<h5> Data Items 
												<button id="addButton" class="btn btn-danger float-right" hidden="hidden" type="button">
												<b> Add </b></button>
											</h5>
									<div class="card-body">
											<table class="table bordered" id="MTable">
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
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
						</div>
						<div class="col-sm-12">
							<div id="kasirnya" class="table-resposive">
								<table class="table table-stripped bordered">
									<tr>
										<td>Total</td>
											<td>
												<!-- <input type="number" name="total" id="total" readonly="readonly" class="form-control"> -->
												<?php 
												echo "<input readonly='readonly' type='number' class='form-control' name='total_harga' id='total' value='" . $totalAmount . "'>"; 
												?>
											</td>
									</tr>
								</table>
							</div>
						</div> 		
					</div>
				</form>
			</div>
                <div class="modal-footer">
					<button id="editButton" type="submit" class="btn btn-primary">Edit</button>
					<button id="deleteAll" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
				</div>
		</div>                    
	</div>
</div>            
</div>

<script>
    var editButton = document.querySelector('#editButton');
    var addButton = document.querySelector('#addButton');
    var closeButton = document.querySelector('#closeButton');
    var deleteAllButton = document.querySelector('#deleteAll')
	let table_bordered = document.querySelector('.table-bordered');

	deleteAllButton.addEventListener('click', function() {
    // Dapatkan elemen tabel
	    let table = document.querySelector('#MTable tbody');

	    let rows = table.querySelectorAll('tr');

	    rows.forEach(function(row) {
	        let adminInput = row.querySelector("input[name='nama']");
	        if (adminInput && !adminInput.hidden) {
	            return;
	        }
	        row.remove();
	    });
	});

    editButton.addEventListener('click', function() {
        addButton.hidden = false; 
        const inputs = document.querySelectorAll('.modal-body input[readonly="readonly"]');
		    inputs.forEach(input => {
		        input.removeAttribute('readonly');
		    });
		    const hakAkses = <?php echo isset($_SESSION['akun']['hak_access']) ? $_SESSION['akun']['hak_access'] : '0'; ?>;
		    if (hakAkses === 1) {
			    if(editButton.innerHTML !== 'Submit'){
			    	editButton.innerHTML = 'Submit';
			    }
			    else{
			    	document.getElementById('editForm').submit();	
			    }
		   	}
		   	else{
		   		alert('Anda tidak memiliki izin untuk melakukan tindakan ini.');
		   	}
		    console.log(editButton.innerHTML);
    });

    addButton.addEventListener('click', function() {
    	// console.log("ilham babi");
    	const table = document.getElementById('MTable');
		const tbody = table.querySelector('tbody');

    	const row = document.createElement('tr');
		    row.innerHTML = `
		        <td><input type="date" name="tgl"  style="border:none;" placeholder="Date" value=""></td>
		        <td><input type="text" name="unit"  style="border:none;" placeholder="${++tbody.children.length}" value=""></td>
		        <td><input type="text" name="nama"  style="border:none;" placeholder="Item & Description" value=""></td>
		        <td><input type="text" name="harga"  style="border:none;" placeholder="Rate" value=""></td>
		        <td><input type="text" name="jumlah"  style="border:none;" placeholder="Quantity" value=""></td>
		        <td><input type="text" name="total"  style="border:none;" placeholder="Amount" value=""></td>
		        <td><button type="button" class="deleteButton" style="border:none; background-color:transparent; ">❌</button></td>
		    `;
		    tbody.appendChild(row);
			calculateAmount.call(row.querySelector("input[placeholder='Rate']"));
    });

    function calculateAmount() {
	    const row = this.parentNode.parentNode; // Mendapatkan elemen baris (tr)
	    let rate = parseFloat(row.querySelector("input[placeholder='Rate']").value);
	    let quantity = parseFloat(row.querySelector("input[placeholder='Quantity']").value);
	    let amountInput = row.querySelector("input[placeholder='Amount']");

	    if(isNaN(quantity)){
	        quantity = 0;
	    }
	    if(isNaN(rate)){
	        rate = 0;
	    }
	    let amount = rate * quantity;
	    if (!isNaN(amount)) {
	        amountInput.value = Math.round(amount); 
	    } else {
	        amountInput.value = ''; 
	    }
	    // calculateTotal();
	}

	table_bordered.addEventListener('click', function(event){
		if (event.target.classList.contains('detailButton')) {
			// console.log(list_transaksi)
			const transaksi = event.target.parentNode.parentNode;
			const modalBox = document.getElementById('myModal');
			const modalBody = modalBox.querySelector('.modal-body').children[0];

			let number = 1;
			// console.log(transaksi.children[2].childNodes[0].textContent); // cek anak 

			// id transaksi
			modalBody.children[0].children[0].children[0].children[1].children[0].children[0].children[0].children[0].value = transaksi.children[1].childNodes[0].textContent;
			// admin
			modalBody.children[1].children[0].children[0].children[1].children[0].children[0].children[0].children[0].value = transaksi.children[4].childNodes[0].textContent;
			// untuk penempatan customer
			// console.log(modalBody.children[2].children[0].children[0].children[1].children[0].children[0].children[0].children[0].value = transaksi.children[4].childNodes[0].textContent);
			// tgl input
			modalBody.children[3].children[0].children[0].children[0].children[0].children[1].children[0].value = transaksi.children[2].childNodes[0].textContent;
			// tgl priode
			modalBody.children[3].children[0].children[1].children[0].children[0].children[1].children[0].value = transaksi.children[3].childNodes[0].textContent;

		    const table = document.getElementById('MTable');
			const tbody = table.querySelector('tbody');

			tbody.innerHTML = ""

			let detailTransaksi = list_transaksi.find(function(transaksi) {
			    return transaksi.id_transaksi == event.target.id;
			});

			modalBody.children[2].children[0].children[0].children[1].children[0].children[0].children[0].children[0].value = detailTransaksi.customer;
			console.log(modalBody.children[3].children[1].children[0].children[0].children[0].children[0].children[1].children[0].value = detailTransaksi.total)


			detailTransaksi.data_items.forEach((item) => {
				console.log(item.date)
				const row = document.createElement('tr');
		        row.innerHTML = `
		         <td><input type="date" name="tgl" readonly="readonly" style="border:none;" placeholder="Date" value="${item.date}"></td>
		                    <td><input type="text" name="unit" readonly="readonly" style="border:none;" placeholder="Unit" value="${number}"></td>
		                    <td><input type="text" name="nama" readonly="readonly" style="border:none;" placeholder="Item & Description" value="${item.nama}"></td>
		                    <td><input type="text" name="harga" readonly="readonly" style="border:none;" placeholder="Rate" value="${item.price}"></td>
		                    <td><input type="text" name="jumlah" readonly="readonly" style="border:none;" placeholder="Quantity" value="${item.qty}"></td>
		                    <td><input type="text" name="total" readonly="readonly" style="border:none;" placeholder="Amount" value="${item.amount}"></td>

		                    <td><button type="button" class="deleteButton" style="border:none; background-color:transparent; ">❌</button></td>
						`;
				number++;
				tbody.appendChild(row);
				calculateAmount.call(row.querySelector("input[placeholder='Rate']"));
			})
			
			tbody.addEventListener('click', function(event) {
				if (event.target.classList.contains('deleteButton')) {
					event.stopPropagation(); // Mencegah penyebaran event klik ke atas elemen induk
					const row = event.target.closest('tr');
	        		row.remove();

	        		let counter = 1
	        		let list_items = [...this.childNodes]

	        		list_items.map((item) =>{
	        			item.children[1].children[0].value = counter++
	        		})
				}
			});
		}
	});
</script>