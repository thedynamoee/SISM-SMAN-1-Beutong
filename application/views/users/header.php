<?php
$cek    = $user->row();
$nama   = $cek->nama_lengkap;
$email  = $cek->email;
$level  = $cek->level;
if ($level == "s_admin") {
    $level = "Super Admin";
}

$menu       = strtolower($this->uri->segment(1) ?? '');
$sub_menu   = strtolower($this->uri->segment(2) ?? '');
$sub_menu3  = strtolower($this->uri->segment(3) ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="foto/Logo.png">
    <base href="<?php echo base_url(); ?>" />
    <title><?php echo $judul_web; ?></title>
    <style type="text/css">
        th {
            background-color: #275555ff;
            color: #FFF;
        }
    </style>
    <!-- Global stylesheets -->
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <?php
    if ($sub_menu == "" or $sub_menu == "profile" ) { ?>
        <!-- Theme JS files -->
        <link rel="stylesheet" href="assets/calender/css/style.css">
        <link rel="stylesheet" href="assets/calender/css/pignose.calendar.css">
        <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
        <script type="text/javascript" src="assets/js/core/app.js"></script>
        <script src="assets/calender/js/pignose.calendar.js"></script>
        <!-- /theme JS files -->
    <?php
    } ?>
    <?php
    if ($sub_menu == "control" or $sub_menu == "kepala" or $sub_menu == "ktu" or $sub_menu == "pengguna" or $sub_menu == "bagian" or $sub_menu == "skl" or $sub_menu == "siswa" or $sub_menu == "sm" or $sub_menu == "sk" or $sub_menu == "diklat" or $sub_menu == "data_sm" or $sub_menu == "data_sk" or $sub_menu == "data_diklat" or $sub_menu == "ska") { ?>
        <!-- Theme JS files -->
        <?php if ($sub_menu == 'sm' and $sub_menu3 != '') {
        } elseif ($sub_menu == 'sk' and $sub_menu3 != '') {
        } elseif ($sub_menu == 'ktu' and $sub_menu3 != '') {
        } elseif ($sub_menu == 'kepala' and $sub_menu3 != '') {
        } elseif ($sub_menu == 'control' and $sub_menu3 != '') {
        } else { ?>
            <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
            <script type="text/javascript" src="assets/js/core/app.js"></script>
            <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
        <?php } ?>
        <!-- /theme JS files -->
    <?php
    } ?>
</head>

<body>
    <!-- Main navbar -->
    <div class="navbar navbar-default header-highlight">
        <div class="navbar-header">
            <a class="navbar-brand" href="" style="color: #FFF;"><span class="glyphicon glyphicon-send" aria-hidden="true"></span><b>&nbsp;&nbsp;SISM SMAN 1 Beutong</b></a>
            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="foto/Logo.png" alt="">
                        <span><?php echo ucwords($nama); ?></span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="users/profile"><i class="icon-user"></i> PROFIL</a></li>
                        <li class="divider"></li>
                        <li><a href="web/logout"><i class="icon-switch2"></i> KELUAR</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">
                                <!-- Main -->
                                
                                <li class="<?php if ($sub_menu == "") {
                                                echo 'active';
                                            } ?>"><a href=""><i class="icon-home4"></i> <span><b>HOME</b></span></a>
                                </li>
                                <?php if ($user->row()->level != 'ktu' and $user->row()->level != 'kepala') { ?>
                                    <li class="<?php if ($sub_menu == "pengguna") {
                                                    echo 'active';
                                                } ?>">
                                        <a href="#"><i class="icon-gear"></i> <span><b>MASTER DATA</b></span></a>
                                        <ul>
                                            <?php
                                            if ($user->row()->level == 's_admin') { ?>
                                                <li class="<?php if ($sub_menu == "pengguna") {
                                                                echo 'active';
                                                            } ?>"><a href="users/pengguna"><i class="icon-users"></i> <b>PENGGUNA</b></a>
                                                </li>
                                            <?php } ?>
                                            <?php
                                            if ($user->row()->level != 'user') { ?>
                                                <li class="<?php if ($sub_menu == "bagian") {
                                                                echo 'active';
                                                            } ?>"><a href="users/bagian"><i class="icon-stack2"></i> <b>DATA GTK</b></a>
                                                </li>
                                            <?php } ?>
                                            <li class="<?php if ($sub_menu == "siswa") {
                                                            echo 'active';
                                                        } ?>"><a href="users/siswa"><i class="icon-users"></i> <b>DATA SISWA</b></a>
                                            </li>
                                            <li class="<?php if ($sub_menu == "skl") {
                                                            echo 'active';
                                                        } ?>"><a href="users/skl"><i class="icon-certificate"></i> <b>PROFIL SEKOLAH</b></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="users/ska"><i class="icon-exit"></i> <span><b>SURAT KETERANGAN</b></span></a></li>
                                    <?php
                                    if ($user->row()->level != 'user') { ?>
                                        <li class="<?php if ($sub_menu == "sk" or $sub_menu == "sm") {
                                                        echo 'active';
                                                    } ?>">
                                            <a href="#"><i class="icon-vcard"></i> <span><b>PERSURATAN</b></span></a>
                                            <ul>
                                                <li class="<?php if ($sub_menu == "sm") {
                                                                echo 'active';
                                                            } ?>"><a href="users/sm"><i class="icon-copy"></i> <b>SURAT MASUK</b></a></li>
                                                <li class="<?php if ($sub_menu == "sk") {
                                                                echo 'active';
                                                            } ?>"><a href="users/sk"><i class="icon-paste"></i> <b>SURAT KELUAR</b></a></li>
                                            </ul>
                                        </li>
                                        
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($user->row()->level == 'ktu') { ?>
                                    <li class="<?php if ($sub_menu == "ktu" or $sub_menu == "ktu") {
                                                    echo 'active';
                                                } ?>"><a href="users/ktu"><i class="icon-newspaper2"></i> <span><b>SURAT MASUK</b></span></a></li>
                                    <li class="<?php if ($sub_menu == "control" or $sub_menu == "control") {
                                                    echo 'active';
                                                } ?>"><a href="users/control"><i class="icon-newspaper"></i> <span><b>HISTORY SURAT</b></span></a></li>
                                <?php } ?>
                                <?php if ($user->row()->level == 'kepala') { ?>
                                    <li class="<?php if ($sub_menu == "kepala" or $sub_menu == "kepala") {
                                                    echo 'active';
                                                } ?>"><a href="users/kepala"><i class="icon-newspaper2"></i> <span><b>SURAT MASUK</b></span></a></li>
                                    <li class="<?php if ($sub_menu == "control" or $sub_menu == "control") {
                                                    echo 'active';
                                                } ?>"><a href="users/control"><i class="icon-newspaper"></i> <span><b>HISTORY SURAT</b></span></a></li>
                                <?php } ?>
                                <!-- /main -->

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /main sidebar -->
