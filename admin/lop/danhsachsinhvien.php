<?php
    $title = " Danh sách lớp  ";
     $modules = "lop";
    require_once __DIR__.'/../autoload.php';

  
     $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editLop = $db->fetchOne("tbl_lop",(int)$id);
    //    dd($editLop);
    if (count($editLop) == 0)
    {
        redirect('/admin/404.php');
    }
    $sql ="SELECT * FROM tbl_sinhvien WHERE id_malop = '".$editLop['malop']."' ";
    $listSv = $db->fetchsql($sql);

?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
<html lang="en">
<head>
    <?php require_once __DIR__.'/../layout/head.php'; ?>
</head>
<style type="text/css">
    .showInfo
    {
        color: red;
    }
    .showInfo:hover
    {
        color: red !important;
    }
</style>
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
                        <a href="index.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Trở về  </a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php require_once __DIR__ .'/../layout/notyfi.php'?>
            <div class="row">
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
                                    <th> ID </th>
                                    <th width=""> Tên SV </th>
                                    <th> Mã SV </th>
                                    <td> Số điện thoại </td>
                                
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($listSv as $item) :?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><span>  <a href="javascript:void(0)" class="showInfo" title="Xem chi tiết" data-id="<?php echo $item['id'] ?>"><?php echo $item['tensinhvien'] ?></a> </span></td>
                                        <td> <?php echo $item['masinhvien'] ?> </td>
                                       
                                        <td><?php echo $item['sodienthoai'] ?></td>
                                    </tr>
                                <?php endforeach ;  ?>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
          
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>

<script type="text/javascript">
    $(function() {
        $(".showInfo").click(function() {
            var $id = $(this).attr("data-id");
            $.ajax({
                url : '/admin/lop/ajax.php',
                method: 'POST',
                data : { id : $id },
                success : function(data)
                {
                    $("#myModal").html('');
                    $("#myModal").html(data);
                    $("#myModal").modal("show");
                }
            })
        });
    });
</script>