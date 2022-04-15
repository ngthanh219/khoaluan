<?php
    $title = " Thêm mới giáo viên ";
    $modules ="giaovien";
    require_once __DIR__.'/../autoload.php';
    $khoa        = $db->query("tbl_khoa","*","");
    $chuyennganh = $db->query("tbl_chuyennganh","*","");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $id_makhoa                     = getValue("id_makhoa","POST",'');
        $id_machuyennganh              = getValue("id_machuyennganh","POST",'');
        $tengiaovien                   = getValue("tengiaovien","POST",'');
       
        $email                         = getValue("email","POST",'');
        $sodienthoai                   = getValue("sodienthoai","POST",'');
        $quequan                       = getValue("quequan","POST",'');
        $gioithieu                     = getValue("gioithieu","POST",'');
        $trangthai                     = getValue("trangthai","POST",'');
        $ngaysinh                     = getValue("ngaysinh","POST",'');

        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];

        if($trangthai == '')
        {
            if ($id_makhoa == '' && $id_machuyennganh == '')
            {
                $errors['id_makhoa']  = ' Mời bạn chọn mã khoa ' ;
                $errors['id_machuyennganh']  = ' Mời bạn chọn  mã chuyên ngành' ;
            }
        }

        if ($tengiaovien == '')
        {
            $errors['tengiaovien']  = ' Mời bạn nhập tên giáo viên ' ;
        }

        if ($ngaysinh == '')
        {
            $errors['ngaysinh']  = ' Mời bạn chọn ngày sinh ' ;
        }
      

        if ($email  == '')
        {
            $errors['email']  = ' Mời bạn nhập email ' ;
        }
        else
        {
            // kiểm tra xem email  đã tồn tại chưa
            // nếu có thì show lỗi
            $checkEsist = $db->fetchOne("tbl_giaovien","email = '".$email."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['email']  = ' Email đã tồn tại ' ;
            }
        }

        if ($quequan  == '')
        {
            $errors['quequan']  = ' Mời bạn nhập que quan ' ;
        }

        if ($gioithieu  == '')
        {
            $errors['gioithieu']  = ' Mời bạn nhập giới thiệu ' ;
        }
        if ($sodienthoai  == '')
        {
            $errors['sodienthoai']  = ' Mời bạn nhập số điện thoại' ;
        }
        else
        {
            $checkEsist = $db->fetchOne("tbl_giaovien"," sodienthoai = '".$sodienthoai."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['sodienthoai']  = ' sodienthoai đã tồn tại ' ;
            }
        }

        if ( isset ($_FILES['hinhanh']) && $_FILES['hinhanh']['name'] != NULL)
        {
            $file_name = $_FILES['hinhanh']['name'];
            $file_tmp  = $_FILES['hinhanh']['tmp_name'];
            $file_type = $_FILES['hinhanh']['type'];
            $file_erro = $_FILES['hinhanh']['error'];
            if ($file_erro == 0)
            {
                $hinhanh = $file_name;
            }
        }
        else
        {
            $errors['hinhanh'] = "  Mời bạn chọn hình  ảnh!!! ";
        }

        // kiểm tra nếu mảng errors = null thì  tiến hành xử lý
        // ngược lại báo lỗi
        if (  empty($errors))
        {
            // gan các giá trị vào một mảng data
            $data =
            [
                'id_makhoa'                    => $id_makhoa ,
                'id_machuyennganh'             => $id_machuyennganh,
                'tengiaovien'                  => $tengiaovien,
                
                'gioithieu'                    => $gioithieu,
                'email'                        => $email,
                'sodienthoai'                  => $sodienthoai,
                'hinhanh'                      => $hinhanh,
                'quequan'                      => $quequan,
                'trangthai'                      => $trangthai,
                'ngaysinh'                      => $ngaysinh

            ];
//            dd($data);
            // insert
            $insert = $db->insert("tbl_giaovien",$data);
            if($insert)
            {
                
                move_uploaded_file($file_tmp,ROOT.$hinhanh);
                $_SESSION['success'] = " Thêm mới thành công " ;
                redirect('/admin/giaovien');
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
                        <div style="" class="box-action">
                            <a href="#info"  class="actionscoll"><i class="fa fa-search"></i> Thông tin </a>
                            <a href="#image"  class="actionscoll"><i class="fa fa-search"></i> Hình ảnh </a>
                            <a href="#desc" class="actionscoll"><i class="fa fa-search"></i>  Giới thiệu  </a>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-body" id="info">
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label"> Khoa  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_makhoa" class="form-control makhoa">
                                                <option value=""> --  Mời bạn chọn khoa ! -- </option>
                                                <?php foreach($khoa as $item) : ?>
                                                    <option value="<?php echo $item['makhoa'] ?>" <?php echo isset($id_makhoa) && $id_makhoa == $item['makhoa'] ? "selected='selected'" : "" ?>><?php echo $item['tenkhoa'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_makhoa']) && $errors['id_makhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_makhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label machuyennganh"> Chuyên ngành  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_machuyennganh" class="form-control chuyennganh">
                                                <option value=""> --  Mời bạn chọn chuyên ngành ! -- </option>
                                                <?php foreach($chuyennganh as $item) : ?>
                                                    <option value="<?php echo $item['machuyennganh'] ?>" <?php echo isset($id_machuyennganh) && $id_machuyennganh == $item['machuyennganh'] ? "selected='selected'" : "" ?>><?php echo $item['tenchuyennganh'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_machuyennganh']) && $errors['id_machuyennganh'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_machuyennganh'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Tên Giáo viên   </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="tengiaovien" value="<?php echo isset($tengiaovien) ? $tengiaovien : '' ?>" placeholder=" VD : Nguyễn Văn A ">
                                            <?php if (isset($errors['tengiaovien']) && $errors['tengiaovien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tengiaovien'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Ngày sinh </label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control input-inline input-medium" value="<?php echo isset($ngaysinh) ? $ngaysinh : '' ?>"  name="ngaysinh" placeholder="12-12-2012"  >
                                            <?php if (isset($errors['ngaysinh']) && $errors['ngaysinh'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['ngaysinh'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">  Đơn vị công tác </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?php echo isset($trangthai) ? $trangthai : '' ?>"  name="trangthai" placeholder=" Đơn vị công tác"  >
                                            <?php if (isset($errors['trangthai']) && $errors['trangthai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['trangthai'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Email  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="email" value="<?php echo isset($email) ? $email : '' ?>" placeholder=" VD : admin@gmail.com ">
                                            <?php if (isset($errors['email']) && $errors['email'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['email'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Quê Quán   </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="quequan" value="<?php echo isset($quequan) ? $quequan : '' ?>" placeholder=" VD : Quỳnh lưu - Nghệ An  ">
                                            <?php if (isset($errors['quequan']) && $errors['quequan'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['quequan'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Số điện thoại <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="sodienthoai" value="<?php echo isset($sodienthoai) ? $sodienthoai : '' ?>" >
                                            <?php if (isset($errors['sodienthoai']) && $errors['sodienthoai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['sodienthoai'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="image" style="border: 1px solid #dedede;padding: 20px;margin: 20px">
                                        <label>  Hình ảnh </label>
                                        <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        Browse… <input type="file" id="imgInp" name="hinhanh">
                                                    </span>
                                                </span>
                                            <input type="text" class="form-control" readonly value=" Chưa có ảnh nào được chọn  ">
                                        </div>
                                        <img id='img-upload' src="http://via.placeholder.com/200x200" alt="" class="img img-responsive" style="width: 300px;height: 300px;"/>
                                        <?php if (isset($errors['hinhanh']) && $errors['hinhanh'] != '') :?>
                                            <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['hinhanh'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group" id="desc">

                                        <h5 class="col-sm-10" style="padding-left: 31px"> <label>  Giới thiệu  </label></h5>
                                        <div class="col-sm-11" style="padding-left:30px">
                                            <textarea name="gioithieu" id="summernote" cols="130"  rows="10"><?php echo isset($gioithieu) ? $gioithieu : '' ?></textarea>
                                            <?php if (isset($errors['gioithieu']) && $errors['gioithieu'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['gioithieu'] ?></span>
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
