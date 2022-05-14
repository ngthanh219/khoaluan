<?php
    $title = " Cập nhật đề tài " ;
    $modules = "detai";
    require_once __DIR__.'/../autoload.php';
    
    $id = getValue("id", "GET", "");
    $editDetai = $db->fetchOne("tbl_detai", (int) $id);
    
    if (count($editDetai) == 0) {
        redirect('/admin/404.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $madetai       = getValue("madetai", "POST", "");
        $tendetai      = getValue("tendetai", "POST", "");
        $status        = getValue("status", "POST", "");

        $errors = [];

        if ($madetai == '') {
            $errors['madetai']  = ' Mời bạn nhập mã đề tài';
        }

        if ($tendetai == '') {
            $errors['tendetai']  = ' Mời bạn nhập tên đề tài';
        } else {
            if ($madetai != $editDetai['madetai']) {
                $checkEsist = $db->fetchOne("tbl_detai", "madetai = '" . $madetai . "' ");

                if ($checkEsist && count($checkEsist) > 0) {
                    $errors['madetai']  = ' Mã đề tài  đã tồn tại ' ;
                }
            }
        }

        if ($_SESSION["table"] == "tbl_quanly") {
            if ($status == '') {
                $errors['status']  = ' Mời bạn chọn tình trạng';
            }
        }
        
        if (empty($errors)) {
            $data = [
                'madetai' => $madetai,
                'tendetai' => $tendetai,
                'status' => $status
            ];
            
            $update = $db->update("tbl_detai", $data, "id = " . $id);

            if ($update) {
                $_SESSION['success'] = " Cập nhật thành công " ;
                redirect('/admin/detai');
            } else {
                $_SERVER['errors'] = " Cập nhật thất bại ";
                redirect('/admin/detai');
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
                        <a href="#"> Hệ đào tạo </a>
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
                                        <label class="col-md-2 control-label"> Tên đề tài <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tendetai" value="<?php echo $editDetai['tendetai'] ?>" placeholder=" VD :  Quản lý website ....  ">
                                            <?php if (isset($errors['tendetai']) && $errors['tendetai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tendetai'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã đề tài <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium" name="madetai" value="<?php echo $editDetai['madetai'] ?>" placeholder="decao">
                                            <?php if (isset($errors['madetai']) && $errors['madetai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['madetai'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if ($_SESSION["table"] == "tbl_quanly") { ?>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Tình trạng </label>
                                            <div class="col-md-4">
                                                <select name="status" class="form-control status">
                                                    <option value=""> -- Hãy chọn tình trạng -- </option>
                                                    <?php if ($editDetai["status"] == 0) { ?>
                                                        <option value="0" selected>Chưa duyệt</option>
                                                        <option value="1">Đã duyệt</option>
                                                    <?php } else { ?>
                                                        <option value="0">Chưa duyệt</option>
                                                        <option value="1" selected>Đã duyệt</option>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($errors['status']) && $errors['status'] != '') :?>
                                                <span class="help-block"
                                                    style="margin-bottom: -10px"><?php echo $errors['status'] ?></span>
                                                <?php endif; ?>
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
