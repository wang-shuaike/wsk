<?php
    //直接下载任何类型的文件
    if(!$_GET['filename']){
        exit;
    }
    $filename = $_GET['filename'];
    header("Content-Type:application/force-download");
    header("Content-Disposition: attachment; filename=".basename($filename));
    readfile($filename);
?>