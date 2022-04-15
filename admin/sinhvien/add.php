<?php
    $title = " Thêm mới Sinh viên  ";
    $modules ="sinhvien";
    require_once __DIR__.'/../autoload.php';
    $khoa        = $db->query("tbl_khoa","*","");
    $chuyennganh = $db->query("tbl_chuyennganh","*","");
    $lop         = $db->query("tbl_lop","*","");
    $hedaotao    = $db->query("tbl_hedaotao","*","");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $id_makhoa                     = getValue("id_makhoa","POST",'');
        $id_machuyennganh              = getValue("id_machuyennganh","POST",'');
        $id_mahedaotao                 = getValue("id_mahedaotao","POST",'');
        $id_malop                      = getValue("id_malop","POST",'');
        $tensinhvien                   = getValue("tensinhvien","POST",'');
        $masinhvien                    = getValue("masinhvien","POST",'');
        $email                         = getValue("email","POST",'');
        $sodienthoai                   = getValue("sodienthoai","POST",'');
        $quequan                       = getValue("quequan","POST",'');
        $ngaysinh                       = getValue("ngaysinh","POST",'');
        $matkhau                        = getValue("matkhau","POST",'');

        // kiem tra xem gia tri nhap vao co trong hay khong ! neu trong thi gan
        //  vào mảng errors

        $errors = [];
        if ($id_makhoa == '')
        {
            $errors['id_makhoa']  = ' Mời bạn chọn mã khoa ' ;
        }

        if ($id_machuyennganh == '')
        {
            $errors['id_machuyennganh']  = ' Mời bạn chọn  mã chuyên ngành' ;
        }

        if ($tensinhvien == '')
        {
            $errors['tensinhvien']  = ' Mời bạn nhập tên sinh viên ' ;
        }
        if ($ngaysinh == '')
        {
            $errors['$ngaysinh']  = ' Mời bạn nhập ngày sinh sinh viên ' ;
        }
        if ($matkhau == '')
        {
            $errors['matkhau']  = ' Mời bạn nhập mật khẩu ' ;
        }
        if ($masinhvien == '')
        {
            $errors['masinhvien']  = ' Mời bạn nhập mã sinh viên' ;
        }
        else
        {

            // kiểm tra xem mã khoa đã tồn tại chưa
            // nếu có thì show lỗi
            $checkEsist = $db->fetchOne("tbl_sinhvien","masinhvien = '".$masinhvien."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['masinhvien']  = ' Mã giáo v đã tồn tại ' ;
            }
        }

        if ($email  == '')
        {
            $errors['email']  = ' Mời bạn nhập email ' ;
        }
        else
        {
            // kiểm tra xem email  đã tồn tại chưa
            // nếu có thì show lỗi
            $checkEsist = $db->fetchOne("tbl_sinhvien","email = '".$email."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['email']  = ' Email đã tồn tại ' ;
            }
        }

        if ($quequan  == '')
        {
            $errors['quequan']  = ' Mời bạn nhập que quan ' ;
        }

        if ($id_malop  == '')
        {
            $errors['id_malop']  = ' Mời bạn chọn mã lớp  ' ;
        }

        if ($id_mahedaotao  == '')
        {
            $errors['id_mahedaotao']  = ' Mời bạn chọn hệ đào tạo  ' ;
        }
        if ($sodienthoai  == '')
        {
            $errors['sodienthoai']  = ' Mời bạn nhập số điện thoại' ;
        }
        else
        {
            $checkEsist = $db->fetchOne("tbl_sinhvien"," sodienthoai = '".$sodienthoai."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['sodienthoai']  = ' sodienthoai đã tồn tại ' ;
            }
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
                    'id_malop'                     => $id_malop,
                    'id_mahedaotao'                => $id_mahedaotao,
                    'tensinhvien'                  => $tensinhvien,
                    'masinhvien'                   => $masinhvien,
                    'email'                        => $email,
                    'sodienthoai'                  => $sodienthoai,
                    
                    'quequan'                      => $quequan,
                    'ngaysinh'                      => $ngaysinh,
                    'matkhau'                       => $matkhau

                ];

            // insert
            $insert = $db->insert("tbl_sinhvien",$data);
            if($insert)
            {
               
                $_SESSION['success'] = " Thêm mới thành công " ;
        
                $db->update("tbl_lop","siso = siso + 1"," malop = '".$id_malop."' ");
                redirect('/admin/sinhvien');
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
                        <a href="index.php" class="btn red" style="color: white"> <i class="fa fa-plus"></i>  Trở về </a>
                    </li>
                </ul>
                <?php require_once  __DIR__.'/../layout/notyfi.php' ;?>
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
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-body" id="info">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Tên Sinh viên  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="tensinhvien" value="<?php echo isset($tensinhvien)  ? $tensinhvien : ''?>" placeholder=" VD : Nguyễn Văn A ">
                                            <?php if (isset($errors['tensinhvien']) && $errors['tensinhvien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tensinhvien'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã Sinh Viên  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"  name="masinhvien" placeholder="MSP01212" value="<?php echo isset($masinhvien)  ? $masinhvien : ''?>" >
                                            <?php if (isset($errors['masinhvien']) && $errors['masinhvien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['masinhvien'] ?></span>
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
                                        <label class="col-md-2 control-label"> Mật khẩu  </label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control input-inline input-medium" value="<?php echo isset($matkhau) ? $matkhau : '' ?>"  name="matkhau" placeholder="******"  >
                                            <?php if (isset($errors['matkhau']) && $errors['matkhau'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['matkhau'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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
                                        <label class="col-md-2 control-label"> Lớp   </label>
                                        <div class="col-md-4">
                                            <select name="id_malop" class="form-control lop">
                                                <option value=""> --  Mời bạn chọn lớp ! -- </option>

                                            </select>
                                            <?php if (isset($errors['id_malop']) && $errors['id_malop'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_malop'] ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <label class="col-md-2 control-label"> Hệ Đào Tạo   </label>
                                        <div class="col-md-3">
                                            <select name="id_mahedaotao" class="form-control">
                                                <option value=""> --  Mời bạn chọn hệ đào tạo ! -- </option>
                                                <?php foreach($hedaotao as $item) : ?>
                                                    <option value="<?php echo $item['mahedaotao'] ?>" <?php echo isset($id_mahedaotao) && $id_mahedaotao == $item['mahedaotao'] ? "selected='selected'" : "" ?>><?php echo $item['tenhedaotao'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_mahedaotao']) && $errors['id_mahedaotao'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_mahedaotao'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Email  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="email" placeholder=" VD : admin@gmail.com " value="<?php echo isset($email)  ? $email : ''?>">
                                            <?php if (isset($errors['email']) && $errors['email'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['email'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Quê Quán   </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="quequan" placeholder=" VD : Quỳnh lưu - Nghệ An  " value="<?php echo isset($quequan)  ? $quequan : ''?>">
                                            <?php if (isset($errors['quequan']) && $errors['quequan'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['quequan'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Số điện thoại <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="sodienthoai" value="<?php echo isset($sodienthoai)  ? $sodienthoai : ''?>">
                                            <?php if (isset($errors['sodienthoai']) && $errors['sodienthoai'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['sodienthoai'] ?></span>
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

            $(".chuyennganh").change(function (event) {
                event.preventDefault();
                event.stopPropagation();

                // lay ma chuyen nganh
                let $machuyennganh = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url     : url + '/admin/xulyajax/loclop.php',
                    type    : "POST",
                    data    : ({ 'machuyennganh' : $machuyennganh }),
                    success : function(responsive)
                    {
                        $(".lop").html("");
                        $(".lop").append(responsive);
                    }
                })

            })
        })
    </script>
