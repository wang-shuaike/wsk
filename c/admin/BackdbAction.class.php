<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   数据库备份控制器
 */
defined('LMXCMS') or exit();
class BackdbAction extends AdminAction{
    private $backdbModel = null;
    public function __construct() {
        parent::__construct();
        if($this->backdbModel == null){
            $this->backdbModel = new BackdbModel();
        }
    }
    
    public function index(){
        $tabData = $this->backdbModel->ShowTable();
        $this->smarty->assign('tables',$tabData);
        $this->smarty->display('Back/index.html');
    }
    
    //备份数据
    public function backdbUp(){
        if($_POST['tabname']){
            $size = (int)$_POST['backsize'] && (int)$_POST['backsize'] > 0 ? (int)$_POST['backsize'] : 300;
            //设置php执行时间
            set_time_limit(0);
            $index = 1;
            $filename = 'backdb_lmxcms_'.date('Ymd').rand(100,999);
            $this->smarty->assign('info','备份数据中，请勿刷新，否则会导致数据备份不完全');
            $this->smarty->display('speed.html');
            foreach($_POST['tabname'] as $v){
                //获取数据表结构信息
                $str .= $this->tableComOne($v);
                //获取数据表数据信息
                $str .= $this->tableOneData($v);
                if(strlen($str) > $size * 1024){
                    $fj = true;
                    $this->setFile($str,$filename.'_'.$index.'.sql');
                    $str = '';
                    $index++;
                }
                //输出备份进度
                rewrite::speed('【'.$v.'】数据表备份成功..........');
            }
            if($fj){
                $this->setFile($str,$filename.'_'.$index.'.sql');
            }else{
                $this->setFile($str,$filename.'.sql');
            }
             //输出备份成功信息
            rewrite::speedSucc('备份数据库成功');
            rewrite::speedInfoBack('数据库备份成功');
            //恢复php默认执行时间
            set_time_limit(30);
            addlog('备份数据库');
        }else{
            rewrite::js_back('请选择要备份的数据表');
        }
    }
    
    //把sql保存到文件
    private function setFile($str,$filename){
        if($str){
            $lmxcms = "#---------------------------------------------------------#\r\n# LMXCMS \r\n# version:".$GLOBALS['publics']['version']." \r\n# Time: ".date('Y-m-d H:i:s')." \r\n# http://www.lmxcms.com \r\n# --------------------------------------------------------#\r\n\r\n\r\n";
            $str = $lmxcms.$str;
            file_put_contents(ROOT_PATH.'file/back/'.$filename,$str);
        }
    }
    
    //恢复数据列表页面
    public function backdbInList(){
        $dir = ROOT_PATH.'file/back/';
        $file = $this->getBackDirFile();
        //格式化
        $newFile = array();
        foreach($file as $v){
            $newFile[] = preg_replace('/(backdb_lmxcms_)([0-9]+)_[0-9]+/','$1$2',$v);
        }
        $newFile = array_unique($newFile);
        //初始化文件各种信息
        $index = 1;
        foreach($newFile as $k => $v){
            $fileInfo[$index]['filename'] = $v; //文件名
            //获取大小
            $fj = $this->getAllFile($file,$v);
            foreach($fj as $j){
                $fileInfo[$index]['filesize'] += filesize($dir.$j);
                $fileInfo[$index]['time'] = filemtime($dir.$j);
            }
            $fileInfo[$index]['filesize'] = round($fileInfo[$index]['filesize'] / 1024);
            $fileInfo[$index]['filesize'] = $fileInfo[$index]['filesize'] > 1024 ? round($fileInfo[$index]['filesize'] / 1024,2).'MB' : $fileInfo[$index]['filesize'].'KB';
            $fileInfo[$index]['fjfile'] = $fj;
            $index++;
        }
        //按照备份时间排序
        $fileInfo = tool::array_sort($fileInfo,'time','desc');
        $this->smarty->assign('backlist',$fileInfo);
        $this->smarty->display('Back/inlist.html');
    }
    
    //返回备份目录下所有的文件
    private function getBackDirFile(){
        $dir = ROOT_PATH.'file/back';
        if(!file_exists($dir)){
            rewrite::js_back('备份目录不存在，请手动创建'.$dir);
        }
        //获取目录下所有文件
        $fileArr = array();
        $op = opendir($dir);
        while(false!=$file=readdir($op)){
            if($file!='.' &&$file!='..'){
                $fileArr[] = $file;
            }
        }
        closedir($op);
        return $fileArr;
    }
    //下载备份文件
    public function downdb(){
        $filename = trim($_GET['filename']);
        $all = $this->getBackDirFile();
        //获取符合的文件
        $file = $this->getAllFile($all,$filename);
        if(!$file){
            rewrite::js_back('备份文件不存在');
        }
        $this->smarty->assign('downlist',$file);
        $this->smarty->display('Back/down.html');
    }
    //恢复备份
    public function backdbin(){
        $dir = ROOT_PATH.'file/back/';
        $filename = trim($_GET['filename']);
        $all = $this->getBackDirFile();
        //获取符合的文件
        $file = $this->getAllFile($all,$filename);
        if(!$file){
            rewrite::js_back('备份文件不存在');
        }
        $this->smarty->assign('info','数据库恢复中，请勿刷新，否则会导致恢复出错');
        $this->smarty->display('speed.html');
        //遍历恢复
        foreach($file as $v){
            $sql = '';
            $filepath = $dir.$v;
            $sql = file($filepath);
            $this->queryIn($sql);
        }
        rewrite::speedSucc('恢复数据库成功');
        rewrite::speedInfoBack('恢复数据库成功');
        addlog('恢复数据库备份');
    }
    
    //根据文件名获取所有分卷
    private function getAllFile($allfile,$filename){
        $file = array();
        foreach($allfile as $v){
            if(!(strpos($v,rtrim($filename,'.sql')) === false)){
                $file[] = $v;
            }
        }
        return $file;
    }
    
    //执行数组中的sql语句
    private function queryIn(array $sql){
        $query = '';
        foreach($sql as $v){
            if(!$v || $v[0] == '#'){
                continue;
            }else if(preg_match('/\;$/',trim($v))){
                $query .= $v;
                if(preg_match('/^DROP TABLE IF EXISTS (.*)\;$/',trim($v),$name)){
                    rewrite::speed('正在恢复【'.$name[1].'】数据表');
                }
                $this->backdbModel->backSql($query);
                $query = '';
            }else{
                $query .= $v;
            }
        }
    }
    
    //返回一张表结构
    private function tableComOne($tabname){
        $str = "DROP TABLE IF EXISTS $tabname;\r\n";
        $tabData = $this->backdbModel->getTableCom($tabname);
        $tabData[0]['Create Table'] = str_replace($tabData[0]['Table'],$tabname,$tabData[0]['Create Table']);
        return $str.=$tabData[0]['Create Table'].";\r\n";
    }
    
    //返回一张表的所有数据并组合sql语句
    private function tableOneData($tabname){
        $tabname = str_replace(DB_PRE,'',$tabname);
        $data = $this->backdbModel->getData($tabname);
        $data = $data ? $data : array();
        foreach($data as $k => $v){
            $s = array();
            $insertStr .= "INSERT INTO ".DB_PRE."$tabname VALUES(";
            foreach($v as $str){
                $s[] .= addslashes($str);
            }
            $insertStr .= "'".implode("','",$s)."'";
            $insertStr .= ");\r\n";
        }
        return $insertStr;
    }
    
    //删除备份文件
    public function delbackdb(){
        $filename = trim($_GET['filename']);
        if(!$filename){
            rewrite::js_back('备份文件不存在');
        }
        $all = $this->getBackDirFile();
        $this->delOne($all,$filename);
        addlog('删除数据库备份文件');
        rewrite::succ('删除成功');
    }
    
    //批量删除备份文件
    public function delmorebackdb(){
        $filename = $_POST['filename'];
        if($filename){
            $all = $this->getBackDirFile();
            foreach($filename as $v){
                $this->delOne($all,$v);
            }
            addlog('批量删除数据库备份文件');
            rewrite::succ('删除成功');
        }else{
            rewrite::js_back('请选择要删除的备份文件');
        }
    }
    
    //根据文件名删除一条备份文件
    private function delOne($all,$filename){
        $dir = $dir = ROOT_PATH.'file/back/';
        $file = $this->getAllFile($all,$filename);
        foreach($file as $v){
            file::unLink($dir.$v);
        }
    }
}
?>