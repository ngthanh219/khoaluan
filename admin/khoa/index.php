<?php
    $modules = 'khoa';
    $title = " Danh sách khoa ";
    require_once __DIR__.'/../autoload.php';

    // lay danh sach khoa
    $Khoa = $pagi->pagination("tbl_khoa",'','page',4);

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
                        <a href="index.php"> Khoa </a>
                    </li>
                   
                    <li>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
          
             <?php require_once __DIR__.'/../layout/notyfi.php' ;?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i> Danh sách
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <thead class="flip-content">
                                <tr>
                                   
                                    <th> Tên khoa </th>
                                    <th> Mã Khoa </th>
                                    <th> Ngày thành lập </th>
                                    <th style="width: 50%"> Mô tả </th>
                                    <th> Thao tác </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  foreach($Khoa as $item) :?>
                                    <tr>
                                      
                                        <td>
                                            <span> <?php echo $item['tenkhoa'] ?> </span>
                                        </td>
                                        <td> <?php echo $item['makhoa']  ?> </td>
                                        <td> <?php echo $item['ngaythanhlap'] ?> </td>
                                        <td>
                                            <?php if($item['mota'] != null) : ?>
                                                <a href="javascript:;"><?php echo $item['mota'] ?></a>
                                            <?php else : ?>
                                                <a href="javascript:;"> Chưa cập nhật </a>
                                            <?php endif ; ?>
                                        </td>
                                        <td class="">
                                            <a href="delete.php?id=<?php echo $item['id'] ?>" class="btn btn-xs red" onclick="return showAlert()"><i class="fa fa-trash-o"></i></a>
                                            <a href="update.php?id=<?php echo $item['id'] ?>" class="btn btn-xs green"><i class="fa fa-pencil"></i></a>
                                        </td>

                                    </tr>
                                   <?php endforeach;  ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            <?php echo $pagi->getListpage("page") ?>
                        </div>
                    </div>

                </div>

            </div>

            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>