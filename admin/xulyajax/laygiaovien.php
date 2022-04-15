<?php

	require_once __DIR__.'/../autoload.php';
	$sinhvien = getValue("sinhvien","POST","");


	$edit = $db->fetchOne("tbl_sinhvien"," masinhvien = '".$sinhvien."'");
	   
	$machuyennganh = $edit['id_machuyennganh'] ;
	$giaovien = $db->query("tbl_giaovien","*"," AND id_machuyennganh = '".$machuyennganh."'");
?>

	<option value=""> --  Mời bạn chọn giáo viên ! -- </option>
<?php foreach($giaovien as $item) : ?>
    <option value="<?php echo $item['id'] ?>"><?php echo $item['tengiaovien'] ?></option>
<?php endforeach ; ?>