<?php
    $title = " Danh sách lớp  ";
     $modules = "lop";
    require_once __DIR__.'/../autoload.php';

    $sql = " SELECT tbl_lop.* , tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa , tbl_hedaotao.tenhedaotao as mahedaotao ,tbl_nienkhoa.tenkhoa as nienkhoa  FROM tbl_lop 
        LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_lop.id_machuyennganh
        LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_lop.id_makhoa
        LEFT JOIN tbl_nienkhoa ON tbl_nienkhoa.id = tbl_lop.id_nienkhoa
        LEFT  JOIN  tbl_hedaotao ON tbl_hedaotao.mahedaotao = tbl_lop.id_mahedaotao
         WHERE 1
    ";

    if(isset($_POST['id_makhoa']) && $_POST['id_makhoa'] != null )
    {
        $sql .= "AND tbl_lop.id_makhoa = '".$_POST['id_makhoa']."' ";
    }

    if(isset($_POST['id_machuyennganh']) && $_POST['id_machuyennganh'] != null )
    {
        $sql .= "AND tbl_lop.id_machuyennganh = '".$_POST['id_machuyennganh']."' ";
    }
    if(isset($_POST['id_nienkhoa']) && $_POST['id_nienkhoa'] != null )
    {
        $sql .= "AND tbl_lop.id_nienkhoa = '".$_POST['id_nienkhoa']."' ";
    }
     $khoa = $db->query("tbl_khoa","*","");
    $chuyennganh = $db->query("tbl_chuyennganh","*","");
     $nkhoa    = $db->query("tbl_nienkhoa","*","");
    $Lop = $pagi->pagination("tbl_lop",$sql,'page',20);
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
                        <a href="#"> Lớp </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php require_once __DIR__ .'/../layout/notyfi.php'?>
            <div class="row">
                <div style="margin-bottom: 10px;padding-left: 20px;">
                    <form class="form-inline" action="" method="POST">
                            
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
                                 <option value=""> -- Chọn Chuyên  ngành -- </option>
                                <?php foreach ($chuyennganh as $item): ?>
                                     <option value="<?php echo $item['machuyennganh'] ?>" <?php echo isset($_POST['id_machuyennganh']) && $_POST['id_machuyennganh'] == $item['machuyennganh'] ? "selected = 'selected'" : '' ?>><?php echo $item['tenchuyennganh'] ?></option>
                                <?php endforeach ?>
                               
                            </select>
                           
                        </div>
                         <div class="form-group">
                            <select class="form-control" name="id_nienkhoa">
                                 <option value=""> -- Chọn niên khóa  -- </option>
                                <?php foreach ($nkhoa as $item): ?>
                                     <option value="<?php echo $item['id'] ?>" <?php echo isset($_POST['id_nienkhoa']) && $_POST['id_nienkhoa'] == $item['id'] ? "selected = 'selected'" : '' ?>><?php echo $item['tenkhoa'] ?></option>
                                <?php endforeach ?>
                               
                            </select>
                           
                        </div>
                    
                    
                        <button type="submit" class="btn btn-success">Tìm kiếm </button>
                        <a href="/admin/lop/" class="btn btn-danger"  />Làm mới</a>
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
                                   
                                    <th width=""> Tên lớp </th>
                                    <th> Mã Lớp </th>
                                    <th> Khoa </th>
                                    <th> Chuyên ngành </th>
                                    <th class=""> Thông tin </th>
                                    <th class="">
                                        Thao tác
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($Lop as $item) :?>
                                    <tr>
                                      
                                        <td><span>  <?php echo $item['tenlop'] ?> </span></td>
                                        <td> <?php echo $item['malop'] ?> </td>
                                        <td> <?php echo $item['tenkhoa'] ?> </td>
                                        <td> <?php echo $item['tenchuyennganh'] ?> </td>
                                        <td>
                                            <ul>
                                                <li> <b> Sĩ số </b> <?php echo $item['siso'] ?> </li>
                                                <li> <b> Hệ Đạo tao </b> <?php echo $item['mahedaotao'] ?> </li>
                                                <li> <b> Niên khóa </b>  <?php echo $item['nienkhoa'] ?> </li>
                                            </ul>
                                        </td>
                                        <td class="">
                                            <a href="delete.php?id=<?php echo $item['id'] ?>" class="btn btn-xs red delete"><i class="fa fa-trash-o" onclick="return showAlert()"></i></a>
                                            <a href="update.php?id=<?php echo $item['id'] ?>" class="btn btn-xs green"><i class="fa fa-pencil"></i></a>
                                            <a href="danhsachsinhvien.php?id=<?php echo $item['id'] ?>" class="btn btn-xs green"><i class="fa fa-cogs"></i></a>
                                        </td>

                                    </tr>
                                <?php endforeach ;  ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            <?php echo $pagi->getListpage("page") ?>
                        </div>
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