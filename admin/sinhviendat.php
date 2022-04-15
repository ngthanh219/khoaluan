<?php

    require_once __DIR__.'/autoload.php';
    $title = " Danh sách sinh viên đỗ ";
    $sql = " SELECT tbl_sinhvien.* , tbl_lop.tenlop as tenlop ,tbl_doan.diem as diem ,tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa , tbl_hedaotao.tenhedaotao as hedaotao  FROM tbl_sinhvien 
            LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_sinhvien.id_machuyennganh
            LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_sinhvien.id_makhoa
            LEFT  JOIN  tbl_hedaotao ON tbl_hedaotao.mahedaotao = tbl_sinhvien.id_mahedaotao
            LEFT  JOIN  tbl_lop ON tbl_lop.malop = tbl_sinhvien.id_malop
            LEFT  JOIN  tbl_doan ON tbl_doan.id_masinhvien = tbl_sinhvien.masinhvien
             WHERE 1 AND tbl_doan.diem >= 5 ";

    $sinhvien = $pagi->pagination("tbl_sinhvien",$sql,'page',10);
  

?>

<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
    <html lang="en">
        <head>
            <?php require_once __DIR__.'/layout/head.php'; ?>
        </head>
        <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-fixed page-sidebar-closed-hide-logo">
            <!-- BEGIN HEADER -->
             <?php require_once __DIR__.'/layout/header.php'; ?>
            <!-- END HEADER -->
            <div class="clearfix"></div>
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                 <?php require_once __DIR__.'/layout/sidebar.php'; ?>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                       
                        <h3 class="page-title">
                           Danh sách sinh viên đạt tốt nghiệp 
                        </h3>
                       
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN PAGE CONTENT-->
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
                                    <th width="">Hình ảnh</th>
                                    <th> Tên sinh viên </th>
                                    <th class=""> Thông tin </th>
                                    <th class=""> Thông tin khác  </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sinhvien as $item):?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo base_url('/public/uploads/images/') ?><?= $item['hinhanh'] ?>" alt="" class="img img-thumbnail" style="width: 100px;height: 100px;">
                                        </td>
                                        <td>
                                            <span><?= $item['tensinhvien'] ?></span>
                                        </td>
                                        <td class="">
                                            <ul>
                                                <li> <span class="fa fa-phone"></span> Số điện thoại : <?= $item['sodienthoai'] ?> </li>
                                                <li> <span class=" fa fa-envelope"></span> Email : <?= $item['email'] ?> </li>
                                                <li> <span class=" fa fa-map-marker"></span> Quê quán : <?= $item['quequan'] ?> </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li> Hệ đào tao : <?= $item['hedaotao'] ?></li>
                                                <li> Khoa  : <?= $item['tenkhoa'] ?></li>
                                                <li> Chuyên Ngành  : <?= $item['tenchuyennganh'] ?></li>
                                                <li> Lớp  : <?= $item['tenlop'] ?></li>
                                                <li> Điểm   : <?= $item['diem'] ?></li>
                                            </ul>
                                        </td>
                                        

                                    </tr>
                                <?php endforeach;  ?>

                                </tbody>
                            </table>
                        </div>
                      
                    </div>
                      <div>
                            <?php echo $pagi->getListpage("page") ?>
                        </div>

                </div>
                        <!-- END PAGE CONTENT-->
                    </div>
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                
            <!-- END CONTAINER -->
<?php require_once __DIR__.'/layout/footer.php'; ?>