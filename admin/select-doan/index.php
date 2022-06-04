<?php
$modules = "select-doan";
    $title = " Chọn đồ án" ;
    require_once __DIR__.'/../autoload.php';
    $sql = "SELECT tbl_doan.* ,tbl_sinhvien.tensinhvien as tensinhvien,tbl_lop.tenlop as tenlop , tbl_hoidong.tenhoidong as tenhoidong,
            tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa,tbl_giaovien.tengiaovien as tengiaovien  FROM tbl_doan 
        LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_doan.id_makhoa 
        LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_doan.id_machuyennganh 
        LEFT JOIN tbl_lop ON tbl_lop.malop = tbl_doan.id_malop
        LEFT JOIN tbl_sinhvien ON tbl_sinhvien.masinhvien = tbl_doan.id_masinhvien
        LEFT JOIN tbl_giaovien ON tbl_giaovien.id = tbl_doan.id_giaovien
        LEFT JOIN tbl_hoidong ON tbl_hoidong.id = tbl_doan.id_hoidong
        WHERE 1 
    ";
    
    if(isset($_POST['id_makhoa']) && $_POST['id_makhoa'] != null )
    {
        $sql .= "AND tbl_doan.id_makhoa = '".$_POST['id_makhoa']."' ";
    }

    if(isset($_POST['id_malop']) && $_POST['id_malop'] != null )
    {
        $sql .= "AND tbl_doan.id_malop = '".$_POST['id_malop']."' ";
    }

    if(isset($_POST['id_machuyennganh']) && $_POST['id_machuyennganh'] != null )
    {
        $sql .= "AND tbl_doan.id_machuyennganh = '".$_POST['id_machuyennganh']."' ";
    }
    if(isset($_POST['id_giaovien']) && $_POST['id_giaovien'] != null )
    {
        $sql .= "AND tbl_doan.id_giaovien = '".$_POST['id_giaovien']."' ";
    }

    if(isset($_POST['masinhvien']) && $_POST['masinhvien'] != null )
    {
        $sql .= "AND tbl_doan.id_masinhvien = '".$_POST['masinhvien']."' ";
    }


    if(isset($_POST['tendoan']) && $_POST['tendoan'] != null )
    {
    
        $sql .= "AND tbl_doan.tendoan LIKE '%".$_POST['tendoan']."%' ";
    }
    $sql .= " ORDER BY  ID DESC";

    $doan = $pagi->pagination("tbl_sinhvien",$sql,'page',10);

    $lop = $db->query("tbl_lop","*","");
    $khoa = $db->query("tbl_khoa","*","");
    $giaovien = $db->query("tbl_giaovien","*","");
    $chuyennganh = $db->query("tbl_chuyennganh","*","");

?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
<html lang="en">
<head>
    <?php require_once __DIR__.'/../layout/head.php'; ?>
    <style type="text/css">
        #suggesstion-box{
            /*border: 1px solid #dedede;*/
            z-index: 9999;
            position: absolute;
            top: 135px;
            background: white;
            width: 50%;
        }
        #suggesstion-box a 
        {
            color: #333 !important;
        }
        .form-group 
        {
            margin-bottom:10px;
        }
    </style>
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
                        <a href="#">Danh sách đồ án </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <?php if( ! isset($_SESSION['user_id'])) :?>
                    <li>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    </li>
                    <?php endif ;?>
                </ul>
                <div class="clearfix"></div>
                
            </div>

            <div class="form-group" style="margin-top: 10px;margin-bottom: 10px;">
                <input type="text" placeholder="" class="form-control col-sm-5 col-ms-offset-2" id="tags" placeholder="">
            </div>
            <div id="suggesstion-box"></div>
            
            <div class="clearfix"></div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php require_once __DIR__.'/../layout/notyfi.php' ;?>
            <div class="row">

                <div style="margin-bottom: 10px;padding-left: 20px;">
                    
                    <form class="form-inline" action="" method="POST" style="margin-top:10px">
                        
                         <div class="form-group">
                           
                            <input type="text" class="form-control" id="email" name="tendoan" value="<?php echo isset($_POST['tendoan']) ? $_POST['tendoan'] : '' ?>" placeholder=" Tên đồ án  ">
                        </div>
                         

                         <div class="form-group">
                           
                            <input type="text" class="form-control" id="email" name="masinhvien" value="<?php echo isset($_POST['masinhvien']) ? $_POST['masinhvien'] : '' ?>" placeholder=" mã sinh viên ">
                        </div>
                        <div class="form-group">
                           
                          <select class="form-control" name="id_giaovien">
                                 <option value=""> -- Chọn giáo viên HD -- </option>
                                <?php foreach ($giaovien as $item): ?>
                                     <option value="<?php echo $item['id'] ?>" <?php echo isset($_POST['id_giaovien']) && $_POST['id_giaovien'] == $item['id'] ? "selected = 'selected'" : '' ?>><?php echo $item['tengiaovien'] ?></option>
                                <?php endforeach ?>
                               
                            </select>
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
                                 <option value=""> -- Chọn Chuyên  ngành -- </option>
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
                        <a href="/admin/doan/" style="margin-top:10px;" class="btn btn-danger"  />Làm mới</a>
                    </form>
                </div>
                <div class="col-md-12">
                    <!-- BEGIN CONDENSED TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-picture"></i> <?php echo isset($title) ? $title : '' ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Hình ảnh 
                                        </th>
                                        <th>
                                            Tên đồ án
                                        </th>
                                        <th>
                                            Giáo viên Pb && Hội Đồng
                                        </th>
                                        <th>
                                            Người thực hiện
                                        </th>
                                        <th> Thông tin </th>
                                        <td>Tóm tắt</td>
                                        <th> Thao tác </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($doan as $item): ?>
                                            <tr>
                                                <td><?php echo $item['id'] ?></td>
                                                <td>
                                                
                                                     <img src="<?php echo base_url('/public/uploads/images/') ?><?php echo $item['hinhanh'] ?>" alt="" class="img img-thumbnail" style="width: 100px;height: 100px;">
                                                </td>
                                                <td> 
                                                    <?php echo $item['tendoan'] ?>
                                                    <p><a href="<?php echo $item['url'] ?>" target="_blank"> Link Online  </a></p>
                                                    <p><a  href="<?php echo base_url('/public/uploads/file/' . $item['file']) ?>" target="_blank"> Download Offline </a></p>
                                                 </td>
                                                 <?php
                                                    $sql = " SELECT tbl_doan_giaovien.*, tbl_giaovien.tengiaovien as tengiaovien,tbl_giaovien.id as idgv from tbl_doan_giaovien
                                                    LEFT JOIN  tbl_giaovien on tbl_giaovien.id = tbl_doan_giaovien.id_giaovien
                                                     WHERE id_doan = ".$item['id'];
                                                    $listgv = $db->fetchsql($sql);

                                                 ?>

                                                <td> 
                                                    
                                                     <?php foreach($listgv as $val) :?>
                                                            <p class="btn btn-xs btn-success" style="margin-bottom: 2px;"> <?= $val['tengiaovien'] ?></p>
                                                        
                                                        <?php endforeach ; ?>
                                                        <p></p>
                                                        <a  class="btn btn-info btn-xs view-hd"  data-id="<?= $item['id']?>">Tên hội đồng BV : <?= $item['tenhoidong'] ?></a>

                                                </td>
                                                <td> <?php echo $item['tensinhvien'] ?> </td>
                                                <td>
                                                    <ul>
                                                        <li>  Mã đồ án : <?php echo $item['madoan'] ?></li>
                                                        <li>  Lớp : <?php echo $item['tenlop'] ?></li>
                                                        <li>  Chuyên ngành : <?php echo $item['tenchuyennganh'] ?></li>
                                                        <li>Gv hướng dẫn : <?php echo $item['tengiaovien'] ?></li>
                                                        <li>  Khoa : <?php echo $item['tenkhoa'] ?></li>
                                                        <li>  Điểm  : <?php echo $item['diem'] ?></li>

                                                    </ul>
                                                </td>
                                                <td>
                                                     <a href="javascript:void(0)" class="showInfo" data-id="<?php echo $item['id'] ?>">Chi tiết</a>
                                                </td>
                                                <td>
                                                     <?php if( !$item['tensinhvien']) :?>
                                                        <a href="update.php?id=<?php echo $item['id'] ?>"> <span  class="label label-success "><i class="fa fa-pencil"></i></span> Chọn đồ án này </a>
                                                
                                                    <?php endif; ?>
                                                   
                                                </td>
                                                
                                            </tr>
                                        <?php endforeach ?>
                                    

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pull-right">
                            <?php echo $pagi->getListpage("page") ?>
                        </div>
                    </div>
                    <!-- END CONDENSED TABLE PORTLET-->
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>
         <div id="myModal" class="modal fade" role="dialog">
          
        </div>
        <div class="modal fade" id="myModal-hd" role="dialog">
            
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END CONTAINER -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#tags").keyup(function(){
            $.ajax({
            type: "get",
            url: "/admin/doan/search.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#header-search").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                console.log(data);
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#header-search").css("background","#FFF");
            }
            });
        });
    });
    //To select country name
    function selectCountry(val) {
        $("#tags").val(val);
        $("#suggesstion-box").hide();
    }
</script>
<script type="text/javascript">
    $(function() {
        $(".showInfo").click(function() {
            var $id = $(this).attr("data-id");
            $.ajax({
                url : '/admin/doan/ajax.php',
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
    $(function() {
        $(".view-hd").click(function() {
            var $id = $(this).attr("data-id");
            $.ajax({
                url : '/admin/doan/view-hd.php',
                method: 'POST',
                data : { id : $id },
                success : function(data)
                {
                    $("#myModal-hd").html('');
                    $("#myModal-hd").html(data);
                    $("#myModal-hd").modal("show");
                }
            })
        });
    });
</script>