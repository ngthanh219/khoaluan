<?php
    require_once __DIR__.'/../autoload.php';
    $id = getValue("id","POST","");
     $sql = " SELECT tbl_sinhvien.* , tbl_lop.tenlop as tenlop ,tbl_chuyennganh.tenchuyennganh as tenchuyennganh , tbl_khoa.tenkhoa as tenkhoa , tbl_hedaotao.tenhedaotao as hedaotao  FROM tbl_sinhvien 
            LEFT JOIN tbl_chuyennganh ON tbl_chuyennganh.machuyennganh = tbl_sinhvien.id_machuyennganh
            LEFT JOIN tbl_khoa ON tbl_khoa.makhoa = tbl_sinhvien.id_makhoa
            LEFT  JOIN  tbl_hedaotao ON tbl_hedaotao.mahedaotao = tbl_sinhvien.id_mahedaotao
            LEFT  JOIN  tbl_lop ON tbl_lop.malop = tbl_sinhvien.id_malop
             WHERE 1 AND tbl_sinhvien.id = $id
        ";
     $sv = $db->fetchsql($sql);
?>
<div class="modal-dialog modal-lg">

<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"> Thông tin chi tiết sinh viên <span style="color: red"><?php echo $sv[0]['tensinhvien'] ?></span></h4>
  </div>
  <div class="modal-body">
        <div class="row">
           
            <div class="col-sm-5">
                <ul style="">
                    <li> Mã SV : <?php echo  $sv[0]['masinhvien'] ?></li>
                    <li> Họ tên : <?php echo  $sv[0]['tensinhvien'] ?></li>
                    <li> Ngày sinh  : <?php echo  $sv[0]['ngaysinh'] ?></li>
                    <li> Quê quán  : <?php echo  $sv[0]['quequan'] ?></li>
                    <li>  Số điện thoại   : <?php echo  $sv[0]['sodienthoai'] ?></li>
                    <li>  Email  : <?php echo  $sv[0]['email'] ?></li>
                     <li>  Khoa      : <?php echo  $sv[0]['tenkhoa'] ?></li>
                     <li>  Chuyên ngành     : <?php echo  $sv[0]['tenchuyennganh'] ?></li>
                    <li>  Lớp     : <?php echo  $sv[0]['tenlop'] ?></li>
                </ul>
            </div>
        </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
 </div>
