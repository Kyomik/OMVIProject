<?php 
	// $id = $_SESSION['login']['id_akun'];
	// $hasil = $lihat -> member_edit($id);
?>

	<form class="row" method="POST" action="admin/module/jual/add_transaksi.php">
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
                                    		<th hidden="hidden">id_akun</th>
                                    		<td hidden="hidden"><input type="number" name="id_akun" readonly="readonly" value="6" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                    	</tr>
                                        <tr>
                                            <th>Name</th>
											<td><input type="text" name="nama" readonly="readonly" placeholder="Ardbee" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Phone Number</th>
											<td><input type="tel" name="no_telp" readonly="readonly" placeholder="+62" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Country</th>
											<td><input type="text" name="negara" placeholder="Indonesia" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
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
                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                    <tfoot>

                                    	<tr>
                                    	<th hidden="hidden">id_customer</th>
                                    		<td hidden="hidden"><input type="number" name="id_costumer" readonly="readonly" placeholder="" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                    	</tr>
                                        <tr>
                                            <th >Name</th>
											<td><input type="text" name="nama" placeholder="Ardbee" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Phone Number</th>
											<td><input type="tel" name="no_telp" placeholder="+62" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Country</th>
											<td><input type="text" name="negara" placeholder="Indonesia" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
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
					<button class="btn btn-danger float-right" type="reset" value="Reset Data" onclick="resetdata()">
						<b> Reset All </b></button>
					</h5>
				</div>
				<div class="card-body">
					<div id="keranjang" class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Date </b></td>
								<td><input type="date" class="form-control" name="tgl_input" placeholder="data"></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Due Date</b></td>
								<td><input type="date" class="form-control" name="tgl_priode" placeholder="Due Date"></td>
							</tr>
						</table>
							<div class="col-sm-12">
								<div class="card card-primary">
									<div class="card-header bg-primary text-white">
										<h5> Data Items 
											<button class="btn btn-danger float-right"  value="Add" onclick="AddTable()" type="button">
											<b> Add </b></button>
										</h5>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered" id="MyTable">
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
												<tbody class="card-body" id="MyTBody">
													<?php

													// $sql = "SELECT * FROM transaksi";
													// $result = $koneksi->query($sql);

													// if ($result->num_rows > 0) {
            										// 	while ($row = $result->fetch_assoc()) {
                									// 		echo "<tr>";
                									// 		echo "<td>" . $row['date'] . "</td>";
                									// 		echo "<td>" . $row['unit'] . "</td>";
                									// 		echo "<td>" . $row['item_description'] . "</td>";
                									// 		echo "<td>" . $row['rate'] . "</td>";
                									// 		echo "<td>" . $row['quantity'] . "</td>";
                									// 		echo "<td>" . $row['amount'] . "</td>";
                									// 		echo "</tr>";
                									// 		$totalAmount += $row['amount'];
            										// 	}
        											// } else {
            										// 	echo "<tr><td colspan='6'>Kimak</td></tr>";
        											// }

													// $koneksi->close();
													?>
												</tbody>
											</table>
										</div>
									</div>
									<?php
										// $sql = "SELECT * FROM transaksi";
										// $result = $koneksi->query($sql);

										// $data = array();
										// if ($result->num_rows > 0) {
    									// 	while ($row = $result->fetch_assoc()) {
        								// 		$data[] = $row;
    									// 	}
										// }
										// echo json_encode($data);
									?>
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
							echo "<input readonly='readonly' type='number' class='form-control' name='total_harga' id='total' value='" . $totalAmount . "'>"; 
							?>
							</td>
								
							</tr>
						</table>
					</div>
			</div>
			<br>
		</div>

		<div class="btn-container" style="width: 100%; border: 1px solid transparent;">
		<button class="btn btn-submit" style="border:1px solid #1cc88a; background-color: #1cc88a; color: white; display:inline-block; float: right; margin-right: 50px;" type="submit" name="submit" onclick="confirmSubmit()"><b>Submit</b></button>
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

// Button Confirm
function confirmSubmit() {
    if (confirm("Apakah data yang anda masukan sudah benar ?")) {
        document.querySelector('form').submit();
    } else {
    	// Kimak
    }
}

// Button reset
function resetdata(){
	const inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type === "text" || inputs[i].type === "number" || inputs[i].type === "date") {
            inputs[i].value = ''; 
        }
    }

 }

let nomorBerurut = 1;

function tambahNomor() {
    let nomor = nomorBerurut;
    nomorBerurut++;
    return nomor;
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
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "number";
            input.placeholder = 'Unit' + nomorBerurut;
            input.value = nomorBerurut++;
            input.readOnly = true; // Membuat input hanya bisa dibaca
            cell.appendChild(input);
            row.appendChild(input);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "text";
            input.name = "nama[]";
            input.placeholder = 'Item & Description';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "text";
            input.name = "harga[]";
            input.placeholder = 'Rate';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "number";
            input.name = "jumlah";
            input.placeholder = 'Quantity';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "number";
            cell.appendChild(input);
            row.appendChild(cell);
            input.placeholder = 'Amount';
            input.readOnly = true;
        }
        tblBody.appendChild(row);
    }

    document.querySelectorAll("input[placeholder='Rate'], input[placeholder='Quantity']").forEach(input => {
        input.addEventListener('input', calculateAmount);
    });
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
</script>

