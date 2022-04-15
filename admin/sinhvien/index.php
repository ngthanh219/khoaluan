<?php
    $title = " Quản lý sinh viên " ;
    $modules ="sinhvien";
    require_once __DIR__.'/../autoload.php';

    $sql = " SELECT tbl_sinhvien.* , tbl_lop.tenlop as tenlop ,tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa , tbl_hedaotao.tenhedaotao as hedaotao  FROM tbl_sinhvien 
            LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_sinhvien.id_machuyennganh
            LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_sinhvien.id_makhoa
            LEFT  JOIN  tbl_hedaotao ON tbl_hedaotao.mahedaotao = tbl_sinhvien.id_mahedaotao
            LEFT  JOIN  tbl_lop ON tbl_lop.malop = tbl_sinhvien.id_malop
             WHERE 1
        ";

    if(isset($_POST['id_makhoa']) && $_POST['id_makhoa'] != null )
    {
        $sql .= "AND tbl_sinhvien.id_makhoa = '".$_POST['id_makhoa']."' ";
    }

    if(isset($_POST['id_malop']) && $_POST['id_malop'] != null )
    {
        $sql .= "AND tbl_sinhvien.id_malop = '".$_POST['id_malop']."' ";
    }

    if(isset($_POST['id_machuyennganh']) && $_POST['id_machuyennganh'] != null )
    {
        $sql .= "AND tbl_sinhvien.id_machuyennganh = '".$_POST['id_machuyennganh']."' ";
    }

    if(isset($_POST['masinhvien']) && $_POST['masinhvien'] != null )
    {
        $sql .= "AND tbl_sinhvien.masinhvien = '".$_POST['masinhvien']."' ";
    }

    $sql .= " ORDER BY  ID DESC";
    $doan = $pagi->pagination("tbl_sinhvien",$sql,'page',10);

    $lop = $db->query("tbl_lop","*","");
    $khoa = $db->query("tbl_khoa","*","");
    $giaovien = $db->query("tbl_giaovien","*","");
    $chuyennganh = $db->query("tbl_chuyennganh","*","");
    $Sinhvien = $pagi->pagination("tbl_sinhvien",$sql,'page',10);
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
                        <a href="#"> Sinh viên </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    </li>
                </ul>
                
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div style="margin-bottom: 10px;padding-left: 20px;">
                    <form class="form-inline" action="" method="POST">
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="email" name="masinhvien" value="<?php echo isset($_POST['masinhvien']) ? $_POST['masinhvien'] : '' ?>" placeholder=" mã sinh viên ">
                        </div>
                         <div class="form-group">
                            <select class="form-control" name="id_makhoa">
                                 <option value=""> -- Chọn Khoa -- </option>
                                <?php foreach ($khoa as $item): ?>
                                     <option value="<?php echo $item['makhoa'] ?>" <?php echo isset($_POST['id_makhoa']) && $_POST['id_makhoa'] == $item['makhoa'] ? "selected = 'selected'" : '' ?>><?php echo $item['tenkhoa'] ?></option>
                                <?php endforeach ?>
                               
                            </select>
                           
                        </div>
                         <div class="form-group">
                            <select class="form-control" name="id_machuyennganh">
                                 <option value=""> -- Chọn Chuyên Ngành -- </option>
                                <?php foreach ($chuyennganh as $item): ?>
                                     <option value="<?php echo $item['machuyennganh'] ?>" <?php echo isset($_POST['id_machuyennganh']) && $_POST['id_machuyennganh'] == $item['machuyennganh'] ? "selected = 'selected'" : '' ?>><?php echo $item['tenchuyennganh'] ?></option>
                                <?php endforeach ?>
                               
                            </select>
                           
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="id_malop">
                                 <option value=""> -- Chọn lớp -- </option>
                                <?php foreach ($lop as $item): ?>
                                     <option value="<?php echo $item['malop'] ?>" <?php echo isset($_POST['id_malop']) && $_POST['id_malop'] == $item['malop'] ? "selected = 'selected'" : '' ?>><?php echo $item['tenlop'] ?></option>
                                <?php endforeach ?>
                               
                            </select>
                           
                        </div>
                    
                        <button type="submit" class="btn btn-success">Tìm kiếm </button>
                        <a href="/admin/sinhvien/" class="btn btn-danger"  />Làm mới</a>
                    </form>
                </div>
                <div class="col-sm-12">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i> Danh sách
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead class="flip-content">
                                <tr>
                                    <th width=""> Mã sinh viên </th>
                                    <th> Tên sinh viên </th>
                                    <th class=""> Thông tin </th>
                                    <th class=""> Thông tin khác  </th>
                                    <th class="">
                                        Thao tác
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($Sinhvien as $item):?>
                                    <tr>
                                        <td>
                                            <?php echo $item['masinhvien'] ?>
                                        </td>
                                        <td>
                                            <span><?= $item['tensinhvien'] ?></span>
                                        </td>
                                        <td class="">
                                            <ul>
                                                <li> <span class="fa fa-phone"></span> Số điện thoại : <?= $item['sodienthoai'] ?> </li>
                                                <li> <span class=" fa fa-envelope"></span> Email : <?= $item['email'] ?> </li>
                                                <li> <span class=" fa fa-map-marker"></span> Quê quán : <?= $item['quequan'] ?> </li>
                                                 <li> Ngày sinh   : <?= $item['ngaysinh'] ?></li>
                                                 <li> Mật khẩu : <input type="password" disabled="" value="<?php echo $item['matkhau'] ?>" style="border: 0;width: 50px;"> <button class="btn btn-xs btn-info view-pass">Hiện</button></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li> Hệ đào tao : <?= $item['hedaotao'] ?></li>
                                                <li> Khoa  : <?= $item['tenkhoa'] ?></li>
                                                <li> Chuyên Ngành  : <?= $item['tenchuyennganh'] ?></li>
                                                <li> Lớp  : <?= $item['tenlop'] ?></li>
                                            </ul>
                                        </td>
                                        <td class="">
                                            <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-xs red" onclick="return showAlert()"><i class="fa fa-trash-o"></i></a>
                                            <a href="update.php?id=<?= $item['id'] ?>" class="btn btn-xs green"><i class="fa fa-pencil"></i></a>
                                        </td>

                                    </tr>
                                <?php endforeach;  ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="pull-right">
                        <?php echo $pagi->getListpage("page") ?>
                    </div>
                     
                </div>

            </div>

            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>
<script type="text/javascript">
    $(function() {
        $('.view-pass').off('click').on('click',function() {
        
            let $input = $(this).parent('li').find('input').attr('type');
            console.log($input)
            if( $input == 'password')
            {
                $(this).html('Ẩn');
                $(this).parent('li').find('input').attr('type','text');
            }
            else 
            {
                $(this).html('Hiện');
                $(this).parent('li').find('input').attr('type','password');
            }
        })
    })
</script>
