<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   管理员模块
 */
defined('LMXCMS') or exit();
class ManageModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->field=array('id','currtime','currip','name','pwd','lasttime','lastip');
        $this->tab=array('user');
    }
    
    //登录验证并保存登录状态
    public function LoginData($data){
        $userData = $this->getNameUserData($data['name']);
        if(!$userData) return false;
        if(md5($data['name'].string::pwdmd5($data['pwd'])) != md5($userData['name'].$userData['pwd'])){
            return false;
        }
        $login_Info = array(
            'currtime' => time(), //本次登录时间
            'currip' => getip(),  //本次登录ip
            'lasttime' => $userData['currtime'], //最后登录时间
            'currip' => $userData['currip'],//最后登录ip
            'name' => $userData['name'],
        );
        $this->setManageInfo($login_Info);
        $sess_username = encrypt($userData['name'],'E',$GLOBALS['public']['user_pwd_key']);
        //存储session和登录标识状态
        session('username',$sess_username);
        session('pwd',$userData['pwd']);
        session('time',time());
        session('userKey',string::pwdmd5($sess_username.$userData['pwd']));
        //设置帐号登录标记
//        $rand = rand(100000,999999);
//        $login_mark = encrypt($rand,'E',$GLOBALS['public']['user_pwd_key']);
//        setcookie('login_mark',$login_mark);
//        $GLOBALS['public']['login_mark'] = $rand;
//        f('public/conf',$GLOBALS['public'],true);
        return true;
    }
    
    //根据用户名验证管理员获取数据
    public function getNameUserData($name){
        $param['where'] = "name='$name'";
        return parent::oneModel($param);
    }
    
    //更新保存管理员本次登录信息
    public function setManageInfo($login_Info){
         $param['where'] = "name='".$login_Info['name']."'";
         unset($login_Info['name']);
         parent::updateModel($login_Info,$param);
    }
    
    //获取所有管理员
    public function getAllData(){
        $param['order'] = 'id desc';
        return parent::selectModel($param);
    }
    
    //增加管理员
    public function addManang($data){
        $pwd=string::pwdmd5($data['pwd']);
        $data=array(
            'name' => $data['name'],
            'pwd'  => $pwd,
            'currtime' => time(),
            'currip' => getIP(),
            'lasttime' => time(),
            'lastip' => getIP(),
        );
        return parent::addModel($data);
    }
    
    //根据用户验证用户是否存在
    public function isName($name){
        $param['where'] = "name='$name'";
        return parent::countModel($param);
    }
    
    //根据id获取管理员数据
    public function getIdUserData($id){
        $param['where'] = "id=$id";
        return parent::oneModel($param);
    }
    
    //根据id修改管理员
    public function updateUser($data){
        $param['where'] = "id=".$data['id']."";
        $arr['name'] = $data['name'];
        $arr['pwd'] = string::pwdmd5($data['pwd']);
        return parent::updateModel($arr,$param);
    }
    
    //根据id删除管理员
    public function delManage($id){
        $param=array(
            'where' => array(
                'id='.$id,
            ),
        );
        return parent::deleteModel($param);
    }
    //查询管理员数量
    public function getUserCount(){
        return parent::countModel();
    }
}
?>