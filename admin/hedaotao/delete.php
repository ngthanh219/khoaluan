<?php

    require_once __DIR__.'/../autoload.php';
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $hedaotao = $db->fetchOne("tbl_hedaotao",(int)$id);
    //    dd($hedaotao);
    if (count($hedaotao) == 0)
    {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_hedaotao",(int) $id);
    if ($delete)
    {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/hedaotao");
    }
    else
    {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/hedaotao");
    }
?>