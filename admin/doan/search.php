<?php

    /**
     * gọi file autoload
     */require_once __DIR__.'/../autoload.php';
    
    $sql = "SELECT * FROM tbl_doan WHERE 1";

    $keyword = '';
    if(isset($_GET['keyword']) && $_GET['keyword'] != NULL )
    {
        $keyword = $_GET['keyword'];
        $sql .= " AND gioithieu LIKE  '%$keyword%' ";
    }
    // $sql .= " LIMIT 5";
    $kqtk =  $db->fetchsql($sql);    
?>  
    <?php if(isset($kqtk)  && count($kqtk) > 0):?>
         <ul id="retunrsearch">
            <?php foreach($kqtk as $item) :?>
                <li onClick="selectCountry('<?php echo $item["tendoan"]; ?>');">
                     <a href="/admin/doan/update.php?id=<?=  $item['id'] ?>" title=""><?php echo ColorFind($keyword,$item["tendoan"]); ?></a>
                </li>
            <?php endforeach ; ?>
        </ul>
    <?php else : ?>
        <ul id="retunrsearch">
            <li> Không có kết quả tìm kiếm </li>
        </ul>
    <?php endif ; ?>
