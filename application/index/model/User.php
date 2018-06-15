<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 11:55
 */
namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    //导入软删除方法集
    use SoftDelete;
    //设置软删除字段
    //只有该字段为NULL，该字段才会显示出来
    protected $deleteTime = 'delete_time';

    //保存自动完成列表
    protected $auto = [
      'delete_time' => NULL,
      'is_delete' => 1, //1:允许删除 0禁止删除
    ];

    //新增自动完成列表
    protected $insert =[
        'login_time' => NULL,
        'login_count' => 0,
    ];
    //更新自动完成列表
    protected $update = [];
    //是否需要自动写入时间戳 如果设置为字符串 则表示时间字段的类型
    protected $autoWriteTimestamp = true;
    //创建时间字段


    //数据表角色字段
    public function getRoleAttr($value)
    {
        $role= [
          1 => '超级管理员',
          0 => '管理员'
        ];
        return $role[$value];
    }

    //状态字段返回值
    public function getStatusAttr($value)
    {
        $status = [
          0 => '已停用',
            1 => '已启用'
        ];
        return $status[$value];
    }


    //

}