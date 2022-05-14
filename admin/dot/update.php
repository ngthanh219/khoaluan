<?php
    $title = " Cập nhật đợt " ;
    $modules = "detai";
    require_once __DIR__.'/../autoload.php';
    
    $id = getValue("id", "GET", "");
    $editDot = $db->fetchOne("tbl_dot", (int) $id);
    
    if (count($editDot) == 0) {
        redirect('/admin/404.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dot = getValue("dot", "POST", '');
        $batdau = getValue("batdau", "POST", '');
        $ketthuc = getValue("ketthuc", "POST", '');
        $errors = [];

        if ($dot == '') {
            $errors['dot']  = ' Mời bạn nhập đợt đồ án' ;
        }

        if ($ketthuc == '') {
            $errors['ketthuc']  = ' Mời bạn nhập thời gian kết thúc' ;
        }

        if ($batdau == '') {
            $errors['batdau']  = ' Mời bạn nhập thời gian bắt đầu' ;
        } else {
            $checkEsist = $db->fetchOne("tbl_dot", "dot = '" . $dot . "' AND batdau = '" . $batdau . "' AND ketthuc = '" . $ketthuc . "' AND id != " . $id);

            if ($checkEsist  && count($checkEsist) > 0) {
                $errors['dot']  = ' Thông tin  đã tồn tại ' ;
            }
        }
        
        if (empty($errors)) {
            $data = [
                'dot' => $dot,
                'batdau' => $batdau,
                'ketthuc' => $ketthuc
            ];
            
            $update = $db->update("tbl_dot", $data, "id = " . $id);

            if ($update) {
                $_SESSION['success'] = " Cập nhật thành công " ;
                redirect('/admin/dot');
            } else {
                $_SERVER['errors'] = " Cập nhật thất bại ";
                redirect('/admin/dot');
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
                                        <label class="col-md-2 control-label"> Tên đợt <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="dot" value="<?php echo $editDot['dot'] ?>" placeholder=" ....  ">
                                            <?php if (isset($errors['dot']) && $errors['dot'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['dot'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Thời gian bắt đầu <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="batdau" value="<?php echo $editDot['batdau'] ?>" placeholder=" VD :  Thời gian bắt đầu">
                                            <?php if (isset($errors['batdau']) && $errors['batdau'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['batdau'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Thời gian kết thúc <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="ketthuc" value="<?php echo $editDot['ketthuc'] ?>" placeholder=" VD :  Thời gian kết thúc ">
                                            <?php if (isset($errors['ketthuc']) && $errors['ketthuc'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['ketthuc'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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
