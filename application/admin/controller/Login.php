<?php
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    // 前置操作
    protected $beforeActionList = [
        // 提前运行的方法    只有运行 index 时才运行 autoLogin这个函数
        //'autoLogin' => ['only' => 'index'],
    ];

    // 自动登录
    protected function autoLogin()
    {
        // 判断用户是否自动登录
        if (cookie('?admin')) {
            $admin    = cookie('admin');
            $username = encrypt($admin['username'], 'D', config('encrypt_key'));
            $password = encrypt($admin['password'], 'D', config('encrypt_key'));

            // 查询数据库，是否存在该用户
            $userData = db('admin')->where('username', $username)->where('password', $password)->find();

            if (empty($userData)) {
                // 如果用户没有勾选自动登录，则清除cookie
                cookie('admin', null);
                return $this->error('登录失败');
            }

            // 重新登录状态
            session('admin', ['username' => $userData['username'], 'id' => $userData['id']]);

            // 成功跳转地址
            return $this->redirect(url('/'));
        }
    }

    /**
     * 登录首页
     */
    public function index()
    {
        //接受参数
        //$request = Request::instance();

        //dump($request -> param());

        //request() -> post();
        //input('username');

        if (request()->isPost()) {
            // 组装数据
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'vcode'    => input('vcode'),
            ];

            // 实例化一个验证器
            // $validate = new Validate($valiArray);

            // 使用验证器验证结果
            // $valiResult = $validate -> check($data);

            $valiResult = $this->validate($data, 'Login');
            if ($valiResult !== true) {
                return $this->error($valiResult);
            }

            // if($valiResult === false)
            // {
            // return $this -> error($validate -> getError());
            // }

            // 验证验证码是否正确
            // if(! captcha_check($data['vcode']))
            // {
            //     //验证失败
            //     return $this -> error('验证码错误');
            // }

            // 查询数据库，是否存在该用户
            $adminData = db('admin')->where('username', $data['username'])->find();
            if (empty($adminData)) {
                return $this->error('该用户不存在');
            }
            //判断密码是否正确
            if (md5($data['password']) != $adminData['password']) {
                return $this->error('密码不正确');
            }

            // 查找用户权限信息
            //$Auth = new Auth;
            //$access = $Auth -> getAccess($adminData['id']);

            // 保存登录状态
            session('admin', [
                'username' => $adminData['username'],
                'id'       => $adminData['id'],
                //'access' =>  $access,
            ]);

            // 判断是否自动登录
            if (input('?post.reme')) {
                // 如果存在，则记住用户登录
                cookie('admin', [
                    'username' => encrypt($adminData['username'], 'E', config('encrypt_key')),
                    'password' => encrypt($adminData['password'], 'E', config('encrypt_key')),
                ], 3600 * 24 * 30);
            } else {
                // 如果用户没有勾选自动登录，则清除cookie
                cookie('admin', null);
            }

            return $this->redirect(url('home/index'));

        }

        // 加载视图
        return $this->fetch();
    }

}
