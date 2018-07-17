<?php
namespace app\common\model;

use think\Model;
use think\facade\Session;
class User extends Model
{
    protected $table = 'qiyun_user';
    protected $auto  = ['user_id','create_time'];
    public function setUserIdAttr($id)
    {
        return  Session::get('user.id');
    }
    public function crypto($name='', $password='')
    {
        return md5($name.$password);
    }
    
}
