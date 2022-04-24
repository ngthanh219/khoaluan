<?php
    require_once __DIR__.'/../autoload.php';
    $id = getValue("id","POST","");
    $sql = "SELECT tbl_doan.* ,tbl_sinhvien.tensinhvien as tensinhvien,tbl_lop.tenlop as tenlop ,tbl_hoidong.tenhoidong as tenhoidong,
            tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa  FROM tbl_doan 
        LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_doan.id_makhoa 
        LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_doan.id_machuyennganh 
        LEFT JOIN tbl_lop ON tbl_lop.malop = tbl_doan.id_malop
        LEFT JOIN tbl_sinhvien ON tbl_sinhvien.masinhvien = tbl_doan.id_masinhvien
         LEFT JOIN tbl_hoidong ON tbl_hoidong.id = tbl_doan.id_hoidong
        WHERE 1 and tbl_doan.id = $id;
    ";
    $doan = $db->fetchsql($sql);
    $hd = $db->fetchOne("tbl_hoidong",(int)$doan[0]['id_hoidong']);

?>
<div class="modal-dialog modal-lg">

<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"> Thông tin đồ án <span style="color: red"><?php echo $doan[0]['tensinhvien'] ?></span></h4>
  </div>
  <div class="modal-body">
        <div class="row">
            <?php if ($doan[0]['hinhanh'] != null) { ?>
                <div class="col-sm-3">
                    <img src="<?= base_url("/public/uploads/images/" . $doan[0]['hinhanh']) ?>" class="img img-responsive" />
                </div>
            <?php } ?>
            <div class="col-sm-9">
                <?php if ($doan[0]['gioithieu'] != null) { ?>
                    <div style="margin-top: 20px">
                        <?= $doan[0]['gioithieu'] ?>
                    </div>
                <?php } ?>
                <h2> Thông tin sinh viên</h2>
                <ul>
                    <li> Họ tên : <?php echo  $doan[0]['tensinhvien'] ?></li>
                    <li>  Lớp     : <?php echo  $doan[0]['tenlop'] ?></li>
                    <li>  Chuyên ngành     : <?php echo  $doan[0]['tenchuyennganh'] ?></li>
                    <li>  Khoa      : <?php echo  $doan[0]['tenkhoa'] ?></li>
                    
                </ul>
                <h2> Danh sách hội đồng <?php echo $doan[0]['tenhoidong'] ?></h2>
                <?php
                    $chutich = $db->fetchOne("tbl_giaovien",(int)$hd['id_chutich']);
                    $thuky = $db->fetchOne("tbl_giaovien",(int)$hd['id_thuky']);
                    $uyvien = $db->fetchOne("tbl_giaovien",(int)$hd['id_uyvien']);
                    $phanbien = $db->fetchOne("tbl_giaovien",(int)$hd['id_phanbien']);
                ?>
                <ul>
                    <li> Chủ tịch : <?= $chutich['tengiaovien'] ?> </li>
                    <li> Thư ký : <?= $thuky['tengiaovien'] ?> </li>
                    <li> Uỷ viên :<?= $uyvien['tengiaovien'] ?>  </li>
                    <li> Phản biện : <?= $phanbien['tengiaovien'] ?> </li>
                </ul>
               
            </div>
        </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
 </div>
