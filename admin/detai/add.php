<?php
    $title = " Thêm mới đề tài " ;
    $modules = "detai";
    require_once __DIR__.'/../autoload.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tendetai = getValue("tendetai", "POST", '');
        $madetai = getValue("madetai", "POST", '');
        $errors = [];

        if ($tendetai == '') {
            $errors['tendetai']  = ' Mời bạn nhập tên đề tài' ;
        }

        if ($madetai == '') {
            $errors['madetai']  = ' Mời bạn nhập mã đề tài' ;
        } else {
            $checkEsist = $db->fetchOne("tbl_detai", "madetai = '" . $madetai . "' ");

            if ($checkEsist  && count($checkEsist) > 0) {
                $errors['madetai']  = ' Mã đề tài  đã tồn tại ' ;
            }
        }
        
        if (empty($errors)) {
            $data = [
                'tendetai' => $tendetai,
                'madetai' => $madetai
            ];
            
            $insert = $db->insert("tbl_detai", $data);

            if ($insert) {
                $_SESSION['success'] = " Thêm mới thành công " ;

                redirect('/admin/detai');
            } else {
                $_SERVER['errors'] = " Thêm mới thất bại ";
            }
        }
    }
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
                        <a href="#"> đề tài </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="index.php" class="btn red" style="color: white"> <i class="icon-logout"></i>  Trở về </a>
                    </li>
                </ul>
                <?php require_once __DIR__ .'/../layout/notyfi.php' ;?>
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box green ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>  <?php echo isset($title) ? $title : '' ?>
                            </div>

                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" method="POST">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã đề tài <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium" name="madetai" value="<?php echo isset($madetai) ? $madetai : '' ?>" placeholder="Mã đề tài">
                                            <?php if (isset($errors['madetai']) && $errors['madetai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['madetai'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Đề tài <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tendetai" value="<?php echo isset($tendetai) ? $tendetai : '' ?>" placeholder=" VD :  Đề tài xây dựng website ...  ">
                                            <?php if (isset($errors['tendetai']) && $errors['tendetai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tendetai'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($_SESSION["table"] == "tbl_quanly") { ?>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Tình trạng <span class="text-danger">(*)</span>  </label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="status">
                                                    <option value="0">Chưa duyệt</option>
                                                    <option value="1">Đã duyệt</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php echo renderAction() ?>
                            </form>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                    <!-- BEGIN SAMPLE FORM PORTLET-->

                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
    <?php require_once __DIR__.'/../layout/footer.php'; ?>
