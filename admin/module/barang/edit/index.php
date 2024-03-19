<?php
// Periksa apakah parameter 'akun' ada di URL dan tidak kosong
if(isset($_GET['akun']) && !empty($_GET['akun'])) {
    // Mendapatkan nilai parameter 'akun' dari URL
    $id_akun = $_GET['akun'];

    // Query untuk mengambil data akun berdasarkan ID
    $sql = "SELECT akun.id_akun, akun.nama, akun.no_telp, akun.hak_access, login.username, login.password
            FROM akun
            INNER JOIN login ON akun.id_akun = login.id_akun
            WHERE akun.id_akun = :id_akun";

    // Menyiapkan statement
    $stmt = $config->prepare($sql);
    $stmt->bindParam(':id_akun', $id_akun);
    $stmt->execute();

    // Mengambil data akun
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Periksa apakah data ditemukan
    if (!$data) {
        echo "Data tidak ditemukan";
        exit;
    }
} else {
    // Jika parameter 'akun' tidak ditemukan atau kosong, berikan pesan error dan hentikan eksekusi skrip
    echo "Parameter 'akun' tidak ditemukan atau kosong";
    exit;
}
?>
<a href="index.php?page=barang" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Akun</h4>
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
<!-- Jika data ditemukan, tampilkan form edit -->
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <form action="fungsi/edit/edit.php?akun=edit" method="POST">
                <tr>
					<td>ID Akun</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $data['id_akun'];?>"
							name="id"></td>
				</tr>
               
                <tr>
                    <td>Nama </td>
                    <td><input type="text" class="form-control" value="<?php echo $data['nama']; ?>" name="nama"></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="text" class="form-control" value="<?php echo $data['no_telp']; ?>" name="no_telp"></td>
                </tr>
                <tr>
                    <td>Hak Akses</td>
                    <td>
                        <select class="form-control" style="width:100%;" id="hakAksesSelect" name="hak_access">
                            <option value="admin" <?php if($data['hak_access'] == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="user" <?php if($data['hak_access'] == 'user') echo 'selected'; ?>>User</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" class="form-control" value="<?php echo $data['username']; ?>" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" class="form-control" value="<?php echo $data['password']; ?>" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
                </tr>
            </form>
        </table>
    </div>
</div>
