<?php
require_once __DIR__.'/../autoload.php';
 if( isset($_SESSION['user_id']))
     {
        $_SESSION['errors'] = ' Ban khong co quyen truy cap';
         redirect('/admin/');
     }
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editGiaovien = $db->fetchOne("tbl_hoidong",(int)$id);
    //    dd($editGiaovien);
    if (count($editGiaovien) == 0)
    {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_hoidong",(int) $id);
    if ($delete)
    {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/hoidong");
    }
    else
    {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/hoidong");
    }
?>