<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   html生成类
 */
defined('LMXCMS') or exit();
class html{
    private $url; //访问地址
    private $content; //存放内容
    private $dir; //存放的路径
    private $name; //文件名字
    public function set_config($url,$dir,$filename){
        $this->url = 'http://'.$_SERVER['SERVER_NAME'].'/'.$url;
        $this->dir = ROOT_PATH.$dir;
        $this->name = $filename;
    }
    
    public function setFile(){
        $this->content = file_get_contents($this->url);
        file::mkDir($this->dir); //创建不存在的目录
        file::put($this->dir.'/'.$this->name,$this->content);
    }
}
?>