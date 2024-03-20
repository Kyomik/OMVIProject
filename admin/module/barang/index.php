<h4>Data Akun</h4>
        <br />
<?php 
    $sql = "SELECT akun.id_akun, akun.nama, akun.no_telp, akun.hak_access, login.username, login.password
            FROM akun
            INNER JOIN login ON akun.id_akun = login.id_akun";
	$row = $config -> prepare($sql);
	$row -> execute();
	$r = $row -> rowCount();
?>
        <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus"></i> Tambah Akun</button>
<div class="clearfix"></div>
<br />
<!-- view barang -->
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>No Telpon</th>
                    <th>Hak Akses</th>
                    <th>Nama user</th>
                    <th style="width:20px;">Password</th>
                    <th style="width:45%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1; 
                    foreach ($row as $data) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['no_telp']; ?></td>
                    <td>
                        <?php  
                            if ($data['hak_access'] == 1) {
                                echo "Manajer";
                            } elseif ($data['hak_access'] == 0) {
                                echo "Admin";
                            } else {
                                echo "Unknown";
                            } 
                        ?>
                    </td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td>
                        <a href="index.php?page=barang/edit&akun=<?php echo $data['id_akun']; ?>"><button class="btn btn-warning btn-xs">Edit</button></a>
                        <a href="fungsi/hapus/hapus.php?akun=hapus&id=<?php echo $data['id_akun']; ?>" onclick="javascript:return confirm('Hapus Data akun ?');"><button class="btn btn-danger btn-xs">Hapus</button></a>
                    </td>
                 </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?akun=tambah" method="POST">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" placeholder="nama" required 
                                            class="form-control" name="nama"></td>
                                </tr>

                                <tr>
                                    <td>No Telpon</td>
                                    <td><input type="text" placeholder="no telpon" required 
                                            class="form-control" name="no_telp"></td>
                                </tr>

                                <tr>
                                    <td>Hak akses</td>
                                    <td>
                                        <select class="form-control" style="width:100%;" id="hakAksesSelect" name="hakAkses" >
                                            <option  value="0">Admin</option>
                                            <option  value="1">Manager</option>
                                           
                                        </select>
                                    </td>
                                </tr>
                               
        
                                <tr>
                                    <td>Username</td>
                                    <td><input type="text" placeholder="username" required class="form-control"
                                            name="username"></td>
                                </tr>

                                <tr>
                                    <td>password</td>
                                    <td><input type="text" placeholder="password" required class="form-control"
                                            name="password"></td>
                                </tr>
                              
                               
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

