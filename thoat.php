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

    if ($_SESSION['table'] == "tbl_giaovien") {
        header("Location: " . base_url("/giangvien/login"));
    }

    if ($_SESSION['table'] == "tbl_sinhvien") {
        header("Location: " . base_url("/sinhvien/login"));
    }

    if ($_SESSION['table'] == "tbl_quanly") {
        header("Location: " . base_url());
    }
?>