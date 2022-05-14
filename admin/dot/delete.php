<?php
    require_once __DIR__.'/../autoload.php';
    
    $id = getValue("id", "GET", "");
    
    $dot = $db->fetchOne("tbl_dot", (int) $id);
    
    if (count($dot) == 0) {
        redirect('/admin/404.php');
    }

    $delete = $db->delete("tbl_dot", (int) $id);

    if ($delete) {
        $_SESSION['success'] = " Xóa thành công !!! ";
        redirect("/admin/dot");
    } else {
        $_SESSION['errors'] = "XÓa thất bại !!! ";
        redirect("/admin/dot");
    }
?>