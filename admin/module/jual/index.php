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
											<td><input type="text" name="name" readonly="readonly" placeholder="Ardbee" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Phone Number</th>
											<td><input type="tel" name="tlp" readonly="readonly" placeholder="+62" style="width:100%; background-color: #eaecf4; opacity: 1; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Country</th>
											<td><input type="text" name="country" placeholder="Indonesia" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
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
											<td><input type="text" name="name" placeholder="Ardbee" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Phone Number</th>
											<td><input type="tel" name="phonenumber" placeholder="+62" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
                                        </tr>
										<tr>
                                            <th>Country</th>
											<td><input type="text" name="country" placeholder="Indonesia" style="width:100%; border-radius: 0.35rem; border: 1px solid #d1d3e2; padding: 0.375rem 0.75rem;"></td>
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
								<td><input type="date" class="form-control" name="tgl" placeholder="date"></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<td style="width:20%;"><b>Due Date</b></td>
								<td><input type="date" class="form-control" name="tgl" placeholder="date"></td>
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
													<!-- <tr>
														<td><input type="date" name="Date" id="iDate"></td>
														<td><input type="number" name="Unit" id="iUnit"></td>
														<td><input type="text" name="Item and Description" id="iDesc"></td>
														<td><input type="number" name="Rate" id="iRate"></td>
														<td><input type="number" name="Quantity" id="iQty"></td>
														<td><input type="number" name="Amount" id="iAmount"></td>
													</tr> -->
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
								<td><input readonly="readonly" type="number" class="form-control" name="total" placeholder="$ 15000000"></td>
							</tr>
						</table>
					</div>
			</div>
			<br>
		</div>
		<div class="btn-container" style="width: 100%; border: 1px solid transparent;">
		<button class="btn btn-submit" style="border:1px solid #1cc88a; background-color: #1cc88a; color: white; display:inline-block; float: right; margin-right: 50px;" type="submit"><b>Submit</b></button>
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
            input.placeholder = 'Item & Description';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "text";
            input.placeholder = 'Rate';
            cell.appendChild(input);
            row.appendChild(cell);
        }
        for (let j = 0; j < 1; j++) {
            const cell = document.createElement("td");
            const input = document.createElement("input");
            input.type = "number";
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
            input.readOnly = true;
        }
        tblBody.appendChild(row);
    }

    document.querySelectorAll("input[placeholder='Rate'], input[placeholder='Quantity']").forEach(input => {
        input.addEventListener('input', calculateAmount);
    });
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
        // Mengatur nilai input 'Amount' ke satu angka desimal
        amountInput.value = Math.round(amount); // Memperbaiki ke Math.round(amount)
    } else {
        amountInput.value = ''; // Mengosongkan nilai input 'Amount' jika perhitungan tidak valid
    }
}


</script>

