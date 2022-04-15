<?php
    $modules = 'nienkhoa';
    $title = " Cập nhật  Niên khóa   " ;
    require_once __DIR__.'/../autoload.php';
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editNienkhoa = $db->fetchOne("tbl_nienkhoa",(int)$id);
/**
 *  xử lý thêm mới khoa
 */
    // kiem tra neu submit form thi thuc hien tiep
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $tenkhoa      = getValue("tenkhoa","POST",'');
    
        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];
    
        if ($tenkhoa == '')
        {
            $errors['tenkhoa']  = ' Mời bạn nhập tên niên khóa ' ;
        }
        else
        {

            // kiểm tra xem mã khoa đã tồn tại chưa
            // nếu có thì show lỗi
            if ($tenkhoa != $editNienkhoa['tenkhoa'])
            {
                $checkEsist = $db->fetchOne("tbl_nienkhoa","tenkhoa = '".$tenkhoa."' ");
                if ($checkEsist  && count($checkEsist) > 0)
                {
                    $errors['tenkhoa']  = ' Tên niên khóa  đã tồn tại ' ;
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
                'tenkhoa'      => $tenkhoa ,
            ];

            // insert
            $update = $db->update("tbl_nienkhoa",$data,"id = ". $id);
            if($update > 0)
            {
                $_SESSION['success'] = "Cập nhật thành công " ;
                redirect('/admin/nienkhoa');
            }
            else
            {
                $_SESSION['errors'] = "Cập nhật thất bại ";
                redirect('/admin/nienkhoa');
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
                        <a href="index.php"> Niên khóa  </a>
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
                                        <label class="col-md-2 control-label"> Niên khóa  <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tenkhoa" placeholder=" VD : 2016 -2018 " value="<?php echo $editNienkhoa['tenkhoa'] ?>">
                                            <?php if (isset($errors['tenkhoa']) && $errors['tenkhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenkhoa'] ?></span>
                                            <?php endif; ?>
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
