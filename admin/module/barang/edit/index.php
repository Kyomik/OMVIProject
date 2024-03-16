 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php 
	$id = $_GET['barang'];
	$hasil = $lihat -> barang_edit($id);
?>
 <a href="index.php?page=barang" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Barang</h4>
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
<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<form action="fungsi/edit/edit.php?barang=edit" method="POST">
				
				<tr>
					<td>Nama </td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['nama_barang'];?>" name="nama"></td>
				</tr>
				<tr>
					<td>no telpon</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['merk'];?>" name="merk"></td>
				</tr>

				<tr>
					<td>Hak akses</td>
					<td>
						<select class="form-control" style="width:100%;" id="hakAksesSelect">
							<option  value="admin">Admin</option>
							<option  value="user">User</option>
						</select>
					</td>
				</tr>
				


				<tr>
					<td>email</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['harga_beli'];?>" name="beli"></td>
				</tr>
				<tr>
					<td>username</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['harga_jual'];?>" name="jual"></td>
				</tr>
				
				
				<tr>
					<td></td>
					<td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
				</tr>
			</form>
		</table>
	</div>
</div>