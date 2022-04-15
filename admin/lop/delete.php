<?php

    require_once __DIR__.'/../autoload.php';
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editLop = $db->fetchOne("tbl_lop",(int)$id);
    //    dd($editLop);
    if (count($editLop) == 0)
    {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_lop",(int) $id);
    if ($delete)
    {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/lop");
    }
    else
    {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/lop");
    }
?>