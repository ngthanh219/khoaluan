<?php
    $modules = 'khoa';
    $title = " Thêm mới khoa  " ;
    require_once __DIR__.'/../autoload.php';

/**
 *  xử lý thêm mới khoa
 */
    // kiem tra neu submit form thi thuc hien tiep
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $tenkhoa      = getValue("tenkhoa","POST",'');
        $makhoa       = getValue("makhoa","POST",'');
        $namthanhlap  = getValue("namthanhlap","POST",'');
        $mota         = getValue("mota","POST",'');

        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];
        if ($tenkhoa == '')
        {
            $errors['tenkhoa']  = ' Mời bạn nhập tên khoa' ;
        }

        if ($makhoa == '')
        {
            $errors['makhoa']  = ' Mời bạn nhập mã khoa' ;
        }
        else
        {

            // kiểm tra xem mã khoa đã tồn tại chưa
            // nếu có thì show lỗi
            $checkEsist = $db->fetchOne("tbl_khoa","makhoa = '".$makhoa."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['makhoa']  = ' Mã khoa đã tồn tại ' ;
            }
        }

        if ($namthanhlap == '')
        {
            $errors['namthanhlap']  = ' Mời bạn nhập ngàu thành lập' ;
        }

        // kiểm tra nếu mảng errors = null thì  tiến hành xử lý
        // ngược lại báo lỗi
        if (  empty($errors))
        {
            // gan các giá trị vào một mảng data
            $data =
            [
                'tenkhoa'      => $tenkhoa ,
                'makhoa'       => $makhoa,
                'ngaythanhlap' => $namthanhlap,
                'mota'         => $mota
            ];

            // insert
            $insert = $db->insert("tbl_khoa",$data);
            if($insert)
            {
                $_SESSION['success'] = " Thêm mới thành công " ;
                redirect('/admin/khoa');
            }
            else
            {
                $_SERVER['errors'] = " Thêm mới thất bại ";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
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
                        <a href="index.php"> Khoa </a>
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
                                        <label class="col-md-2 control-label"> Tên khoa <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tenkhoa" placeholder=" VD : Công nghệ thông tin " value="<?php echo isset($tenkhoa) ? $tenkhoa : '' ?>">
                                            <?php if (isset($errors['tenkhoa']) && $errors['tenkhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenkhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã khoa <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium" name="makhoa"  value="<?php echo isset($makhoa) ? $makhoa : '' ?>">
                                            <?php if (isset($errors['makhoa']) && $errors['makhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['makhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Ngày thành lập  <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control input-inline input-medium" name="namthanhlap" placeholder="20-10-2017"  value="<?php echo isset($makhoa) ? $namthanhlap : '' ?>">
                                            <?php if (isset($errors['namthanhlap']) && $errors['namthanhlap'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['namthanhlap'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group" id="desc">
                                        <label class="col-md-2 control-label"> Mô tả  </label>
                                        <div class="col-sm-9" style="">
                                            <textarea name="mota" id="summernote" cols="90"  rows="20"><?php echo isset($mota) ? $mota : '' ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                <?php echo renderAction() ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once __DIR__.'/../layout/footer.php'; ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script>
        $(function(){
            $('#summernote').summernote();
        })

    </script>
