<?php
    $modules = "danh-sach";
    $title = " Danh sách đồ án của bạn  " ;
    require_once __DIR__.'/../autoload.php';
    
    $user = $db->query("tbl_sinhvien","*"," AND id = " . $_SESSION["admin_id"])[0];
    $sql = "SELECT tbl_doan.*, tbl_sinhvien.tensinhvien as tensinhvien,tbl_lop.tenlop as tenlop , tbl_hoidong.tenhoidong as tenhoidong,
            tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa,tbl_giaovien.tengiaovien as tengiaovien, tbl_detai.tendetai as tendetai
        FROM tbl_doan 
        LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_doan.id_makhoa 
        LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_doan.id_machuyennganh 
        LEFT JOIN tbl_lop ON tbl_lop.malop = tbl_doan.id_malop
        LEFT JOIN tbl_sinhvien ON tbl_sinhvien.masinhvien = tbl_doan.id_masinhvien
        LEFT JOIN tbl_giaovien ON tbl_giaovien.id = tbl_doan.id_giaovien
        LEFT JOIN tbl_hoidong ON tbl_hoidong.id = tbl_doan.id_hoidong
        LEFT JOIN tbl_detai ON tbl_detai.madetai = tbl_doan.tendoan
        WHERE 1 AND tbl_doan.id_masinhvien = '" . $user["masinhvien"] . "' ORDER BY  ID DESC
    ";

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
    #suggesstion-box {
        /*border: 1px solid #dedede;*/
        z-index: 9999;
        position: absolute;
        top: 135px;
        background: white;
        width: 50%;
    }

    #suggesstion-box a {
        color: #333 !important;
    }

    .form-group {
        margin-bottom: 10px;
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
                        <!-- <li>
                        <a href="add.php" class="btn green" style="color: white"> <i class="fa fa-plus"></i>  Thêm mới </a>
                    </li> -->
                        <?php endif ;?>
                    </ul>
                    <div class="clearfix"></div>

                </div>

                <div class="form-group" style="margin-top: 10px;margin-bottom: 10px;">
                    <input type="text" placeholder="" class="form-control col-sm-5 col-ms-offset-2" id="tags"
                        placeholder="">
                </div>
                <div id="suggesstion-box"></div>

                <div class="clearfix"></div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <?php require_once __DIR__.'/../layout/notyfi.php' ;?>
                <div class="row">
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
                                                <!-- <th>
                                                    Hình ảnh
                                                </th> -->
                                                <th>
                                                    Tên đồ án
                                                </th>
                                                <th>
                                                    Giảng viên Pb && Hội Đồng
                                                </th>
                                                <th>
                                                    Sinh viên
                                                </th>
                                                <th> Thông tin </th>
                                                <td>Tóm tắt</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($doan as $item): ?>
                                            <tr>
                                                <td><?php echo $item['id'] ?></td>
                                                <!-- <td>
                                                    <?php if ($item["hinhanh"] != null) { ?>
                                                        <img src="<?php echo base_url('/public/uploads/images/') ?><?php echo $item['hinhanh'] ?>"
                                                            alt="" class="img img-thumbnail"
                                                            style="width: 100px;height: 100px;">
                                                    <?php } else { echo "Chưa cập nhật"; } ?>
                                                </td> -->
                                                <td>
                                                    <?php echo $item['tendetai'] ?>
                                                    <!-- <?php if ($item["url"] != null) { ?>
                                                        <p>
                                                            <a href="<?php echo $item['url'] ?>" target="_blank"> Link Online</a>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($item["file"] != null) { ?>
                                                        <p>
                                                            <a href="<?php echo base_url("/public/uploads/file/" . $item['file']) ?>"target="_blank"> Download Offline </a>
                                                        </p>
                                                    <?php } ?> -->
                                                </td>
                                                <?php
                                                    $sql = " SELECT tbl_doan_giaovien.*, tbl_giaovien.tengiaovien as tengiaovien,tbl_giaovien.id as idgv from tbl_doan_giaovien
                                                    LEFT JOIN  tbl_giaovien on tbl_giaovien.id = tbl_doan_giaovien.id_giaovien
                                                     WHERE id_doan = ".$item['id'];
                                                    $listgv = $db->fetchsql($sql);
                                                ?>

                                                <td>

                                                    <?php foreach($listgv as $val) :?>
                                                    <p class="btn btn-xs btn-success" style="margin-bottom: 2px;">
                                                        <?= $val['tengiaovien'] ?></p>

                                                    <?php endforeach ; ?>
                                                    <p></p>
                                                    <a class="btn btn-info btn-xs view-hd"
                                                        data-id="<?= $item['id']?>">Tên hội đồng BV :
                                                        <?= $item['tenhoidong'] ?></a>

                                                </td>
                                                <td> <?php echo $item['tensinhvien'] ?> </td>
                                                <td>
                                                    <ul>
                                                        <li> Khoa : <?php echo $item['tenkhoa'] ?></li>
                                                        <li> Chuyên ngành : <?php echo $item['tenchuyennganh'] ?></li>
                                                        <li> Lớp : <?php echo $item['tenlop'] ?></li>
                                                        <li> Mã đồ án : <?= ($item['madoan'] != null) ? $item['madoan'] : "Chưa cập nhật" ?></li>
                                                        <li> 
                                                            Gv hướng dẫn : <?php echo $item['tengiaovien'] ?> - Trạng thái: 
                                                            <?php 
                                                                if ($item["process"] == 0) {
                                                                    echo "<b>Đang chờ xác thực</b>";
                                                                }
                                                                
                                                                if ($item["process"] == 1) {
                                                                    echo "<b>Đã đồng ý</b>";
                                                                }
                                                                
                                                                if ($item["process"] == 2) {
                                                                    echo "<b>Không đồng ý</b>";
                                                                }
                                                            ?>
                                                        </li>
                                                        <li> Điểm : <?php echo $item['diem'] ?></li>

                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="showInfo"
                                                        data-id="<?php echo $item['id'] ?>">Chi tiết</a>
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
        $(document).ready(function() {
            $("#tags").keyup(function() {
                $.ajax({
                    type: "get",
                    url: "/quanlydoan/admin/doan/search.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#header-search").css("background",
                            "#FFF url(LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function(data) {
                        console.log(data);
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#header-search").css("background", "#FFF");
                    }
                });
            });
        });

        function selectCountry(val) {
            $("#tags").val(val);
            $("#suggesstion-box").hide();
        }
        
        $(function() {
            $(".showInfo").click(function() {
                var $id = $(this).attr("data-id");
                $.ajax({
                    url: '/quanlydoan/admin/doan/ajax.php',
                    method: 'POST',
                    data: {
                        id: $id
                    },
                    success: function(data) {
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
                    url: '/quanlydoan/admin/doan/view-hd.php',
                    method: 'POST',
                    data: {
                        id: $id
                    },
                    success: function(data) {
                        $("#myModal-hd").html('');
                        $("#myModal-hd").html(data);
                        $("#myModal-hd").modal("show");
                    }
                })
            });
        });
    </script>