<?php
    $title = " Quản lý hội đồng " ;
    $modules ="hoidong";

    require_once __DIR__.'/../autoload.php';
    $sql = " SELECT tbl_hoidong.*  FROM tbl_hoidong
        LEFT JOIN tbl_giaovien ON tbl_giaovien.id = tbl_hoidong.id_chutich
         WHERE 1
    ";

    //  if(isset($_POST['id_makhoa']) && $_POST['id_makhoa'] != null )
    // {
    //     $sql .= "AND tbl_giaovien.id_makhoa = '".$_POST['id_makhoa']."' ";
    // }

    // if(isset($_POST['id_machuyennganh']) && $_POST['id_machuyennganh'] != null )
    // {
    //     $sql .= "AND tbl_giaovien.id_machuyennganh = '".$_POST['id_machuyennganh']."' ";
    // }
    $hoidong = $db->fetchsql($sql);

    
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
                        <a href="index.php"> Hội đồng </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                         <?php if(!  isset($_SESSION['user_id'])) :?>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    <?php endif ;?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php require_once __DIR__."/../layout/notyfi.php" ;?>
            <div class="row">
               <!--  <div style="margin-bottom: 10px;padding-left: 20px;">
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
                    
                    
                        <button type="submit" class="btn btn-success">Tìm kiếm </button>
                        <a href="/admin/giaovien/" class="btn btn-danger"  />Làm mới</a>
                    </form>
                </div> -->
                <div class="col-sm-12">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i> <?php echo $title ?>
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead class="flip-content">
                                <tr>
                                    <th width=""> Tên hội đồng </th>
                                    <th> Chủ tịch </th>
                                    <th class=""> Thư ký </th>
                                    <th class=""> Uỷ viên </th>
                                    <th class=""> Gv Phản biên </th>
                                    <th class="">
                                        Thao tác
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($hoidong as $item) :?>
                                    <tr>
                                
                                        <td>
                                            <span><?php echo $item['tenhoidong'] ?></span>
                                        </td>
                                        <td>
                                            <?php
                                                $chutich = $db->fetchOne("tbl_giaovien",(int)$item['id_chutich']);
                                            ?>
                                            <?php echo $chutich['tengiaovien'] ?>
                                        </td>
                                        <td>
                                             <?php
                                                $chutich = $db->fetchOne("tbl_giaovien",(int)$item['id_thuky']);
                                            ?>
                                            <?php echo $chutich['tengiaovien'] ?>
                                        </td>
                                        <td>
                                             <?php
                                                $chutich = $db->fetchOne("tbl_giaovien",(int)$item['id_uyvien']);
                                            ?>
                                            <?php echo $chutich['tengiaovien'] ?>
                                        </td>
                                        <td>
                                             <?php
                                                $chutich = $db->fetchOne("tbl_giaovien",(int)$item['id_phanbien']);
                                            ?>
                                            <?php echo $chutich['tengiaovien'] ?>
                                        </td>
                                        <td class="">
                                            <?php if(!  isset($_SESSION['user_id'])) :?>
                                            <a href="delete.php?id=<?php echo $item['id'] ?>" class="btn btn-xs red" onclick="return showAlert()"><i class="fa fa-trash-o"></i></a>
                                            <a href="update.php?id=<?php echo $item['id'] ?>" class="btn btn-xs green"><i class="fa fa-pencil"></i></a>
                                        <?php endif ;?>
                                        </td>

                                    </tr>
                                <?php endforeach;  ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php echo $pagi->getListpage("page") ?>
                </div>

            </div>

            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>