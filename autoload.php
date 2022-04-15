<?php session_start() ?>
<?php
/**
 * các hàm xử lý
 */
    require_once __DIR__ .'/vendor/helps/Function.php';
/**
 * xử lý cooke
 * tính view ,
 */
    require_once __DIR__ .'/vendor/helps/Cookies.php';
/**
 * xử lý database ( dữ liệu )
 */
    require_once __DIR__ .'/vendor/model/DB.php';
    $db = new DB();



?>