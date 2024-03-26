<?php
	@ob_start();
	session_start();
	if(isset($_POST['username']) && isset($_POST['password'])){
		require 'config.php';
		
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		
		$hashed_password = hash('sha256', $password); 
		
		$sql = 'SELECT akun.nama, akun.no_telp, akun.hak_access, akun.gambar , akun.id_akun, login.username, login.password
				FROM akun INNER JOIN login ON akun.id_akun = login.id_akun 
				WHERE username = ? AND password = ?'; 
		
		$row = $config->prepare($sql);
		$row->execute(array($username, $hashed_password));
		$jum = $row->rowCount();

		if($jum > 0){
			$hasil = $row->fetch();
			$_SESSION['akun'] = $hasil;
			echo '<script>alert("Login Sukses");window.location="index.php"</script>';
		} else {
			echo '<script>alert("Login Gagal");history.go(-1);</script>';
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - OMFAI SINGAPORE TRANSPORTATION SERVICES</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
	.bg-gradient {
		background: rgb(253,187,45);
        background: linear-gradient(0deg, rgba(253,187,45,1) 0%, rgba(34,193,195,1) 100%);
		}
		.bg-gradient2 {
			background: #1dca8a;
		}
</style>

<body class="bg-gradient" >
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
						<div class="p-5">
							<div class="text-center">
								<h4 class="h4 text-gray-900 mb-4"><b>OMFAI SINGAPORE TRANSPORTATION SERVICES</b></h4>
							</div>
							<form class="form-login" method="POST">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="username"
										placeholder="Username" autofocus>
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="password"
										placeholder="Password">
								</div>
								<button class="btn btn-primary bg-gradient2 btn-block" name="proses" type="submit"><i
										class="fa fa-lock"></i>
									SIGN IN</button>
							</form>
							<!-- <hr>
							<div class="text-center">
								<a class="small" href="forgot-password.html">Forgot Password?</a>
							</div>
							<div class="text-center">
								<a class="small" href="register.html">Create an Account!</a>
							</div> -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>
</html>