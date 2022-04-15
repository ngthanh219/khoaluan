<?php
    $modules = "khoa";
    require_once __DIR__.'/../autoload.php';
    // lay id chuyen nganh can update
    $id = getValue("id","GET",'');
    // kiem tra xem co ton tai id trong csdl khong
    // neu khong ton tai thi thong bao loi
    $editKhoa = $db->fetchOne("tbl_khoa",(int)$id);
    //    dd($editKhoa);
    if (count($editKhoa) == 0)
    {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_khoa",(int) $id);
    if ($delete)
    {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/khoa");
    }
    else
    {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/khoa");
    }
?>