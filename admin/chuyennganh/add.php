<?php
    $title = " Thêm mới chuyên ngành " ;
     $modules = "chuyennganh";
    require_once __DIR__.'/../autoload.php';
    // lay id khoa can update

    // lay danh sach khoa
    $khoa = $db->query("tbl_khoa","*","");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $tenchuyennganh      = getValue("tenchuyennganh","POST",'');
        $machuyennganh       = getValue("machuyennganh","POST",'');
        $mota                = getValue("mota","POST",'');
        $id_makhoa           = getValue("id_makhoa","POST",'');

        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];
        if ($tenchuyennganh == '')
        {
            $errors['tenchuyennganh']  = ' Mời bạn nhập tên chuyên ngành ' ;
        }

        if ($machuyennganh == '')
        {
            $errors['machuyennganh']  = ' Mời bạn nhập mã khoa' ;
        }
        else
        {

            // kiểm tra xem mã khoa đã tồn tại chưa
            // nếu có thì show lỗi
            $checkEsist = $db->fetchOne("tbl_chuyennganh","machuyennganh = '".$machuyennganh."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['machuyennganh']  = ' Mã chuyên ngành  đã tồn tại ' ;
            }
        }

      

        // kiểm tra nếu mảng errors = null thì  tiến hành xử lý
        // ngược lại báo lỗi
        if (  empty($errors))
        {
            // gan các giá trị vào một mảng data
            $data =
                [
                    'tenchuyennganh'      => $tenchuyennganh ,
                    'machuyennganh'       => $machuyennganh,
                    'mota'                => $mota,
                    'id_makhoa'           => $id_makhoa
                ];
//            dd($data);die;

            // insert
            $insert = $db->insert("tbl_chuyennganh",$data);
            if($insert)
            {
                $_SESSION['success'] = " Thêm mới thành công " ;
                redirect('/admin/chuyennganh');
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
                        <a href="#">Page Layouts</a>
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
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label"> Khoa  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_makhoa" class="form-control">
                                                <?php foreach($khoa as $item) : ?>
                                                    <option value="<?php echo $item['makhoa'] ?>"> <?php echo $item['tenkhoa'] ?>  </option>
                                                <?php endforeach ; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Chuyên ngành <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tenchuyennganh" placeholder=" VD :  Mạng máy tính " value="<?php echo isset($tenchuyennganh) ? $tenchuyennganh : '' ?>">
                                            <?php if (isset($errors['tenchuyennganh']) && $errors['tenchuyennganh'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenchuyennganh'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã chuyên ngành <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium" name="machuyennganh" placeholder="MSP01212" value="<?php echo isset($machuyennganh) ? $machuyennganh : '' ?>">
                                            <?php if (isset($errors['machuyennganh']) && $errors['machuyennganh'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['machuyennganh'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                

                                    <div class="form-group" id="desc">
                                        <label class="col-md-2 control-label"> Mô tả  </label>

                                        <div class="col-sm-8" style="">
                                            <textarea name="mota" id="summernote" cols="90"  rows="10"><?php echo isset($tenchuyennganh) ? $tenchuyennganh : '' ?></textarea>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script>
        $(function(){
            $('#summernote').summernote();
        })

    </script>