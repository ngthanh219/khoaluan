<?php
	require_once __DIR__.'/vendor/helps/Function.php';
	@ob_start();
	session_start();
	if( ! $_SESSION['admin_id'])
	{
		redirect('/login');
	}
	else
	{
		redirect('/admin');
	}
?>