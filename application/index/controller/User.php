<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Request;
use app\index\model\User as UserModel;
use think\Session;
class User extends Base
{
    /**
     * 登陆
     */
    public function login()
    {

        $this -> alreadyLogin();
        return $this->fetch();
    }

    /**
     * 验证登录 $this -> validate($data,$rule,$msg)
     */
    public function chickLogin(Request $request)
    {
        //初始返回参数
        $status = 0;
        $result = '';
        $data = $request -> param();

        //设置rule规则
        $rule =[
            'name|用户名' => 'require',
            'password|密码' => 'require',
            'verify|验证码' => 'require|captcha'
        ];

        //设置提示信息
//        $msg = [
//              'name' => ['require' => '用户名不能为空'],
//              'password' => ['require' => '密码不能为空'],
//              'verify' => ['require' => '验证码不能为空']
//        ];

        //进行验证
        $result =$this ->validate($data,$rule);
        if(!isset($_SESSION)){
            session_start();

        }
        //如果验证通过
        if ($result === true){
            //构造查询条件
            $map =[
              'name' => $data['name'],
              'password' => md5($data['password'])
            ];
            //查询用户
            $user = UserModel::get($map);
            if ($user == null){
                $result = '没有找到该用户';
            }else{
                $status = 1;
                $result = '验证通过，点击【确定进入】';
                //设置用户登录信息用session
                Session::set('user_id',$user ->id);
                Session::set('user_info',$user->getData());
            }
        }
        return ['status' => $status, 'message' => $result, 'data' => $data];
    }

    /**
     * 退出
     */
    public function loginOut()
    {
        //注销session
        Session::delete('user_id');
        Session::delete('user_info');
        $this -> success('退出登录','user/login');
    }

    /**
     * 管理员列表
     */
    public function adminList()
    {
        $this -> view -> assign('title','管理员列表');
        $this -> view -> assign('keyword' , 'php中文网');
        $this -> view -> assign('desc','thinkPHP');
        //计算总得条数
        $this -> view -> count = UserModel::count();
        //判断是否为admin
        //通过session获取登陆用户名
        $username = Session::get('user_info.name');
        if ($username =='admin'){
            $list=UserModel::all();
        }else{
            $list = UserModel::all(['name'=>$username]);
        }
        $this -> assign('list',$list);
        return $this -> fetch('admin_list');
    }

    /**
     * 管理员状态变更
     */
    public function setStatus(Request $request)
    {
        $user_id = $request -> param('id');
        $result = UserModel::get($user_id);
        if($result->getData('status') == 1) {
            UserModel::update(['status'=>0],['id'=>$user_id]);
        } else {
            UserModel::update(['status'=>1],['id'=>$user_id]);
        }
    }

    /**
     *
     */

}

