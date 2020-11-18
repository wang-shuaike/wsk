<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   后台登录控制器
 */
defined('LMXCMS') or exit();
class LoginAction extends Action{
    private $manageModel = null;
    public function __construct() {
        parent::__construct();
        if($this->manageModel == null){
            $this->manageModel = new ManageModel();
        }
    }
    
    //登录视图
    public function index(){
        if(self::isLogin()){
            rewrite::succ('您已经登录',u('Index','index'));
        }
        $this->smarty->display('Login/index.html');
    }
    
    //登录表单提交验证
    public function login(){
        if(!isset($_POST['sub'])){
            rewrite::js_back('禁止非法提交');
        }
        //获取登录数据
        $data = p(1,0,1);
        if(empty($data['name']) || empty($data['pwd'])){
            rewrite::js_back('帐号或密码不能为空');
        }
        $ischeck = $this->manageModel->LoginData($data);
        if(!$ischeck) rewrite::js_back ('用户名或者密码有误');
        //保存日志
        addlog('【'.$data['name'].'】登录后台');
        rewrite::succ('登录成功',u('Index','index'));
    }
    
    //验证登录是否有效并获取管理员名字
    public static function isLogin(){
        $loginInfo['username'] = session('username');
        $loginInfo['pwd'] = session('pwd');
        $loginInfo['time'] = session('time');
        $loginInfo['userKey'] = session('userKey');
//        $loginInfo['login_mark'] = $_COOKIE['login_mark'];
        foreach($loginInfo as $v){
            if(!$v){
                self::unsession();
                return false;
            }
        }
//        //不允许同一个帐号同时登录
//        if(encrypt($loginInfo['login_mark'],'D',$GLOBALS['public']['user_pwd_key']) != $GLOBALS['public']['login_mark']){
//            self::unsession();
//            rewrite::error('您的帐号已在其他地点登录',u('Login','index'));
//        }
        global $config;
        //判断超时登录
        if(time() - $loginInfo['time'] > $config['user_out_time'] * 60){
            self::unsession();
            rewrite::error('登录超时，请重新登录',u('Login','index'));
        }else{
            session('time',time());//更新超时时间
        }
        //判断帐号与密码是否正确
        if(string::pwdmd5($loginInfo['username'].$loginInfo['pwd']) != $loginInfo['userKey']){
            self::unsession();
            return false;
        }
        return true;
    }
    
    //判断如果没有登录转向到登录页面
    public static function isloginAction(){
        if(!self::isLogin()){
            rewrite::error('您还没有登录',u('Login','index'));
        }
        return encrypt(session('username'),'D',$GLOBALS['public']['user_pwd_key']);
    }
    
    //注销登录
    public function logout(){
        addlog('【'.encrypt(session('username'),'D',$GLOBALS['public']['user_pwd_key']).'】退出后台');
        self::unsession();
        //跳转后台登录页面
        rewrite::succ('退出登录成功',u('Login','index'));
    }
    
    //注销session
    public static function unsession(){
        unseion('pwd');
        unseion('userKey');
        unseion('username');
        unseion('time');
//        setcookie('login_mark','',time() - 3600);
    }
    
}
?>