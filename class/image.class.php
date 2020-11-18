<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   图片类
 */
defined('LMXCMS') or exit();
class image{
    static function getImageInfo($img) {
    $imageInfo = getimagesize($img);
    if ($imageInfo !== false) {
        $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
        $imageSize = filesize($img);
        $info = array(
            "width" => $imageInfo[0],
            "height" => $imageInfo[1],
            "type" => $imageType,
            "size" => $imageSize,
            "mime" => $imageInfo['mime']
        );
            return $info;
        } else {
            return false;
        }
    }
    
    //加水印   背景图片 水印图片 保存图片路径不填覆盖原图 水印图片透明度
    static function addWater($img,$water,$savename=null,$alpha=80){
        if (!file_exists($img) || !file_exists($water)){
            return false;
        }
        //GIF图片禁止加水印
        $imageInfo = pathinfo($img);
        if($imageInfo['extension'] == 'gif'){
            return false;
        }
        $img_info = self::getImageInfo($img);
        $water_info = self::getImageInfo($water);
        
         //如果图片小于水印图片，不生成图片
        if ($img_info["width"] < $water_info["width"] || $img_info['height'] < $water_info['height']){
            return false;
        }
        
        //建立图像
        $sCreateFun = "imagecreatefrom" . $img_info['type'];
        $sImage = $sCreateFun($img);
        $wCreateFun = "imagecreatefrom" . $water_info['type'];
        $wImage = $wCreateFun($water);
        
        //设定图像的混色模式
        imagealphablending($water,true);
        //图像位置,默认为右下角右对齐
        $posY = $img_info["height"] - $water_info["height"];
        $posX = $img_info["width"] - $water_info["width"];
        
        //生成混合图像
        if($water_info['type'] == 'png'){
            imagecopy($sImage,$wImage,$posX,$posY,0,0,$water_info['width'], $water_info['height']);
        }else{
            imagecopymerge($sImage,$wImage,$posX,$posY,0,0,$water_info['width'],$water_info['height'], $alpha);
        }
        
        //输出图像
        $ImageFun = 'image'. $img_info['type'];
        //如果没有给出保存文件名，默认为原图像名
        if (!$savename) {
            $savename = $img;
            @unlink($img);
        }
        //保存图像
        if ($img_info['type'] == 'jpg' || $img_info['type'] == 'jpeg') {
            imagejpeg($sImage,$savename,90);
        }else{
            $ImageFun($sImage,$savename);
        }
        imagedestroy($sCreateFun);
        return true;
    }
    
    //生成缩略图   原图  缩略图宽度 缩略图高度
    static function smallImage($name,$width=300,$height=200){
        $src_img = $name;
        $ytinfo = self::getImageInfo($src_img);// 获取原图信息
        $dst_scale = $height/$width; //目标图像长宽比 
        $src_scale = $ytinfo['height']/$ytinfo['width']; // 原图长宽比 
        if($src_scale>=$dst_scale) 
        { 
            // 过高 
            $w = intval($ytinfo['width']); 
            $h = intval($dst_scale*$w); 
            $x = 0; 
            $y = ($ytinfo['height'] - $h)/3; 
        } 
        else 
        { 
            // 过宽 
            $h = intval($ytinfo['height']); 
            $w = intval($h/$dst_scale); 
            $x = ($ytinfo['width'] - $w)/2; 
            $y = 0; 
        } 
        // 剪裁 
        $imagecreate = 'imagecreatefrom'.$ytinfo['type'];
        $source=$imagecreate($src_img); 
        $croped=imagecreatetruecolor($w,$h); 
        imagecopy($croped,$source,0,0,$x,$y,$ytinfo['width'],$ytinfo['height']); 
        // 缩放 
        $scale = $width/$w; 
        $target = imagecreatetruecolor($width, $height); 
        $final_w = intval($w*$scale); 
        $final_h = intval($h*$scale)+1; 
        imagecopyresampled($target,$croped,0,0,0,0,$final_w,$final_h,$w,$h); 
        //保存 
        //获取文件名
        $path = pathinfo($name);
        $dirname = $path['dirname']!='.' ? $path['dirname'].'/' : '';
        $filename = $dirname.'small_'.$path['filename'].'.jpg';
        imagejpeg($target,$filename); 
        imagedestroy($target);
        return $filename;
    }
}
?>