<?php

require_once __DIR__.'/../autoload.php';
$machuyennganh = getValue("machuyennganh","POST","");

$Lop = $db->query("tbl_lop","*"," AND id_machuyennganh = '".$machuyennganh."'");

?>

<option value=""> --  Mời bạn chọn lớp ! -- </option>
<?php foreach($Lop as $item) : ?>
    <option value="<?php echo $item['malop'] ?>"><?php echo $item['tenlop'] ?></option>
<?php endforeach ; ?>