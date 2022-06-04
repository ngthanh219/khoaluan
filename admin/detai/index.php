<?php
    $title = " Danh sách đề tài ";
    $modules = "detai";
    require_once __DIR__.'/../autoload.php';
    $detai = $pagi->pagination("tbl_detai", "Select * from tbl_detai order by id desc", "page", 15)
?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
<html lang="en">
<head>
    <?php require_once __DIR__.'/../layout/head.php'; ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<?php require_once __DIR__.'/../layout/header.php'; ?>
<!-- END HEADER -->
<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php require_once __DIR__.'/../layout/sidebar.php'; ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href=""></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#"> Hệ đào tạo </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php require_once  __DIR__ .'/../layout/notyfi.php' ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i> Danh sách
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead class="flip-content">
                                <tr>
                                 
                                    <th width="">Mã đề tài</th>
                                    <th width="">Tên đề tài</th>
                                    <th width="">Sở hữu (x: Chưa sở hữu, v: Đã sở hữu)</th>
                                    <th width="">Tình trạng</th>
                                    <?php if ($_SESSION['table'] != "tbl_sinhvien") { ?>
                                        <th class="">Thao tác </th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($detai as $item) :?>
                                    <tr>
                                       
                                        <td><span> <?php echo $item['madetai'] ?> </span></td>
                                        <td><span> <?php echo $item['tendetai'] ?> </span></td>
                                        <td><span> <?= ($item['selected'] == 0) ? "x" : "<b>v</b>" ?> </span></td>
                                        <td><span> <?= ($item['status'] == 0) ? "Chưa duyệt" : "Đã duyệt" ?> </span></td>

                                        <?php if ($_SESSION['table'] != "tbl_sinhvien") { ?>
                                            <td class="">
                                                <a href="delete.php?id=<?php echo $item['id'] ?>" class="btn btn-xs red" onclick="return showAlert()"><i class="fa fa-trash-o"></i></a>
                                                <a href="update.php?id=<?php echo $item['id'] ?>" class="btn btn-xs green"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach;  ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php echo $pagi->getListpage("page") ?>
                </div>

            </div>

            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>
