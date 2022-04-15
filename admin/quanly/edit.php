<?php
    $title = "  Thông tin quản lý  " ;
     $modules = "quanly";
    require_once __DIR__.'/../autoload.php';
    // lay id khoa can update

    // lay danh sach khoa

     $id = getValue("id","GET",'');
     if($id != $_SESSION['admin_id'])
     {
        $_SESSION['errors'] = ' Bạn không thể đổi mật khẩu của người khác ';
         redirect('/admin/quanly');
     }
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editQuanly = $db->fetchOne("tbl_quanly",(int)$id);

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $email      = getValue("email","POST",'');
        $tenquanly  = getValue("tenquanly","POST",'');
        $matkhaucu    = getValue("matkhau","POST",'');
        $matkhaumoi = getValue("matkhaumoi","POST",'');
        $xn_matkhau = getValue("xn_matkhau","POST",'');


        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];

        

        if ($tenquanly == '')
        {
            $errors['tenquanly']  = ' Mời bạn nhập tên quản lý' ;
        }
        echo $matkhaucu;

        if ($matkhaucu != '')
        {
            if ($matkhaucu != $editQuanly['matkhau'])
            {
                $errors['matkhau1'] = ' Mat khau khong dung ';
            }

            if(strlen($matkhaucu) <  6)
            {

                $errors['matkhau2'] = ' Mat khau phai lon hon 6 ky tu';
            }
        }

        if ($matkhaumoi != '')
        {
            if(strlen($matkhaumoi) <  6)
            {
                $errors['matkhaumoi'] = ' Mat khau moi  phai lon hon 6 ky tu';
            }
        }
        

       if($xn_matkhau != '')
        {
            if($xn_matkhau != $matkhaumoi)
            {
                $errors['xn_matkhau'] = ' Mật khẩu không khớp ';
            }
        }


        if ($email == '')
        {
            $errors['email']  = ' Mời bạn nhập email ' ;
        }
        else
        {
            if($email != $editQuanly['email'])
            {
                // kiểm tra xem mã khoa đã tồn tại chưa
                // nếu có thì show lỗi
                $checkEsist = $db->fetchOne("tbl_quanly","email = '".$email."' ");
                if ($checkEsist  && count($checkEsist) > 0)
                {
                    $errors['email']  = ' Email  đã tồn tại ' ;
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
                'email'      => $email ,
                'tenquanly'  => $tenquanly,
                'matkhau'    => $matkhaumoi,
            ];

        
            // update
            $update = $db->update("tbl_quanly",$data,"id = ".$id);
            if($update > 0)
            {
                 $_SESSION['success'] = ' cap nhat thanh cong ';
                redirect('/admin/quanly');
            }
            else
            {   
                $_SESSION['errors'] = " Không có gì thay đổi ";
                redirect('/admin/quanly');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
<html lang="en">
<head>
    <?php require_once __DIR__.'/../layout/head.php'; ?>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
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
                        <a href="#"> Quản lý </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="index.php" class="btn red" style="color: white"> <i class="icon-logout"></i>  Trở về </a>
                    </li>
                </ul>

                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box green ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>  <?php echo isset($title) ? $title : '' ?>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" action="" method="POST">
                                
                                <div class="form-body">
                                   <div class="form-group">
                                        <label class="col-md-2 control-label"> Họ tên  <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tenquanly" placeholder=" VD : thuymy " value="<?php echo isset($editQuanly) ? $editQuanly['tenquanly'] : ''?>">
                                            <?php if (isset($errors['tenquanly']) && $errors['tenquanly'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenquanly'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="email" placeholder=" VD :  admin@gmail.com " value="<?php echo isset($editQuanly) ?  $editQuanly['email'] : '' ?>">
                                            <?php if (isset($errors['email']) && $errors['email'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['email'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mật khẩu cũ   <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" class="form-control" name="matkhau" placeholder=" VD :  ********" value="<?php echo $editQuanly['matkhau']?> ">
                                            <?php if (isset($errors['matkhau1']) && $errors['matkhau1'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['matkhau1'] ?></span>
                                            <?php endif; ?>
                                            <?php if (isset($errors['matkhau2']) && $errors['matkhau2'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['matkhau2'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mật khẩu mới    <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" class="form-control" name="matkhaumoi" placeholder=" VD :  ********" value="">
                                            <?php if (isset($errors['matkhaumoi']) && $errors['matkhaumoi'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['matkhaumoi'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Xác nhận  Mật khẩu   <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" class="form-control" name="xn_matkhau" placeholder=" VD :  ********" value="">
                                            <?php if (isset($errors['xn_matkhau']) && $errors['xn_matkhau'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['xn_matkhau'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"><i class="fa fa-cloud"></i> Lưu </button>
                                <button type="reset" class="btn green"><i class="fa fa-refresh"></i> Làm mới </button>
                            
                            </div>
                        </div>
                    </div>
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