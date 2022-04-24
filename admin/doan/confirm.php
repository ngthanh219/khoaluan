<?php
    $modules = "doan";
    $title = " Cập nhật đồ án    ";
    $ch = 'fix';

    require_once __DIR__.'/../autoload.php';

    if( isset($_SESSION['user_id'])) {
        $_SESSION['errors'] = ' Ban khong co quyen truy cap';

        redirect('/admin/');
    }
    
    $id = getValue("id", "GET", '');
    $editDoan = $db->fetchOne("tbl_doan", (int) $id);
    
    if (count($editDoan) == 0) {
        redirect('/admin/404.php');
    }

    $khoa = $db->query("tbl_khoa", "*", " AND makhoa = '" . $editDoan["id_makhoa"] . "'")[0];
    $chuyennganh = $db->query("tbl_chuyennganh", "*", " AND machuyennganh = '" . $editDoan["id_machuyennganh"] . "'")[0];
    $lop = $db->query("tbl_lop","*"," AND malop = '" . $editDoan["id_malop"] . "'")[0];
    $sinhvien    = $db->query("tbl_sinhvien","*","");
    $giaovien = $db->query("tbl_giaovien", "*"," AND id = '" . $editDoan["id_giaovien"] . "'")[0];
    $detai = $db->query("tbl_detai", "*", " AND selected = 0 AND status = 1");
    $detaihientai = $db->query("tbl_detai", "*", " AND madetai = '" . $editDoan["tendoan"] . "'")[0];

    $sql = "SELECT tbl_doan_giaovien.*, tbl_giaovien.tengiaovien as tengiaovien,tbl_giaovien.id as idgv from tbl_doan_giaovien
            LEFT JOIN  tbl_giaovien on tbl_giaovien.id = tbl_doan_giaovien.id_giaovien
            WHERE id_doan = $id ";
    $listgv = $db->fetchsql($sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_makhoa = getValue("id_makhoa","POST","");
        $id_machuyennganh = getValue("id_machuyennganh","POST","");
        $id_malop = getValue("id_malop","POST","");
        $id_masinhvien = getValue("id_masinhvien","POST","0");
        $tendoan = getValue("tendoan","POST","");
        $gioithieu = getValue("gioithieu","POST","");
        $id_giaovien = getValue("id_giaovien","POST","");
        $process = getValue("process","POST","");

        if ($id_makhoa == '')
        {
            $errors['id_makhoa'] = ' Mã khoa không được để trống ' ;
        }
        
        if ($id_giaovien == '')
        {
            $errors['id_giaovien'] = ' Giao vien không được để trống ' ;
        }

        if ($id_machuyennganh == '')
        {
            $errors['id_machuyennganh'] = ' Mã chuyên ngành  không được để trống ' ;
        }

        if ($id_malop == '')
        {
            $errors['id_malop'] = ' Mã lop ngành  không được để trống ' ;
        }
        
        if ($tendoan != '') {
            if ($tendoan != $editDoan['tendoan']) {
                $db->update("tbl_detai", [
                    "selected" => 0
                ], "id = " . $detaihientai["id"] . " ");

                $detaimoi = $db->query("tbl_detai", "*", " AND madetai = '" . $tendoan . "'")[0];
                $db->update("tbl_detai", [
                    "selected" => 1
                ], "id = " . $detaimoi["id"] . " ");
            }
        } else { 
            $tendoan = $editDoan['tendoan'];
        }

        if ($process == '')
        {
            $errors['process'] = ' Trạng thái    chưa được chọn ' ;
        }

        if (empty($errors)) {
            $data = [
                'id_makhoa' => $id_makhoa,
                'id_machuyennganh' => $id_machuyennganh,
                'id_malop'   => $id_malop,
                'id_masinhvien' => $id_masinhvien,
                'tendoan' => $tendoan,
                'gioithieu' => $gioithieu,
                'id_giaovien' => $id_giaovien,
                'process' => $process
            ];
            
            $update = $db->update("tbl_doan", $data, " id = $id ");
            
            if ($update) {
                $_SESSION['success'] = " Cập nhật  thành công " ;
                redirect('/admin/doan/do-an-cua-ban.php');
            } else {
                $_SESSION['errors'] = " Cập nhật  thất bại ";
                redirect('/admin/doan/do-an-cua-ban.php');
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

#img-upload {
    width: 100%;
}

.box-action {
    position: fixed;
    right: 41px;
    z-index: 9;
    top: 40%;
    /*transform: translateY(-50%);*/
    /*top:50%;*/

}

.box-action a {
    display: block;
    border: 1px solid #dedede;
    margin-bottom: 5px;
    padding: 5px;
    background-color: white;
    color: #000;
}

.box-action a:hover,
.box-action a:focus {
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
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
                            <a href="#"> Đồ án </a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="index.php" class="btn red" style="color: white"> <i class="fa fa-plus"></i> Trở về
                            </a>
                        </li>
                    </ul>
                    <div class="col-md-12 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet box green ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> <?php echo isset($title) ?  $title : '' ?>
                                </div>

                            </div>
                            <div class="box-action">
                                <a href="#info" class="actionscoll"><i class="fa fa-search"></i> Thông tin </a>
                                <a href="#image" class="actionscoll"><i class="fa fa-search"></i> Hình ảnh </a>
                                <a href="#desc" class="actionscoll"><i class="fa fa-search"></i> Giới thiệu </a>
                            </div>

                            <div class="portlet-body form">
                                <form class="form-horizontal" role="form" method="POST" action=""
                                    enctype="multipart/form-data">
                                    <div class="form-body" id="info">

                                        <div class="form-group" id="info">
                                            <label class="col-md-2 control-label"> Khoa <span
                                                    class="text-danger">(*)</span> </label>
                                            <div class="col-md-9">
                                                <select name="id_makhoa" class="form-control makhoa">
                                                    <option value="<?php echo $editDoan['id_makhoa'] ?>">
                                                        <?php echo $khoa['tenkhoa'] ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="info">
                                            <label class="col-md-2 control-label "> Chuyên ngành <span
                                                    class="text-danger">(*)</span> </label>
                                            <div class="col-md-9">
                                                <select name="id_machuyennganh" class="form-control chuyennganh">
                                                    <option value="<?php echo $editDoan['id_machuyennganh'] ?>">
                                                        <?php echo $chuyennganh['tenchuyennganh'] ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Lớp </label>
                                            <div class="col-md-4">
                                                <select name="id_malop" class="form-control lop">
                                                    <option value="<?php echo $editDoan['id_malop'] ?>">
                                                        <?php echo $lop['tenlop'] ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Giáo viên </label>
                                            <div class="col-md-4">
                                                <select name="id_giaovien" class="form-control giaovien">
                                                    <option value="<?php echo $editDoan['id_giaovien'] ?>">
                                                        <?php echo $giaovien['tengiaovien'] ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Sinh viên </label>
                                            <div class="col-md-4">
                                                <select name="id_masinhvien" class="form-control sinhvien">
                                                    <option value=""> -- Mời bạn sinh viên ! -- </option>
                                                    <?php foreach($sinhvien as $item) : ?>
                                                    <option value="<?php echo $item['masinhvien'] ?>"
                                                        <?php echo isset($editDoan) && $editDoan['id_masinhvien'] == $item['masinhvien'] ? "selected='selected'" : "" ?>>
                                                        <?php echo $item['tensinhvien'] ?></option>
                                                    <?php endforeach ; ?>
                                                </select>
                                                <?php if (isset($errors['id_masinhvien']) && $errors['id_masinhvien'] != '') :?>
                                                <span class="help-block"
                                                    style="margin-bottom: -10px"><?php echo $errors['id_masinhvien'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Tên đồ án hiện tại đã chọn </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control inputForm" value="<?php echo $detaihientai['tendetai'] ?>" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Thay đổi đề tài </label>
                                            <div class="col-md-4">
                                                <select name="tendoan" class="form-control tendoan">
                                                    <option value=""> -- Không thay đổi -- </option>
                                                    <?php foreach($detai as $item) : ?>
                                                        <option value="<?php echo $item['madetai'] ?>"
                                                            <?php echo isset($editDoan) && $editDoan['tendoan'] == $item['madetai'] ? "selected='selected'" : "" ?>>
                                                            <?php echo $item['tendetai'] ?>
                                                        </option>
                                                    <?php endforeach ; ?>
                                                </select>
                                                <?php if (isset($errors['tendoan']) && $errors['tendoan'] != '') :?>
                                                <span class="help-block"
                                                    style="margin-bottom: -10px"><?php echo $errors['tendoan'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Trạng thái xác thực </label>
                                            <div class="col-md-4">
                                                <select name="process" class="form-control process">
                                                    <option value=""> -- Hãy chọn trạng thái -- </option>
                                                    <?php if ($editDoan["process"] == 0) { ?>
                                                        <option value="0" selected>Đang chờ xác nhận</option>
                                                        <option value="1">Đồng ý</option>
                                                        <option value="2">Từ chối</option>
                                                    <?php } else if ($editDoan["process"] == 1) { ?>
                                                        <option value="0">Đang chờ xác nhận</option>
                                                        <option value="1" selected>Đồng ý</option>
                                                        <option value="2">Từ chối</option>
                                                    <?php } else if ($editDoan["process"] == 2) { ?>
                                                        <option value="0">Đang chờ xác nhận</option>
                                                        <option value="1">Đồng ý</option>
                                                        <option value="2" selected>Từ chối</option>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($errors['process']) && $errors['process'] != '') :?>
                                                <span class="help-block"
                                                    style="margin-bottom: -10px"><?php echo $errors['process'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group" id="desc">
                                            <h5 class="col-sm-10" style="padding-left: 31px"> <label> Giới thiệu
                                                </label></h5>
                                            <div class="col-sm-10" style="padding-left:30px">
                                                <textarea name="gioithieu" id="summernote" cols="117"
                                                    rows="10"><?php echo $editDoan['gioithieu'] ?></textarea>
                                                <?php if (isset($errors['gioithieu']) && $errors['gioithieu'] != '') :?>
                                                <span class="help-block"
                                                    style="margin-bottom: -10px"><?php echo $errors['gioithieu'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green"><i class="fa fa-cloud"></i> Lưu </button>
                                                <button type="reset" class="btn green"><i class="fa fa-refresh"></i> Làm mới </button>
                                                <a href="do-an-cua-ban.php" class="btn red"> <i class="icon-logout"></i> Trở về </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once __DIR__.'/../layout/footer.php'; ?>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <script>
        $(function() {
            $('#summernote').summernote();
        })
        $(function() {
            $('#dates-field2').selectpicker();
            $('#dates-field2').change(function(e) {

                var selectedValues = $(this).val();
                $("#value-select").attr('value', selectedValues);

            })

            $(".filter-option").html('Mời bạn chọn danh sách giáo viên phản biên nếu muốn thay đổi ');
        })
        </script>

        <script>
        $(function() {
            $(".makhoa").change(function(event) {
                event.preventDefault();
                event.stopPropagation();
                // lay ma khoa
                let $makhoa = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url: url + '/admin/xulyajax/laychuyennganh.php',
                    type: "POST",
                    data: ({
                        'makhoa': $makhoa
                    }),
                    success: function(responsive) {
                        $(".chuyennganh").html("");
                        $(".chuyennganh").append(responsive);
                    }
                })
            })

            $(".chuyennganh").change(function(event) {
                event.preventDefault();
                event.stopPropagation();

                // lay ma chuyen nganh
                let $machuyennganh = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url: url + '/admin/xulyajax/loclop.php',
                    type: "POST",
                    data: ({
                        'machuyennganh': $machuyennganh
                    }),
                    success: function(responsive) {
                        $(".lop").html("");
                        $(".lop").append(responsive);
                    }
                })

            })
            $(".lop").change(function(event) {
                event.preventDefault();
                event.stopPropagation();

                // lay ma chuyen nganh
                let $malop = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url: url + '/admin/xulyajax/locsinhvien.php',
                    type: "POST",
                    data: ({
                        'malop': $malop
                    }),
                    success: function(responsive) {
                        $(".sinhvien").html("");
                        $(".sinhvien").append(responsive);
                    }
                })

            })
        })
        </script>