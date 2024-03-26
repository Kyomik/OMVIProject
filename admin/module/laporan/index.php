<?php  
	$hak_access = $_SESSION['akun']['hak_access'];

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

	if(isset($_GET['report'])){
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
	function removeSuccessParameterFromURL(){
		let currentURL = window.location.href;
		let updatedURL = currentURL.replace(/([&\?](?!page\b)[^&]*)/g, '');
		if (currentURL !== updatedURL) {
		    window.history.replaceState({}, document.title, updatedURL);
		}
	}
	function generateReport(){
		let baseUrl = window.location.origin
		let generateUrl = ""	
		let url = window.location.href;

// Parsir URL untuk mendapatkan parameter
		let urlParams = new URLSearchParams(url);

// Mengambil nilai dari parameter 'id'
		let id = urlParams.get('id');

		generateUrl = baseUrl + `/OMVIProject/report.php?id=${id}`

		window.open(generateUrl)
	}
</script>

<div class="row">
	<div class="col-md-12">
		<h4>
			<?php if(!empty($_GET['cari'])){ ?>
			Data Laporan Penjualan <?= $bulan_tes[$_POST['bln']];?> <?= $_POST['thn'];?>
			<?php }elseif(!empty($_GET['hari'])){?>
			Data Laporan Penjualan <?= $_POST['hari'];?>
			<?php }else{?>
			Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
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
									<option selected="selected" value="">Bulan</option>
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
								<option selected="selected" value="">Tahun</option>';
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
				<form method="post" action="index.php?page=laporan&hari=cek">
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
         <!-- view barang -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered w-100 table-sm" id="example1" style="text-align:center;">
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th style="width:25px;"> No</th>
								<th style="width:150px;"> ID Transaksi</th>
								<th style="width:150px;"> Tanggal Inputan</th>
								<th style="width:150px;"> Tanggal Priode</th>
								<th style="width:150px;"> Admin</th>
								<th style="width:150px;"> Jumlah Item</th>
								<th style="width:150px;"> Total Harga</th>
								<th style="width:150px;"> Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no=1; 
								if(!empty($_GET['cari'])){
									$no=1;
									$hasil = $lihat -> periode_jual($_POST['bln'], $_POST['thn'], "");
								}elseif(!empty($_GET['hari'])){
									$hari = $_POST['hari'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> periode_jual("", "" , $_POST['hari']);
								}else{
									$hasil = $lihat -> jual();
								}
							?>
							<?php 
								$tahun_sekarang = date('Y');
								foreach($hasil as $isi){ 
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo "OMFAI" . "-" . substr($tahun_sekarang, -2) . "-" . $isi['id_transaksi']; ?></td>
								<td><?php echo $isi['tgl_input']; ?></td>
								<td><?php echo $isi['tgl_priode']; ?></td>
								<td><?php echo $isi['nama_akun'] ?></td>
								<td><?php echo $isi['jumlah_item'] ?></td>
								<td><?php echo $isi['total_harga']; ?></td>
								<td>
									<script type="text/javascript">
					                	allItemsString = "<?php echo $isi['all_items'];?>"
					               		allItems = allItemsString.split('|');
					               		transaksi.id_transaksi = "<?php echo $isi['id_transaksi'];?>";
										transaksi.customer = "<?php echo $isi['nama_customer'];?>"
										transaksi.total = "<?php echo $isi['total_harga']?>"
					                		
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
									<button id="<?php echo $isi['id_transaksi']; ?>" class="btn btn-primary btn-md mr-2 detailButton" data-toggle="modal" data-target="#myModal">Details
			                    	</button>
			                    	<a href="report.php?id=<?php echo $isi['id_transaksi']; ?>">
			                        	<button class="btn btn-danger btn-xs">Report</button>
			                    	</a>
								</td>
							</tr>
							<?php $no++; }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-sm" style="max-width: 2000px; width: 95%;" >
		<!-- Modal content-->
		<div class="modal-content" style=" border-radius:0px;">
        	<div class="modal-header" style="background:#285c64;color:#fff;">
                <button id="closeButton" type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 50px;">&times;</button>
			</div>
			<div class="modal-body">
				<form class="row" id="editForm" method="POST" action="/OMVIPROject/admin/module/laporan/edit_transaksi.php">
	            	<div class="col-sm-12">
						<div class="card-body" style="float: right; margin-right: 50px;">
							<div class="table-responsive">
								<table class="table table-striped bordered table-responsive" width="100%" cellspacing="0">
									<tfoot>
										<tr>
											<label>Id Transaksi</label>
												<td><input type="text" readonly="readonly" id="modal-id_transaksi" style="width:100%; background-color: transparent; color:black; opacity: 1; border-radius: 0.35rem; border: none; padding: 0.375rem 0.75rem;">
													<input type="hidden" name="id_transaksi" >
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
												<td><input type="text" name="nama_admin" readonly="readonly" id="modal-nama_akun" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;">
												</td>
										</tr>
									</tfoot>
					            </table>
							</div>
						</div>
					</div>
	                <div class="col-sm-6">
						<div class="card card-body">
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
									<td><input type="date" class="form-control" readonly="readonly" name="tgl_priode" id="modal-tgl_priode"></td>
								</tr>
							</table>
							<div class="col-sm-12">
								<h5> Data Items 
									<button id="addButton" class="btn btn-danger float-right" hidden="hidden" type="button">
									<b> Add </b></button>
								</h5>
								<div class="card card-body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-sm" id="MTable" style="text-align: center;" >
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
											<tbody >
											</tbody>
										</table>
									</div>
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
												echo "<input readonly='readonly' type='number' class='form-control' name='total_harga' id='total_harga' value='" . $totalAmount . "'>"; 
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
				<?php 
					if ($hak_access == 1){
						echo "<button id='editButton' type='submit' class='btn btn-primary'>Edit</button>
						<button id='deleteButton' type='button' class='btn btn-danger' data-dismiss='modal'>Delete</button>";

					}				
				?>
			</div>
		</div>                    
	</div>

<script>
    const editButton = document.querySelector('.modal-footer');
    const addButton = document.querySelector('#addButton');
    const closeButton = document.querySelector('#closeButton');
	const table_bordered = document.querySelector('.table-bordered');
	const table =  table_bordered.children[1];
	const pencarianTahun = document.getElementsByName("thn")[0];
	const pencarianBulan = document.getElementsByName("bln")[0];
	const pencarianHari = document.getElementsByName("hari")[0]

	pencarianBulan.addEventListener('change', (event) => {
		pencarianHari.value = getTanggalSekarang();
	})

	pencarianTahun.addEventListener('change', () => {
		pencarianHari.value = getTanggalSekarang();
	})

	pencarianHari.addEventListener('change', () => {
		pencarianBulan.value = ""
		pencarianTahun.value = ""
	})

    editButton.addEventListener('click', function(event) {
    	const table = document.getElementById('editForm');
    	const inputs = document.querySelectorAll('.modal-body input[readonly="readonly"]');
        
        addButton.hidden = false; 

		    inputs.forEach(input => {
		        input.removeAttribute('readonly');
		    });
			    if (event.target.id === 'editButton') {
			        // Mengubah teks tombol menjadi 'Submit' jika belum 'Submit', dan jika sudah, melakukan submit form
			        if (event.target.textContent !== 'Submit') {
			            event.target.textContent = 'Submit';
			        } else {
			            table.submit(); // Memanggil fungsi submit pada form dengan ID 'editForm'
			        }
			    }else if(event.target.id === 'deleteButton'){
			    	let id_transaksi = event.target.parentNode.parentNode.children[1].children[0].children[0].children[0].children[0].children[1].children[0].children[0].children[0].children[1].value

			    	window.location.href = "/OMVIPROject/admin/module/laporan/delete_transaksi.php?id_transaksi=" + id_transaksi;
			    }
    });

    addButton.addEventListener('click', function() {
    	// console.log("ilham babi");
    	const table = document.getElementById('MTable');
		const tbody = table.querySelector('tbody');


    	const row = document.createElement('tr');
		    row.innerHTML = `
		        <td><input type="date" name="tgl[]" style="border:none;" placeholder="Date" value=""></td>
		        <td><input type="text" name="unit"  style="border:none;" placeholder="${++tbody.children.length}" value=""></td>
		        <td><input type="text" name="nama_barang[]"  style="border:none;" placeholder="Item & Description" value=""></td>
		        <td><input type="text" name="harga[]"  style="border:none;" placeholder="Rate" value=""></td>
		        <td><input type="text" name="jumlah[]" style="border:none;" placeholder="Quantity" value=""></td>
		        <td><input type="text" name="total"  style="border:none;" placeholder="Amount" value=""></td>
		        <td><button type="button" class="deleteButton" style="border:none; background-color:transparent; ">❌</button></td>
		    `;
		    tbody.appendChild(row);
				calculateAmount.call(row.querySelector("input[placeholder='Rate']"));
				calculateAmount.call(row.querySelector("input[placeholder='Quantity']"));
				document.querySelectorAll("input[placeholder='Rate'], input[placeholder='Quantity']").forEach(input => {
			        input.addEventListener('input', calculateAmount);
			    });
    });

    function getTanggalSekarang(){
    	let currentDate = new Date(); // Mendapatkan tanggal dan waktu saat ini dari mesin klien

		let day = currentDate.getDate();
		let month = currentDate.getMonth() + 1; // Bulan dimulai dari 0
		let year = currentDate.getFullYear();

			// Mengatasi masalah dengan format tanggal jika day atau month < 10
		if (day < 10) {
		    day = '0' + day;
		}
		if (month < 10) {
		    month = '0' + month;
		}

		let formattedDate = year + '-' + month + '-' + day;

		return formattedDate
    }

    function calculateTotal() {
    total = 0; // Setel total ke 0 sebelum memulai perhitungan ulang
    const amountInputs = document.querySelectorAll("input[placeholder='Amount']");
    amountInputs.forEach(input => {
        if (!isNaN(parseFloat(input.value))) {
            total += parseFloat(input.value);
        }
    });
    document.getElementById('total').value = total;
}

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
	    calculateTotal();
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
			modalBody.children[0].children[0].children[0].children[1].children[0].children[0].children[0].children[1].value = event.target.id
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

			// Total
			modalBody.children[3].children[1].children[0].children[0].children[0].children[0].children[1].children[0].value = detailTransaksi.total


			detailTransaksi.data_items.forEach((item) => {
				const row = document.createElement('tr');
		        row.innerHTML = `
		        			<input hidden=hidden name="id_item[]" style="border:none;" value="${item.id}">
		         			<td><input type="date" name="tgl_lama[]" readonly="readonly" style="border:none;" placeholder="Date" value="${item.date}"></td>
		                    <td><input type="text" name="unit" readonly="readonly" style="border:none;" placeholder="Unit" value="${number}"></td>
		                    <td><input type="text" name="nama_barang_lama[]" readonly="readonly" style="border:none;" placeholder="Item & Description" value="${item.nama}"></td>
		                    <td><input type="text" name="harga_lama[]" readonly="readonly" style="border:none;" placeholder="Rate" value="${item.price}"></td>
		                    <td><input type="text" name="jumlah_lama[]" readonly="readonly" style="border:none;" placeholder="Quantity" value="${item.qty}"></td>
		                    <td><input type="text" name="total" readonly="readonly" style="border:none;" placeholder="Amount" value="${item.amount}"></td>
		                    <?php 
								if ($hak_access == 1){
									echo '<td><button type="button" class="deleteButton" style="border:none; background-color:transparent; ">❌</button></td>'; 
								}
							?>
						`;
				number++;
				tbody.appendChild(row);
				calculateAmount.call(row.querySelector("input[placeholder='Rate']"));
				calculateAmount.call(row.querySelector("input[placeholder='Quantity']"));
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