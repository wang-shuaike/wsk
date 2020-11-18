<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   系统配置控制器
 */
defined('LMXCMS') or exit();
class BasicAction extends AdminAction{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->smarty->display('Basic/basic.html');
    }
    //保存配置
    public function set(){
        $data = p($_POST,1);
        $weburl=$data['weburl'];
        if(!$weburl){
           rewrite::js_back('网站地址不能为空'); 
        }
        rewrite::regular_back('/\/$/',$weburl,'网站地址必须以“/”结尾');
        $arr['weburl'] = $weburl;
        $global = $data['global'];
        if($global && is_array($global)){
            foreach($global as $v){
                if(empty($v['name']) && empty($v['value'])){
                    continue;
                }
                if(empty($v['name']) && $v['value']){
                    rewrite::js_back('请填写变量名');
                }
                rewrite::regular_back('/^[a-zA-Z0-9_]+$/',$v['name'],'变量名只能由字母、数字、下划线组成');
                //检测重复的变量名
                $checkName[]=$v['name'];
                //赋值
                $v['name'] = $v['name'];
                $arr['global'][$v['name']] = $v['value'];
                $arr['globalType'][$v['name']] = $v['type'];
            }
        }else{
            $arr['global']=array();
            $arr['globalType']=array();
        }
        $checkName=array_count_values($checkName);
        foreach($checkName as $k=>$v){
            if($v > 1){
                rewrite::js_back('【'.$k.'】变量名重复，请检查');
            }
        }
        $arr['webname'] = $data['webname'];
        $arr['keywords'] = str_replace('，',',',$data['keywords']);
        $arr['description'] = $data['description'];
        $arr['ishtml'] = (int)$data['ishtml'] ? 1 : 0;
        $arr['searchtime'] = (int)$data['searchtime'];
        $arr['navsplit'] = $data['navsplit'];
		$arr['isbook'] = (int)$data['isbook'] ? 1 : 0;
		$arr['isbookdata'] = (int)$data['isbookdata'] ? 1 : 0;
        $arr['repeatbook'] = (int)$data['repeatbook'];
        $arr['issmall'] = (int)$data['issmall'];
        if(!isset($arr['issmall']) || !$arr['issmall'] || $arr['issmall'] < 0){
            $arr['issmall'] = 0;
        }
        $arr['iswater'] = (int)$data['iswater'];
        if(!isset($arr['iswater']) || !$arr['iswater'] || $arr['iswater'] < 0){
            $arr['iswater'] = 0;
        }
        $arr['small_width'] = (int)$data['small_width'];
        if(!$arr['small_width'] || $arr['small_width'] < 0){
            $arr['small_width'] = 150;
        }
        $arr['small_height'] = (int)$data['small_height'];
        if(!$arr['small_height'] || $arr['small_height'] < 0){
            $arr['small_height'] = 140;
        }
        $markImg = $data['markImg'];
        if($markImg){
            rewrite::regular_back('/^\/(.*)(.jpg|.png|.gif)$/',$markImg,'请正确填写水印图片路径');
        }
        $arr['markImg'] = $markImg ? $markImg : '/data/mark/mark.png';
        //格式化推荐与热门
        $arr['tuijianSelect'] = $data['tuijianSelect'];
        $arr['remenSelect'] = $data['remenSelect'];
        $arr['bookDisplay'] = (int)$data['bookDisplay'];
        $arr['booknum'] = (int)$data['booknum'];
        $arr['searchnum'] = (int)$data['searchnum'];
        //保存缓存文件
        foreach($arr as $k => $v){
            $GLOBALS['public'][$k] = $v;
        }
        f('public/conf',$GLOBALS['public'],true);
        //判断生成静态首页
        if(!$arr['ishtml']){
            //删除index.html文件
            file::unLink(ROOT_PATH.'index.html');
        }else{
            //生成index.html
            $schtml = new HtmlModel();
            $schtml->home();
        }
        addlog('修改基本设置');
        rewrite::succ('修改成功',u('Basic','index'));
    }
    
    
}
?>