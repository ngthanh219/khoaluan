<?php

require_once __DIR__.'/../autoload.php';
 if( isset($_SESSION['user_id']))
     {
        $_SESSION['errors'] = ' Ban khong co quyen truy cap';
         redirect('/admin/');
     }
 $ch = 'fix';
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editDoan = $db->fetchOne("tbl_doan",(int)$id);
    //    dd($editDoan);
    if (count($editDoan) == 0)
    {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_doan",(int) $id);
    if ($delete)
    {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/doan");
    }
    else
    {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/doan");
    }
?>