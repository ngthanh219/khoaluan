<?php
    
    require_once __DIR__.'/../autoload.php';
     

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



    
   $update = $db->update("tbl_doan",[
            'id_masinhvien' => $_SESSION['user_id_msv']
        ]," id = $id ");

        redirect('/admin/select-doan');

?>

