<?php
    $title = " Thêm mới hội đồng ";
    $modules ="hoidong";
    require_once __DIR__.'/../autoload.php';

    $giaovien = $db->query("tbl_giaovien","*","");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $id_chutich  = getValue("id_chutich","POST",'');
        $id_thuky    = getValue("id_thuky","POST",'');
        $tenhoidong  = getValue("tenhoidong","POST",'');
        $id_phanbien = getValue("id_phanbien","POST",'');
        $id_uyvien   = getValue("id_uyvien","POST",'');
       

        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];


        if ($tenhoidong == '')
        {
            $errors['tenhoidong']  = ' Mời bạn nhập tên hoi dong' ;
        }


        if ($id_thuky == '')
        {
            $errors['id_thuky']  = ' Mời bạn chọn thu ky ' ;
        }
        else
        {
            if($id_thuky == $id_chutich || $id_thuky == $id_phanbien || $id_thuky == $id_uyvien)
            {
                $errors['id_thuky']  = ' Một giáo viên không được làm 2 chức vụ trong 1 hội đồng ' ;
            }
        }
    

        if ($id_chutich  == '')
        {
            $errors['id_chutich']  = ' Mời bạn chon chu tich  ' ;
        }
         else
        {
            if($id_thuky == $id_chutich || $id_thuky == $id_chutich || $id_thuky == $id_chutich)
            {
                $errors['id_chutich']  = ' Một giáo viên không được làm 2 chức vụ trong 1 hội đồng ' ;
            }
        }

        if ($id_phanbien  == '')
        {
            $errors['id_phanbien']  = ' Mời bạn chon gv phan bien ' ;
        }
         else
        {
            if($id_phanbien == $id_chutich || $id_thuky == $id_phanbien || $id_phanbien == $id_uyvien)
            {
                $errors['id_phanbien']  = ' Một giáo viên không được làm 2 chức vụ trong 1 hội đồng ' ;
            }
        }

        if ($id_uyvien  == '')
        {
            $errors['id_uyvien']  = ' Mời bạn chon uy vien' ;
        }
         else
        {
            if($id_uyvien == $id_chutich || $id_uyvien == $id_phanbien || $id_thuky == $id_uyvien)
            {
                $errors['id_uyvien']  = ' Một giáo viên không được làm 2 chức vụ trong 1 hội đồng ' ;
            }
        }
        

        // kiểm tra nếu mảng errors = null thì  tiến hành xử lý
        // ngược lại báo lỗi
        if (  empty($errors))
        {
            // gan các giá trị vào một mảng data
            $data =
            [
                'tenhoidong'                    => $tenhoidong ,
                'id_chutich'             => $id_chutich,
                'id_phanbien'                  => $id_phanbien,
                
                'id_thuky'                    => $id_thuky,
                'id_uyvien'                        => $id_uyvien

            ];
//            dd($data);
            // insert
            $insert = $db->insert("tbl_hoidong",$data);
            if($insert)
            {
                
                $_SESSION['success'] = " Thêm mới thành công " ;
                redirect('/admin/hoidong');
            }
            else
            {
                $_SERVER['errors'] = " Thêm mới thất bại ";
            }
        }
    }

?>
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload{
        width: 100%;
    }
    .box-action
    {
        position: fixed;
        right: 41px;
        z-index: 9;
        top:40%;
        /*transform: translateY(-50%);*/
        /*top:50%;*/

    }
    .box-action a
    {
        display: block;
        border: 1px solid #dedede;
        margin-bottom: 5px;
        padding: 5px;
        background-color: white;
        color: #000;
    }
    .box-action a:hover,.box-action a:focus
    {
        color: red;
        text-decoration: none;
    }
</style>
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
                        <a href="#"> Giáo viên </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="index.php" class="btn red" style="color: white"> <i class="fa fa-plus"></i>  Trở về </a>
                    </li>
                </ul>
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box green ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>  <?php echo isset($title) ?  $title : '' ?>
                            </div>

                        </div>
                       
                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-body" id="info">
                                  <div class="form-group">
                                        <label class="col-md-2 control-label"> Tên Hội đồng   </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="tenhoidong" value="<?php echo isset($tenhoidong) ? $tenhoidong : '' ?>" placeholder=" VD : Hội đồng 1 ">
                                            <?php if (isset($errors['tenhoidong']) && $errors['tenhoidong'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenhoidong'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label"> Chủ tịch  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_chutich" class="form-control makhoa">
                                                <option value=""> --  Mời bạn chọn chủ tịch ! -- </option>
                                                <?php foreach($giaovien as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($id_chutich) && $id_chutich == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['tengiaovien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_chutich']) && $errors['id_chutich'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_chutich'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label machuyennganh"> Thư ký  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_thuky" class="form-control">
                                                <option value=""> --  Mời bạn chọn thư ký ! -- </option>
                                                <?php foreach($giaovien as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($id_thuky) && $id_thuky == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['tengiaovien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_thuky']) && $errors['id_thuky'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_thuky'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                     <div class="form-group" id="info">
                                        <label class="col-md-2 control-label machuyennganh"> Phản biện  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_phanbien" class="form-control">
                                                <option value=""> --  Mời bạn chọn gv phản biện ! -- </option>
                                                <?php foreach($giaovien as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($id_phanbien) && $id_phanbien == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['tengiaovien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_phanbien']) && $errors['id_phanbien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_phanbien'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                     <div class="form-group" id="info">
                                        <label class="col-md-2 control-label"> Uỷ viên  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_uyvien" class="form-control">
                                                <option value=""> --  Mời bạn chọn uỷ viên ! -- </option>
                                                <?php foreach($giaovien as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($id_uyvien) && $id_uyvien == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['tengiaovien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_uyvien']) && $errors['id_uyvien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_uyvien'] ?></span>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script>
        $(function(){
            $('#summernote').summernote();
        })

    </script>
    <script>
        $(function () {
            $(".makhoa").change(function (event) {
                event.preventDefault();
                event.stopPropagation();
                // lay ma khoa
                let $makhoa = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url     : url + '/admin/xulyajax/laychuyennganh.php',
                    type    : "POST",
                    data    : ({ 'makhoa' : $makhoa }),
                    success : function(responsive)
                    {
                        $(".chuyennganh").html("");
                        $(".chuyennganh").append(responsive);
                    }
                })
                console.log(url);
            })
        })
    </script>
