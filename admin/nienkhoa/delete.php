<?php

    require_once __DIR__.'/../autoload.php';
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $nienkhoa = $db->fetchOne("tbl_nienkhoa",(int)$id);
    //    dd($nienkhoa);
    if (count($nienkhoa) == 0)
    {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_nienkhoa",(int) $id);
    if ($delete)
    {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/nienkhoa");
    }
    else
    {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/nienkhoa");
    }
?>