<?php

    require_once __DIR__.'/../autoload.php';
    $makhoa = getValue("makhoa","POST","");

    $chuyennganh = $db->query("tbl_chuyennganh","*"," AND id_makhoa = '".$makhoa."'");
?>

<option value=""> --  Mời bạn chọn chuyên ngành ! -- </option>
<?php foreach($chuyennganh as $item) : ?>
    <option value="<?php echo $item['machuyennganh'] ?>"><?php echo $item['tenchuyennganh'] ?></option>
<?php endforeach ; ?>