<?php
    $title = " Thêm mới lớp " ;
     $modules = "lop";
    require_once __DIR__.'/../autoload.php';
    $khoa        = $db->query("tbl_khoa","*","");


    $chuyennganh = $db->query("tbl_chuyennganh","*","");
    $hedaotao    = $db->query("tbl_hedaotao","*","");
    $nkhoa    = $db->query("tbl_nienkhoa","*","");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // lay giá trị từ các ô input
        $id_makhoa               = getValue("id_makhoa","POST",'');
        $id_machuyennganh        = getValue("id_machuyennganh","POST",'');
        $id_mahedaotao           = getValue("id_mahedaotao","POST",'');
        $tenlop                  = getValue("tenlop","POST",'');
        $malop                   = getValue("malop","POST",'');
        $id_nienkhoa                = getValue("id_nienkhoa","POST",'');

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

        if ($id_mahedaotao == '')
        {
            $errors['id_mahedaotao']  = ' Mời bạn chọn  mã hệ đào tạo' ;
        }

        if ($tenlop == '')
        {
            $errors['tenlop']  = ' Mời bạn nhập tên lớp ' ;
        }
        if ($malop == '')
        {
            $errors['malop']  = ' Mời bạn nhập mã lớp' ;
        }
        else
        {

            // kiểm tra xem mã khoa đã tồn tại chưa
            // nếu có thì show lỗi
            $checkEsist = $db->fetchOne("tbl_lop","malop = '".$malop."' ");
            if ($checkEsist  && count($checkEsist) > 0)
            {
                $errors['malop']  = ' Mã lớp đã tồn tại ' ;
            }
        }

        if ($id_nienkhoa  == '')
        {
            $errors['id_nienkhoa']  = ' Mời bạn nhập niêm khóa     ' ;
        }

        // kiểm tra nếu mảng errors = null thì  tiến hành xử lý
        // ngược lại báo lỗi
        if (  empty($errors))
        {
            // gan các giá trị vào một mảng data
            $data =
            [
                'id_makhoa'               => $id_makhoa ,
                'id_machuyennganh'        => $id_machuyennganh,
                'id_mahedaotao'           => $id_mahedaotao,
                'tenlop'                  => $tenlop,
                'malop'                   => $malop,
                'id_nienkhoa'               => $id_nienkhoa

            ];
            // dd($data);die;

            // insert
            $insert = $db->insert("tbl_lop",$data);
            if($insert)
            {
                $_SESSION['success'] = " Thêm mới thành công " ;
                move_uploaded_file($file_tmp,ROOT.$file_name);
                redirect('/admin/lop');
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
                        <a href="index.php"> Lớp  </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="index.php" class="btn red" style="color: white"> <i class="icon-logout"></i>  Trở về </a>
                    </li>
                </ul>
                <?php require_once __DIR__."/../layout/notyfi.php"?>
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
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label"> Hệ đào tạo  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_mahedaotao" class="form-control">
                                                <option value=""> --  Mời bạn chọn hệ đào tạo ! -- </option>
                                                <?php foreach($hedaotao as $item) : ?>
                                                    <option value="<?php echo $item['mahedaotao'] ?>" <?php echo isset($id_mahedaotao) && $id_mahedaotao == $item['mahedaotao'] ? "selected='selected'" : '1' ?>><?php echo $item['tenhedaotao'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_mahedaotao']) && $errors['id_mahedaotao'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_mahedaotao'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Tên lớp <span class="text-danger">(*)</span>  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tenlop" placeholder=" VD :  Mạng máy tính " value="<?php echo isset($tenlop) ? $tenlop : ''  ?>">
                                            <?php if (isset($errors['tenlop']) && $errors['tenlop'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tenlop'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã Lớp <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-inline" name="malop" placeholder="MSP01212" value="<?php echo isset($malop) ? $malop : '' ?>">
                                            <?php if (isset($errors['malop']) && $errors['malop'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['malop'] ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <label class="col-md-2 control-label"> Niên khóa  <span class="text-danger">(*)</span> </label>
                                        <div class="col-md-4">
                                            <select name="id_nienkhoa" class="form-control">
                                                <option value=""> --  Mời bạn chọn niên khóa! -- </option>
                                                <?php foreach($nkhoa as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($id_nienkhoa) && $id_nienkhoa == $item['id'] ? "selected='selected'" : '1' ?>><?php echo $item['tenkhoa'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                        
                                            <?php if (isset($errors['id_nienkhoa']) && $errors['id_nienkhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_nienkhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo renderAction(); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        })
    </script>
