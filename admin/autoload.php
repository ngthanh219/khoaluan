<?php @ob_start(); session_start() ?>
<?php
// @ob_start();
// session_start();
/**
 * các hàm xử lý
 */
    require_once __DIR__ .'/../vendor/helps/Function.php';
/**
 * xử lý cooke
 * tính view ,
 */
    require_once __DIR__ .'/../vendor/helps/Cookies.php';
/**
 * xử lý database ( dữ liệu )
 */
    require_once __DIR__ .'/../vendor/model/DB.php';
    require_once __DIR__ .'/../vendor/model/Pagination.php';
    $db = new DB();
    $pagi = new Pagination();

// lay duong dan
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/public/uploads/images/");
    define("ROOT_FILE", $_SERVER['DOCUMENT_ROOT'] ."/public/uploads/file/");
// check login
    if( ! isset($_SESSION['check_login']) )
    {
        redirect(base_url());
    }

    if(isset($_SESSION['user_id']))
    {
        $modules = '';
        if(isset($modules) && $modules == 'khoa' || $modules == 'chuyennganh' || $modules == 'hedaotao' || $modules == 'nienkhoa' || $modules == 'lop' || $modules == 'sinhvien' || $modules == 'quanly' || $modules == 'index' || isset($ch) && $ch == 'fix')
        {
            redirect('/admin/doan');
        }
    }
?>