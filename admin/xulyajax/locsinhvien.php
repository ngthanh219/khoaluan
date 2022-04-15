<?php

require_once __DIR__.'/../autoload.php';
$malop = getValue("malop","POST","");

$Sinhvien = $db->query("tbl_sinhvien","*"," AND id_malop = '".$malop."'");
?>

<option value=""> --  Mời bạn chọn sinh viên ! -- </option>
<?php foreach($Sinhvien as $item) : ?>
    <option value="<?php echo $item['masinhvien'] ?>"><?php echo $item['tensinhvien'] ?></option>
<?php endforeach ; ?>