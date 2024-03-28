<?php
	$gambar = $_SESSION['akun']['gambar'];
	$id_akun = $_SESSION['akun']['id_akun'];
?>

<h4>Profil Pengguna Aplikasi</h4>
<br>

<?php if(isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Edit Data Berhasil !</p>
    </div>
<?php } ?>

<?php if(isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil !</p>
    </div>
<?php } ?>

<div class="row">
    <div class="col-sm-3">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mt-2"><i class="fa fa-user"></i> Foto Pengguna</h5>
            </div>
            <div class="card-body">
                <img style=" border-radius: 20%;" src="assets/img/user/<?php echo $gambar; ?>" alt="Foto Pengguna" class="img-fluid w-100" />
            </div>
            <div class="card-footer">
				<form method="POST" action="fungsi/edit/edit.php?profile=edit" enctype="multipart/form-data">
					<input type="file" accept="image/*" name="gambar">
					<input type="hidden" name="foto_lama" value="<?php echo $gambar; ?>">
					<input type="hidden" name="id_akun" value="<?php echo $id_akun; ?>">
					<br><br>    
					<button type="submit">Upload Gambar</button>
				</form>
            </div>
        </div>
    </div>

    <!-- Form kelola pengguna dan ganti password -->
    <!-- ... -->


	<div class="col-sm-8">
		<div class="card card-primary">
			<div class="card-header">
				<h5 class="mt-2"><i class="fa fa-lock"></i> Ganti Password</h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?password=edit">
						<fieldset>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Username</label>
								<div class="input-group">
									<input type="text" class="form-control" style="border-radius:0px;" name="username"
										data-items="4" value="<?php echo $username;?>" />
								</div>
							</div>

							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Password Baru</label>
								<div class="input-group">
									<input type="password" class="form-control" placeholder="Enter Your New Password" id="id_akun" name="password" data-items="4"
										required="required" />
								</div>
							</div>
							<input type="hidden" name="id_akun" value="<?php echo $id_akun;?>" required="required" />
							<button type="submit" class="btn btn-primary ijo2" value="Tambah" name="proses"><i class="fas fa-edit"></i> Ubah Password</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
