<?php
	@ob_start();
    session_start();

require_once __DIR__ .'/vendor/helps/Function.php';
    // if (isset($_SESSION['admin_name']))
    // {
    //     unset($_SESSION['admin_name']);
    //     unset($_SESSION['admin_id']);

    //     header("Location: http://quanlydoan.dev");
    // }

    session_destroy();
     header("Location: ".base_url());

?>