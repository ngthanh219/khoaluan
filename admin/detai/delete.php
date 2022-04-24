<?php
    require_once __DIR__.'/../autoload.php';
    
    $id = getValue("id", "GET", "");
    
    $detai = $db->fetchOne("tbl_detai", (int) $id);
    
    if (count($detai) == 0) {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_detai", (int) $id);

    if ($delete) {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/detai");
    } else {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/detai");
    }
?>