<?php
$modules = 'index';
    require_once __DIR__.'/autoload.php';
    $tongsinhvien = $db->countTable("tbl_sinhvien");
    $tonglop = $db->countTable("tbl_lop");
    $tongkhoa = $db->countTable("tbl_khoa");
    $tongchuyennganh = $db->countTable("tbl_chuyennganh");
    $tongdoan = $db->countTable("tbl_doan");
    $tonggv = $db->countTable("tbl_giaovien");
    $sql1  = " SELECT count(id) as suma FROM tbl_doan WHERE diem >= 5 ";
    $countDo = $db->fetchsql($sql1);

?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
    <html lang="en">
        <head>
            <?php require_once __DIR__.'/layout/head.php'; ?>
        </head>
        <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-fixed page-sidebar-closed-hide-logo">
            <!-- BEGIN HEADER -->
             <?php require_once __DIR__.'/layout/header.php'; ?>
            <!-- END HEADER -->
            <div class="clearfix"></div>
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                 <?php require_once __DIR__.'/layout/sidebar.php'; ?>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                       
                        <h3 class="page-title">
                            Quản Lý Đồ Án Tốt Nghiệp
                        </h3>
                        <?php require_once __DIR__."/layout/notyfi.php" ?>
                       
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN PAGE CONTENT-->
                        <?php if($_SESSION["table"] == "tbl_quanly") { ?>
                            <div class="row">
                                <h2 style="padding-left: 15px;font-size: 20px;"> Thống kê </h2>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat blue-madison">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tongsinhvien ?>
                                            </div>
                                            <div class="desc">
                                                Tổng số sinh viên 
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/sinhvien') ?>"> Xem <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat red-intense">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tonglop ?>
                                            </div>
                                            <div class="desc">
                                                Tổng số lớp 
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/lop') ?>">
                                        Xem <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat green-haze">
                                        <div class="visual">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tongkhoa ?>
                                            </div>
                                            <div class="desc">
                                                Tổng số Khoa 
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/khoa') ?>">
                                        Xem <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat purple-plum">
                                        <div class="visual">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tongchuyennganh ?>
                                            </div>
                                            <div class="desc">
                                                Tổng số chuyên ngành 
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/chuyennganh') ?>">
                                        Xem<i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat purple-plum">
                                        <div class="visual">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tongdoan ?>
                                            </div>
                                            <div class="desc">
                                                Tổng số đồ án 
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/doan') ?>">
                                        Xem<i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat green-haze">
                                        <div class="visual">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $countDo[0]['suma'] ?>
                                            </div>
                                            <div class="desc">
                                                Sinh viên đạt
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/sinhviendat.php') ?>">
                                        Xem <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat red-intense">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tongdoan - $countDo[0]['suma'] ?>
                                            </div>
                                            <div class="desc">
                                                Sinh viên chưa đạt 
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/sinhvienchuadat.php') ?>">
                                        Xem <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat purple-plum">
                                        <div class="visual">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo $tonggv ?>
                                            </div>
                                            <div class="desc">
                                                Tổng số giáo viên
                                            </div>
                                        </div>
                                        <a class="more" href="<?= base_url('/admin/doan') ?>">
                                        Xem<i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- END PAGE CONTENT-->
                    </div>
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                
            <!-- END CONTAINER -->
<?php require_once __DIR__.'/layout/footer.php'; ?>