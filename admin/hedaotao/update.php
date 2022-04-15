<?php
    $title = " Cập nhật hệ đào tạo " ;
    $modules = "hedaotao";
    require_once __DIR__.'/../autoload.php';
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editHedaotao = $db->fetchOne("tbl_hedaotao",(int)$id);
    //    dd($editChuyennganh);
    if (count($editHedaotao) == 0)
    {
        redirect('/admin/404.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $tenhedaotao      = getValue("tenhedaotao","POST",'');
        $mahedaotao       = getValue("mahedaotao","POST",'');


        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];
        if ($tenhedaotao == '')
        {
            $errors['tenhedaotao']  = ' Mời bạn nhập tên hệ đào tao' ;
        }

        if ($mahedaotao == '')
        {
            $errors['mahedaotao']  = ' Mời bạn nhập mã hệ đào tạo' ;
        }
        else
        {

            if($mahedaotao != $editHedaotao['mahedaotao'])
            {
                // kiểm tra xem mã khoa đã tồn tại chưa
                // nếu có thì show lỗi
                $checkEsist = $db->fetchOne("tbl_hedaotao","mahedaotao = '".$mahedaotao."' ");
                if ($checkEsist  && count($checkEsist) > 0)
                {
                    $errors['mahedaotao']  = ' Mã hệ đào tạo  đã tồn tại ' ;
                }
            }
        }


        // kiểm tra nếu mảng errors = null thì  tiến hành xử lý
        // ngược lại báo lỗi
        if (  empty($errors))
        {
            // gan các giá trị vào một mảng data
            $data =
                [
                    'tenhedaotao'      => $tenhedaotao,
                    'mahedaotao'       => $mahedaotao
                ];
            //            dd($data);die;

            // insert
            $update = $db->update("tbl_hedaotao",$data, "id = ".$id);
            if($update)
            {
                $_SESSION['success'] = " Cập nhật thành công " ;
                redirect('/admin/hedaotao');
            }
            else
            {
                $_SERVER['errors'] = " Cập nhật thất bại ";
                redirect('/admin/hedaotao');
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
                                        <label class="col-md-2 control-label"> Hệ đào tạo <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tenhedaotao" value="<?php echo $editHedaotao['tenhedaotao'] ?>" placeholder=" VD :  đào tạo đại học  ">
                                            <?php if (isset($errors['tenhedaotao']) && $errors['tenhedaotao'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenhedaotao'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã hệ <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium" name="mahedaotao" value="<?php echo $editHedaotao['mahedaotao'] ?>" placeholder="hdt">
                                            <?php if (isset($errors['mahedaotao']) && $errors['mahedaotao'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['mahedaotao'] ?></span>
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
