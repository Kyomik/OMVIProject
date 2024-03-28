<?php 
	session_start();

	$nama = $_SESSION['akun']['nama'];
	$no_telp = $_SESSION['akun']['no_telp'];
?>
<style type="text/css">
    td{
        align-content: center;
        padding: 8px 5px 8px 5px !important;
    }
    p{
        margin: 0px;
    }
    input{
        padding-left: 8px !important;
    }
</style>
	<form name="addForm" class="row form-input" method="POST" action="admin/module/jual/add_transaksi.php">
		<div class="col-sm-6">
			<div class="card card-primary mb-3">
				<div class="card-header ijo2 text-white">
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
											<td><input required type="text" readonly="readonly" value="<?php echo $nama; ?>" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Phone Number</th>
											<td><input required type="tel" readonly="readonly" value="<?php echo $no_telp; ?>" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Country</th>
											<td><input required type="text" name="negara_akun" placeholder="Negara" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
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
				<div class="card-header ijo2 text-white">
					<h5>Data Costumer</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<div id="hasil_cari"></div>
						<div id="tunggu"></div>
						<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                    <tfoot>
                                        <tr>
                                            <th >Name</th>
											<td><input type="text" required placeholder="Nama" name="nama" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Phone Number</th>
											<td><input type="tel" required placeholder="+62" name= "no_telp" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Country</th>
											<td><input required type="text" name="negara_customer" placeholder="Negara" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
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
				<div class="card-header ijo2 text-white">
					<h5> Transaction
					<button class="btn btn-danger float-right" type="reset" value="Reset Data" onclick="resetdata()">
						<b> Reset All </b></button>
					</h5>
				</div>
				<div class="card-body">
					<div id="keranjang" class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Date </b></td>
								<td><input required type="date" class="form-control" name="tgl_input" placeholder="data"></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Due Date</b></td>
								<td><input required type="date" class="form-control" name="tgl_priode" placeholder="Due Date"></td>
							</tr>
						</table>
							<div class="col-sm-12">
								<div class="card card-primary">
									<div class="card-header ijo2 text-white">
										<h5> Data Items 
											<button class="btn btn-danger float-right"  value="Add" onclick="AddTable()" type="button">
											<b> Add </b></button>
										</h5>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered" id="MyTable" style="font-size: 14px !important; text-align: center;">
												<thead>
													<tr>
														<th>Date</th>
														<th style="width: 50px;">Unit</th>
														<th>Item & Description</th>
														<th>Rate</th>
														<th style="width: 90px;">Quantity</th>
														<th>Amount</th>
                                                        <th></th>
													</tr>
												</thead>
												<tbody class="card-body" id="MyTBody">

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
					<div id="kasirnya">
						<table class="table table-stripped">
							<tr>
								<td>Total</td>
								<td>
									<!-- <input type="number" name="total" id="total" readonly="readonly" class="form-control"> -->
							<?php 
							echo "<input readonly='readonly' class='form-control' name='total_harga' id='total' value='" . $totalAmount . "'>"; 
							?>
							</td>
								
							</tr>
						</table>
					</div>
			</div>
			<br>
		</div>

		<div class="btn-container" style="width: 100%; border: 1px solid transparent;">
		<button  class="btn btn-submit" style="border:1px solid #1cc88a; background-color: #1cc88a; color: white; display:inline-block; float: right; margin-right: 50px;" type="submit" name="btnSubmit"><b>Submit</b></button>
		</div>
	</form>

<script>
// AJAX call for autocomplete 
// $(document).ready(function(){
// 	$("#cari").change(function(){
// 		$.ajax({
// 			type: "POST",
// 			url: "fungsi/edit/edit.php?cari_barang=yes",
// 			data:'keyword='+$(this).val(),
// 			beforeSend: function(){
// 				$("#hasil_cari").hide();
// 				$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
// 			},
// 			success: function(html){
// 				$("#tunggu").html('');
// 				$("#hasil_cari").show();
// 				$("#hasil_cari").html(html);
// 			}
// 		});
// 	});
// });

// Button reset
function resetdata(){
	const inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type === "text" || inputs[i].type === "number" || inputs[i].type === "date") {
            inputs[i].value = ''; 
        }
    }

 }

// validasi form
document.querySelector('.form-input').addEventListener('submit', async function(event) {
    event.preventDefault(); // Mencegah pengiriman form secara langsung

    let form = event.currentTarget;
    // let inputs = Array.from(form.querySelectorAll('input[required]'));
    // let isFormValid = true;

    // inputs.forEach(function(input) {
    //     console.log('coli')
    //     if (!input.value) {
    //         console.log('memek')
    //         isFormValid = false;
    //         return;
    //     }
    // });

    // if (!isFormValid) {
    //     return false; // Jangan melanjutkan validasi jika form tidak valid
    // }

    try {
        const confirmation = await showConfirmationPopup(); // Menunggu respons dari jendela konfirmasi
        if (confirmation === "confirm") {
            form.submit();
        }
    } catch (error) {
        console.error(error);
        // Handle any errors that occur during confirmation process
    }
});

function showConfirmationPopup() {
    return new Promise((resolve, reject) => {
        cuteAlert({
            type: "question",
            title: "Confirm",
            message: "Apakah anda yakin ingin menginput?",
            confirmText: "Okay",
            cancelText: "Cancel"
        }).then((e) => {
            resolve(e); // Resolve dengan nilai yang diterima dari jendela konfirmasi
        }).catch((error) => {
            reject(error); // Reject jika terjadi kesalahan dalam jendela konfirmasi
        });
    });
}

let nomorBerurut = 1;

function tambahNomor() {
    let nomor = nomorBerurut;
    nomorBerurut++;
    return nomor;
}

function hapusTabel() {
  let counter = 1; 
  const rows = [...document.getElementById("MyTBody").children]; 
  rows.forEach((row) => {
    row.children[1].children[0].value = counter++; 
  });
}

// Add Button
function AddTable() {
    const tblBody = document.getElementById("MyTBody");
    for (let i = 0; i < 1; i++) {
        const row = document.createElement("tr");
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.placeholder = 'Date';
            input.name = "tgl[]";
            input.type = "date";
            input.required = true;
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("b");
            // input.style.width = "50px";/
            input.style.textAlign = "center"
            input.innerHTML = ++tblBody.children.length
            input.readOnly = true; // Membuat input hanya bisa dibaca
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "text";
            input.name = "nama_barang[]";
            input.required = true;
            input.placeholder = 'Item & Description';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "text";
            input.name = "harga[]";
            input.required = true;
            input.placeholder = 'Rate';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.name = "jumlah[]";
            input.required = true;
            input.style.width = "90px";
            input.placeholder = 'Quantity';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            cell.appendChild(input);
            row.appendChild(cell);
            input.placeholder = 'Amount';
            input.readOnly = true;
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("button");
            input.type = "button";
            input.textContent = "❌";
            input.style.border = "0px";
            input.style.background = "transparent";
            input.classList = "deleteButton";
            cell.appendChild(input);
            row.appendChild(cell);
        }

        tblBody.appendChild(row);
        tblBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('deleteButton')) {
                    event.stopPropagation(); // Mencegah penyebaran event klik ke atas elemen induk
                    const row = event.target.closest('tr');
                    row.remove();

                    let counter = 1
                    let list_items = [...this.children]

                    list_items.map((item) =>{
                        item.children[1].children[0].innerHTML = counter++
                    })
                }
            })
    }

    document.querySelectorAll("input[placeholder='Rate'], input[placeholder='Quantity']").forEach(input => {
        input.addEventListener('input', calculateAmount);
    });
}

function formatNumber(number) {
    return number.toLocaleString('en');
}

function calculateAmount(event) {
    let inputField = event.target;
    let value = inputField.value.replace(/\./g, ''); // Hapus koma dari nilai input
    value = value.replace(/\D/g, ''); // Hilangkan karakter non-digit dari nilai input
    let numberValue = parseFloat(value);

    // Format nilai dengan koma sebagai pemisah ribuan
    inputField.value = formatNumber(numberValue);

    // Lakukan perhitungan
    const row = inputField.closest('tr'); // Mendapatkan elemen baris terdekat
    let rate = getNumericValue(row.querySelector("input[placeholder='Rate']").value);
    let quantity = getNumericValue(row.querySelector("input[placeholder='Quantity']").value);
    let amountInput = row.querySelector("input[placeholder='Amount']");

    // Handle NaN values
    if(isNaN(quantity)){
        row.querySelector('input[placeholder="Quantity"]').value = 0
        quantity = 0;
    }

    if(isNaN(rate)){
        inputField.value = 0
        rate = 0;
    }

    let amount = rate * quantity;

    // Format nilai dengan koma sebagai pemisah ribuan
    amountInput.value = formatNumber(amount);

    calculateTotal();
}

function getNumericValue(value) {
    return parseFloat(value.replace(/,/g, ''));
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll("input[placeholder='Amount']").forEach(input => {
        if(input.value != ""){
            total += getNumericValue(input.value);
        }
        
    });

    // Format nilai total dengan koma sebagai pemisah ribuan
    document.getElementById('total').value = formatNumber(total);
}

</script>

