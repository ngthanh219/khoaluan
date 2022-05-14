<?php
$modules = "doan";
    $title = " Cập nhật đồ án    ";
     $ch = 'fix';
    require_once __DIR__.'/../autoload.php';
     if( isset($_SESSION['user_id']))
     {
        $_SESSION['errors'] = ' Ban khong co quyen truy cap';
         redirect('/admin/');
     }
    $khoa        = $db->query("tbl_khoa","*","");
    $chuyennganh = $db->query("tbl_chuyennganh","*","");
    $lop         = $db->query("tbl_lop","*","");
    $hedaotao    = $db->query("tbl_hedaotao","*","");
    $sinhvien    = $db->query("tbl_sinhvien","*","");
    $giaovien    = $db->query("tbl_giaovien","*","");
    $hoidong    = $db->query("tbl_hoidong","*","");
    $dot    = $db->query("tbl_dot","*","");

     // lay id khoa can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editDoan = $db->fetchOne("tbl_doan",(int)$id);
    //    dd($editDoan);
    if (count($editDoan) == 0)
    {
        redirect('/admin/404.php');
    }

    $detaihientai = $db->query("tbl_detai", "*", " AND madetai = '" . $editDoan["tendoan"] . "'")[0];
    $sql = " SELECT tbl_doan_giaovien.*, tbl_giaovien.tengiaovien as tengiaovien,tbl_giaovien.id as idgv from tbl_doan_giaovien
    LEFT JOIN  tbl_giaovien on tbl_giaovien.id = tbl_doan_giaovien.id_giaovien
     WHERE id_doan = $id ";
    $listgv = $db->fetchsql($sql);

   // var_dump($listgv);die;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $id_makhoa = getValue("id_makhoa","POST","");
        $id_machuyennganh = getValue("id_machuyennganh","POST","");
        $id_malop = getValue("id_malop","POST","");
        $id_masinhvien = getValue("id_masinhvien","POST","0");
        $tendoan = getValue("tendoan","POST","");
        $madoan = getValue("madoan","POST","");
        $url = getValue("url","POST","");
        $gioithieu = getValue("gioithieu","POST","");
        $diem = getValue("diem","POST","");
        $id_giaovien = getValue("id_giaovien","POST","");
        $id_hoidong = getValue("id_hoidong","POST","");
        $dot_id = getValue("dot_id","POST","");
       $giaovien_pb = getValue("giaovien_pb","POST","");

        if ($id_makhoa == '')
        {
            $errors['id_makhoa'] = ' Mã khoa không được để trống ' ;
        }
        if ($id_hoidong == '')
        {
            $errors['id_hoidong'] = ' Hội đồng không được để trống ' ;
        }

        if ($dot_id == '')
        {
            $errors['dot_id'] = ' Đợt không được để trống ' ;
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

        // if ($id_masinhvien == '')
        // {
        //     $errors['id_masinhvien'] = ' Mã sinh vien   không được để trống ' ;
        // }

      

        // if ($tendoan == '')
        // {
        //     $errors['tendoan'] = ' Tên đồ án    không được để trống ' ;
        // }

        if ($madoan == '')
        {
            $errors['madoan'] = ' Mã đồ án     không được để trống ' ;
        }
        else 
        {
            if ($madoan != $editDoan['madoan'])
            {
                $checkEsist = $db->fetchOne("tbl_doan","madoan = '".$madoan."' ");
                if ($checkEsist  && count($checkEsist) > 0)
                {
                    $errors['madoan']  = ' Mã đồ án  đã tồn tại ' ;
                }
            }
        }

        // if ($url == '') {
        //     $errors['url'] = 'url     không được để trống ' ;
        // }

        if ($gioithieu == '')
        {
            $errors['gioithieu'] = 'gioithieu     không được để trống ' ;
        }

        if (empty($errors))
        {
            $data = 
            [
                'id_makhoa' => $id_makhoa,
                'id_machuyennganh' => $id_machuyennganh,
                'id_malop'   => $id_malop,
                'id_masinhvien' => $id_masinhvien,
                'id_hoidong' => $id_hoidong,
                // 'tendoan' => $tendoan,
                'madoan' => $madoan,
                'url' => $url,
                'gioithieu' => $gioithieu,
                'diem' => $diem,
                'id_giaovien' => $id_giaovien,
                'dot_id' => $dot_id
            
            ];

            if ( isset ($_FILES['hinhanh']) && $_FILES['hinhanh']['name'] != NULL)
            {
                $file_name = $_FILES['hinhanh']['name'];
                $file_tmp  = $_FILES['hinhanh']['tmp_name'];
                $file_type = $_FILES['hinhanh']['type'];
                $file_erro = $_FILES['hinhanh']['error'];
                if ($file_erro == 0)
                {
                    $data['hinhanh'] = $file_name;
                    move_uploaded_file($file_tmp,ROOT.$file_name);
                }
            }

             if ( isset($_FILES['file']) && $_FILES['file']['name'] != null)
            {
                $file_name_file = $_FILES['file']['name'];
                $file_tmp_file  = $_FILES['file']['tmp_name'];
                $file_type_file = strtolower($_FILES['file']['type']);
                $file_erro_file = $_FILES['file']['error'];
                if ($file_erro_file == 0)
                {
                    $file = $file_name_file;
                    $checkType = ['application/x-rar-compressed','application/octet-stream'];
                    if ($file_type_file == $checkType[0] || $file_type_file == $checkType[1])
                    {
                        
                        $_SESSION['errors'] = " File khong dung dinh dang  ";
                        redirect('/admin/doan');
                    }else
                    {
                         move_uploaded_file($file_tmp_file,ROOT_FILE.$file);
                         $data['file'] = $file;
                    }
                }
            }
            
            $update = $db->update("tbl_doan",$data," id = $id ");

            if($giaovien_pb != '')
            {
                 $giaovien_pb = explode(',', $giaovien_pb);
                foreach($listgv as $item)
                {
                    $db->delete("tbl_doan_giaovien","id_doan = ".$id);  
                }
                for($i = 0; $i < count($giaovien_pb) ; $i++ )
                {
                    $id_gv = (int)$giaovien_pb[$i];
                    $data2 = 
                    [
                        'id_doan' => $id,
                        'id_giaovien' => $id_gv
                    ];
                    $insert2 = $db->insert("tbl_doan_giaovien",$data2);
                }
            }
            if($update)
            {
                move_uploaded_file($file_tmp,ROOT.$hinhanh);
                $_SESSION['success'] = " Cap nhat  thành công " ;

               
                redirect('/admin/doan');
            }
            else
            {
                $_SESSION['errors'] = " Cap nhat  thất bại ";
                redirect('/admin/doan');
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

    #img-upload{
        width: 100%;
    }
    .box-action
    {
        position: fixed;
        right: 41px;
        z-index: 9;
        top:40%;
        /*transform: translateY(-50%);*/
        /*top:50%;*/

    }
    .box-action a
    {
        display: block;
        border: 1px solid #dedede;
        margin-bottom: 5px;
        padding: 5px;
        background-color: white;
        color: #000;
    }
    .box-action a:hover,.box-action a:focus
    {
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
                        <a href="index.php" class="btn red" style="color: white"> <i class="fa fa-plus"></i>  Trở về </a>
                    </li>
                </ul>
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box green ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>  <?php echo isset($title) ?  $title : '' ?>
                            </div>

                        </div>
                        <div style="" class="box-action">
                            <a href="#info"  class="actionscoll"><i class="fa fa-search"></i> Thông tin </a>
                            <a href="#image"  class="actionscoll"><i class="fa fa-search"></i> Hình ảnh </a>
                            <a href="#desc" class="actionscoll"><i class="fa fa-search"></i>  Giới thiệu  </a>
                        </div>
                    
                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-body" id="info">

                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label"> Khoa  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_makhoa" class="form-control makhoa">
                                                <option value=""> --  Mời bạn chọn khoa ! -- </option>
                                                <?php foreach($khoa as $item) : ?>
                                                    <option value="<?php echo $item['makhoa'] ?>" <?php echo isset($editDoan) && $editDoan['id_makhoa'] == $item['makhoa'] ? "selected='selected'" : "" ?>><?php echo $item['tenkhoa'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_makhoa']) && $errors['id_makhoa'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_makhoa'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="info">
                                        <label class="col-md-2 control-label "> Chuyên ngành  <span class="text-danger">(*)</span>   </label>
                                        <div class="col-md-9">
                                            <select name="id_machuyennganh" class="form-control chuyennganh">
                                                <option value=""> --  Mời bạn chọn chuyên ngành ! -- </option>
                                                <?php foreach ($chuyennganh as $item): ?>
                                                     <option value="<?php echo $item['machuyennganh'] ?>" <?php echo isset($editDoan) && $editDoan['id_machuyennganh'] == $item['machuyennganh'] ? "selected='selected'" : "" ?>><?php echo $item['tenchuyennganh'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php if (isset($errors['id_machuyennganh']) && $errors['id_machuyennganh'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_machuyennganh'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Lớp   </label>
                                        <div class="col-md-4">
                                            <select name="id_malop" class="form-control lop">
                                                <option value=""> --  Mời bạn chọn lớp ! -- </option>
                                                <?php foreach($lop as $item) : ?>

                                                    <option value="<?php echo $item['malop'] ?>" <?php echo isset($editDoan) && $editDoan['id_malop'] == $item['malop'] ? "selected='selected'" : "" ?>><?php echo $item['tenlop'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_malop']) && $errors['id_malop'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_malop'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label"> Gíao viên   </label>
                                        <div class="col-md-4">
                                            <select name="id_giaovien" class="form-control">
                                                <option value=""> --  Mời bạn chọn giáo viên ! -- </option>
                                                <?php foreach($giaovien as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($editDoan) && $editDoan['id_giaovien'] == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['tengiaovien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_giaovien']) && $errors['id_giaovien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_giaovien'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Sinh viên   </label>
                                        <div class="col-md-4">
                                            <select name="id_masinhvien" class="form-control sinhvien">
                                                <option value=""> --  Mời bạn sinh viên ! -- </option>
                                                <?php foreach($sinhvien as $item) : ?>
                                                    <option value="<?php echo $item['masinhvien'] ?>" <?php echo isset($editDoan) && $editDoan['id_masinhvien'] == $item['masinhvien'] ? "selected='selected'" : "" ?>><?php echo $item['tensinhvien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_masinhvien']) && $errors['id_masinhvien'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_masinhvien'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Hội đồng   </label>
                                        <div class="col-md-4">
                                            <select name="id_hoidong" class="form-control">
                                                <option value=""> --  Mời bạn chọn hội đồng ! -- </option>
                                                <?php foreach($hoidong as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($editDoan) && $editDoan['id_hoidong'] == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['tenhoidong'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['id_hoidong']) && $errors['id_hoidong'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['id_hoidong'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Đợt   </label>
                                        <div class="col-md-4">
                                            <select name="dot_id" class="form-control">
                                                <option value=""> --  Mời bạn chọn đợt ! -- </option>
                                                <?php foreach($dot as $item) : ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php echo isset($editDoan) && $editDoan['dot_id'] == $item['id'] ? "selected='selected'" : "" ?>><?php echo $item['dot'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['dot_id']) && $errors['dot_id'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['dot_id'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Tên đồ án </label>
                                        <div class="col-md-9">
                                            <input type="text" name="tendoan" class="form-control inputForm" value="<?php echo $detaihientai['tendetai'] ?>" disabled>
                                        </div>
                                    </div>
                                        
                                    <!-- <div class="form-group">
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
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label class="col-md-2 control-label"> Tên đồ án   </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control inputForm" name="tendoan" placeholder=" VD : Nguyễn Văn A " value="<?php echo $editDoan['tendoan'] ?>">
                                            <?php if (isset($errors['tendoan']) && $errors['tendoan'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['tendoan'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mã đồ án  </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control input-inline input-medium"  name="madoan" placeholder="MSP01212" value="<?php echo $editDoan['madoan'] ?>" >
                                            <?php if (isset($errors['madoan']) && $errors['madoan'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['madoan'] ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <label class="col-md-2 control-label"> Điểm   </label>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control"  name="diem" placeholder="10" value="<?php echo $editDoan['diem'] ?>" step="0.01">
                                            <?php if (isset($errors['diem']) && $errors['diem'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['diem'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Giáo viên phản biện  </label>
                                        <div class="col-md-9">
                                            <?php foreach($listgv as $val) :?>
                                                <span class="btn btn-xs btn-success" style="margin-bottom: 2px;"> <?= $val['tengiaovien'] ?></span>
                                            
                                            <?php endforeach ; ?>
                                           
                                             <select id="dates-field2" class="multiselect-ui form-control" multiple="multiple" name="">
                                                <?php foreach($giaovien as $item) :?>
                                                     <option value="<?= $item['id'] ?>"><?= $item['tengiaovien'] ?></option>
                                                <?php endforeach ; ?>
                                            </select>
                                            <?php if (isset($errors['giaovien_pb']) && $errors['giaovien_pb'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['giaovien_pb'] ?></span>
                                            <?php endif; ?>
                                            <input type="hidden" name="giaovien_pb" value="" id="value-select">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label"> Link online  </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="url" placeholder="MSP01212" value="<?php echo $editDoan['url'] ?>" >
                                            <?php if (isset($errors['url']) && $errors['url'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['url'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">  Link offline  </label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control"  name="file" placeholder="file" value="" >
                                            <span><a  href="<?php echo base_url('/public/uploads/file/' . $editDoan['file']) ?>"><?php echo $editDoan['file'] ?></a></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="image" style="border: 1px solid #dedede;padding: 20px;margin: 20px">
                                        <label>  Hình ảnh </label>
                                        <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        Browse… <input type="file" id="imgInp" name="hinhanh">
                                                    </span>
                                                </span>
                                            <input type="text" class="form-control" readonly value=" Chưa có ảnh nào được chọn  ">
                                            
                                        </div>
                                       
                                        <?php if($editDoan['hinhanh'] != '') : ?>
                                            <img id='img-upload' src="<?php echo base_url('/public/uploads/images/') ?><?php echo $editDoan['hinhanh'] ?>" alt="" class="img img-responsive" style="width: 300px;height: 300px;"/>
                                        <?php endif ; ?>

                                        <?php if (isset($errors['hinhanh']) && $errors['hinhanh'] != '') :?>
                                            <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['hinhanh'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group" id="desc">

                                        <h5 class="col-sm-10" style="padding-left: 31px"> <label>  Giới thiệu  </label></h5>
                                        <div class="col-sm-10" style="padding-left:30px">
                                            <textarea name="gioithieu" id="summernote" cols="117"  rows="10"><?php echo $editDoan['gioithieu'] ?></textarea>
                                            <?php if (isset($errors['gioithieu']) && $errors['gioithieu'] != '') :?>
                                                <span class="help-block" style="margin-bottom: -10px"><?php echo $errors['gioithieu'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                                <?php echo renderAction() ?>
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
        $(function(){
            $('#summernote').summernote();
        })
         $(function() {
            $('#dates-field2').selectpicker();
            $('#dates-field2').change(function(e){
            
                var selectedValues = $(this).val();  
                $("#value-select").attr('value',selectedValues);
            
            } )

            $(".filter-option").html('Mời bạn chọn danh sách giáo viên phản biên nếu muốn thay đổi ');
        })

    </script>

    <script>
        $(function () {
            $(".makhoa").change(function (event) {
                event.preventDefault();
                event.stopPropagation();
                // lay ma khoa
                let $makhoa = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url     : url + '/admin/xulyajax/laychuyennganh.php',
                    type    : "POST",
                    data    : ({ 'makhoa' : $makhoa }),
                    success : function(responsive)
                    {
                        $(".chuyennganh").html("");
                        $(".chuyennganh").append(responsive);
                    }
                })
            })

            $(".chuyennganh").change(function (event) {
                event.preventDefault();
                event.stopPropagation();

                // lay ma chuyen nganh
                let $machuyennganh = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url     : url + '/admin/xulyajax/loclop.php',
                    type    : "POST",
                    data    : ({ 'machuyennganh' : $machuyennganh }),
                    success : function(responsive)
                    {
                        $(".lop").html("");
                        $(".lop").append(responsive);
                    }
                })

            })
            $(".lop").change(function (event) {
                event.preventDefault();
                event.stopPropagation();

                // lay ma chuyen nganh
                let $malop = $(this).val();
                // gui toi file xu ly
                let url = window.location.origin;

                $.ajax({
                    url     : url + '/admin/xulyajax/locsinhvien.php',
                    type    : "POST",
                    data    : ({ 'malop' : $malop }),
                    success : function(responsive)
                    {
                        $(".sinhvien").html("");
                        $(".sinhvien").append(responsive);
                    }
                })

            })
        })
    </script>
