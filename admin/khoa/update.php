<?php
$title = " Cập nhật mới khoa  " ;
 $modules = "khoa";
require_once __DIR__.'/../autoload.php';
    // lay id khoa can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editKhoa = $db->fetchOne("tbl_khoa",(int)$id);
    //    dd($editKhoa);
    if (count($editKhoa) == 0)
    {
        redirect('/admin/404.php');
    }

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
            // kiem tra xem gia tri ma khoa co thay doi khong
            // neu co thay doi thi phai kiem tra xem ma khoa co ton tai trong csdl chua
            // neu co thi bao thong bao
            if ($makhoa != $editKhoa['makhoa'])
            {
                $checkEsist = $db->fetchOne("tbl_khoa","makhoa = '".$makhoa."' ");
                if ($checkEsist  && count($checkEsist) > 0)
                {
                    $errors['makhoa']  = ' Mã khoa đã tồn tại ' ;
                }
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
            $update = $db->update("tbl_khoa",$data," id = $id");
            if ($update > 0)
            {
                redirect('/admin/khoa');
            }
            else
            {
                // thong bao loi
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
                                            <input type="text" class="form-control" name="tenkhoa" placeholder=" VD : Công nghệ thông tin " value="<?php echo $editKhoa['tenkhoa'] ?>">
                                            <?php if (isset($errors['tenkhoa']) && $errors['tenkhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenkhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã khoa <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium" name="makhoa"  value="<?php echo $editKhoa['makhoa'] ?>">
                                            <?php if (isset($errors['makhoa']) && $errors['makhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['makhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Ngày thành lập  <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control input-inline input-medium" name="namthanhlap" placeholder="20-10-2017"  value="<?php echo $editKhoa['ngaythanhlap']  ?>">
                                            <?php if (isset($errors['namthanhlap']) && $errors['namthanhlap'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['namthanhlap'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group" id="desc">
                                        <label class="col-md-2 control-label"> Mô tả  </label>
                                        <div class="col-sm-9" style="">
                                            <textarea name="mota" id="summernote" cols="90"  rows="20"><?php echo $editKhoa['mota'] ?></textarea>
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
