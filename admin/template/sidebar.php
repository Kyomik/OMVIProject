<!--sidebar start-->

<?php 
    $hak_access = $_SESSION['akun']['hak_access'];
    $nama = $_SESSION['akun']['nama'];
    $gambar = $_SESSION['akun']['gambar'];
    $gambar_path = "assets/img/user/";
   
    // $hasil_profil = $lihat -> member_edit($id);
?>

<!-- Sidebar -->


<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #FFBC40; background-image: linear-gradient(180deg, #FF8911 10%, #FFBC40 100%); background-size: cover;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

        <div class="sidebar-brand-icon rotate-n-15">
            <i ><img style="width:100%; transform: rotate(10deg);" src="assets/img/user/travelnew-white.png" alt=""></i>

        </div>
        <div class="sidebar-brand-text mx-2" style="font-size: 10.7px;">OMFAI TRANSPORTATION SERVICES<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <!-- <div class="sidebar-heading">
           Master
       </div> -->
    <!-- Nav Item - Pages Collapse Menu -->
    <?php
        if ($hak_access==1){
            echo "<li class='nav-item active'> 
            <a class='nav-link' href='index.php?page=barang'>
                <i class='fas fa-fw fa-tachometer-alt'></i>
                <span>Managed Accounts</span></a>
        </li>";
        } 

    ?>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
            aria-controls="collapse3">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Transaction</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="index.php?page=jual">Add</a>
                <a class="collapse-item" href="index.php?page=laporan">View</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- <li class="nav-item active">
        <a class="nav-link" href="index.php?page=pengaturan">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Pengaturan Toko</span></a>
    </li> -->
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white ijo2 topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <h5 class="d-lg-block d-none mt-2"><b style="color: #FF8C00; font-size: 150%; ">Selamat Datang <?php echo " $nama" ; ?></b></h5>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
    <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <?php if (!empty($gambar)): ?>
                            <img class="img-profile rounded-circle" src="<?php echo $gambar_path . $gambar; ?>">
                        <?php else: ?>
                            <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?php endif; ?>
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-2"></span>
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=user">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

<style>
    .ijo{
        background: rgb(253,187,45);
        background: linear-gradient(0deg, rgba(253,187,45,1) 0%, rgba(34,193,195,1) 100%);
    }

    .ijo2{
        background: #1dca8a;
      
    }
</style>
