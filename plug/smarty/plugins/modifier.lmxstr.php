<?php
/*
 * 字符串截取
 * 
 * 
 */
function smarty_modifier_lmxstr($str,$len,$doc=''){
     if($str && $len){
        return lmxstr($str,$len,$doc);
    }else{
        return $str;
    }
}


?>
