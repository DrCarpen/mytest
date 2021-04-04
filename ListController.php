<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB; //引用DB
use App\Models\Admin\Member; //引入Member模型

class ListController extends Controller
{
    //增加
    public function memberAdd(){
        $arr = [
            'name' => '胡涛',
            'password' => '666666',
            'gender' => 1
        ];

        $id = DB::table('t_member')->insertGetId($arr);
        dump($id);
    }

    //修改
    public function memberUpdate(){
        //递增递减
        //$row = DB::table('t_member')->where("id","=",3)->increment("age"); //递增 +1
        //$row = DB::table('t_member')->where("id","=",3)->decrement("age","3"); //递减 -3
        //dump($row);

        $arr = [
            'name' => '李亚鹏'
        ];

        //where(字段,运算符,字段值)
        $row = DB::table('t_member')->where("id","=",3)->update($arr);
        dump($row);
    }

    //查询
    public function memberGet(){
        //$data = DB::table('t_member')->get();
        //$data = DB::table('t_member')->where("id","!=",3)->get();
        //dump($data);

        /*
        foreach ($data as $key => $value) {
            dump($value);

            echo "id=".$value->id."<br>";
            echo "name=".$value->name."<br>";
        }
        */

        //获取Sql语句
        //select * from `t_member`
        //$data = DB::table('t_member')->toSql();

        //id>1
        //$data = DB::table('t_member')->where("id",">",1)->get();

        //id>1 and id<3
        //select * from `t_member` where `id` > 1 and `id` < 3
        //$data = DB::table('t_member')->where("id",">",1)->where("id","<",3)->get();

        //id>1 or id=3
        //select * from `t_member` where `id` > 1 or `id` = 3
        //$data = DB::table('t_member')->where("id",">",1)->orWhere("id","=",3)->get();

        //获取单条记录 first返回单个对象 get返回集合
        //first使用场景:登录验证、详情页面... , get使用场景:列表页... 
        //$data = DB::table('t_member')->where("id","=",1)->first();

        //获取单个字段值
        //$data = DB::table('t_member')->where("id","=",1)->value('name');

        //select() 获取指定字段
        //$data = DB::table('t_member')->where("id","=",1)->select('id','name as user_name')->get();
        //$data = DB::table('t_member')->where("id","=",1)->select(DB::raw('id,name as user_name'))->get();

        //使用内置函数需使用 selectRaw()
        //$data = DB::table('t_member')->select(DB::raw('count(*) as total'))->first();
        //$data = DB::table('t_member')->selectRaw('count(*) as total')->first();

        //orderBy limit
        //$data = DB::table('t_member')->orderBy('id','desc')->limit(3)->get();

        //dump($data);
    }

    //删除
    public function memberDel(){

        $row = DB::table('t_member')->where("id","=",3)->delete();
        dump($row);
    }

    //原生sql语句
    public function memberSql(){

        //$bool = DB::insert("INSERT INTO `t_member` (`name`,`password`,`gender`) VALUES('胡涛','666666',1)");
        //dump($bool);

        //$row = DB::update("UPDATE `t_member` SET name='李亚鹏' WHERE id = 6");
        //dump($row);
        
        //$data = DB::select("SELECT * FROM `t_member` WHERE `id` > 1 AND `id` < 10");
        //dump($data);

        //$row = DB::delete("DELETE FROM `t_member` WHERE `id` = 6");
        //dump($row);
    }


    //列表
    public function memberList(){
        $arr = [
            'name' => '胡涛',
            'password' => '666666',
            'gender' => 1
        ];

        $now = date("Y-m-d H:i:s");

        //列表
        $list = DB::table('t_member')->get();
        
        //compact 创建一个包含变量名和它们的值的数组
        $data = compact('arr','now','list');
        //dump($data);

        //路径 laravel\resources\views\admin\member\list.blade.php
        return view("admin/member/list",$data);
    }

    //登录
    public function memberLogin(){
        dump($_POST);
    }

    //增加(AR模式)
    public function memberModelAdd(){
        /*
        $arr = [
            'name' => '胡涛',
            'password' => '666666',
            'gender' => 1
        ];

        //$id = DB::table('t_member')->insertGetId($arr);
        $id = Member::insertGetId($arr);
        dump($id);
        */

        $member = new Member(); //将表映射到模型

        //将字段映射到属性
        $member -> name = '胡涛';
        $member -> password = '666666';
        $member -> gender = 1;

        //将记录映射到实例
        $bool = $member->save(); //返回布尔值
        dump($bool);

        $insertId = $member->id; //获取insertId
        dump($insertId);
    }

    //增加(AR模式) 批量赋值
    public function memberModelCreate(Request $request){
        $data = Member::create($request -> all());
        
        if($data){
            return true;
        }else{
            return false;
        }
    }

    //查询(AR模式)
    public function memberModelGet(){
        /*
        $data = Member::find(1);
        dump($data);

        //打印属性
        dump($data->id);
        dump($data->name);
        */

        //转换为数组
        //$data = Member::find(1)->toArray();

        /*
        //循环
        $data = Member::get();
        foreach ($data as $key => $value) {

            echo "id=".$value->id."<br>";
            echo "name=".$value->name."<br>";
        }
        */

        //获取Sql语句
        //select * from `t_member`
        //$data = Member::toSql();

        //id>1
        //$data = Member::where("id",">",1)->get();

        //id>1 and id<3
        //select * from `t_member` where `id` > 1 and `id` < 3
        //$data = Member::where("id",">",1)->where("id","<",3)->get();
        //dump($data[0]->name);

        //id>1 or id=3
        //select * from `t_member` where `id` > 1 or `id` = 3
        //$data = Member::where("id",">",1)->orWhere("id","=",3)->get();
        
        //获取单条记录 first返回单个对象 get返回集合
        //first使用场景:登录验证、详情页面... , get使用场景:列表页... 
        //$data = Member::where("id","=",1)->first();

        //获取单个字段值
        //$data = Member::where("id","=",1)->value('name');

        //select() 获取指定字段
        //$data = Member::where("id","=",1)->select('id','name as user_name')->get();
        //$data = Member::where("id","=",1)->select(DB::raw('id,name as user_name'))->get();

        //使用内置函数需使用 selectRaw()
        //$data = Member::select(DB::raw('count(*) as total'))->first();
        //$data = Member::selectRaw('count(*) as total')->first();

        //orderBy limit
        //$data = Member::orderBy('id','desc')->limit(3)->get();

        //dump($data);
    }

    //修改(AR模式)
    public function memberModelUpdate(){
        /*
        //先查询再修改
        $user = Member::find(50);
        if($user){
            $user-> name = '胡涛';
            $user-> gender = 1;

            $bool = $user->save();
            dump($bool); //数据更新成功返回true 数据未更新也返回true 
        }
        */

        $arr = [
            'name' => '李亚鹏'
        ];

        //where(字段,运算符,字段值)
        $row = Member::where("id","=",50)->update($arr);
        dump($row); //数据更新成功返回1 数据未更新返回0
    }

    //删除(AR模式)
    public function memberModelDel(){
        /*
        //先查询再修改
        $user = Member::find(1);
        if($user){
            $bool = $user->delete();
            dump($bool);
        }
        */

        //$row = Member::where("id","=",1)->delete();
        $row = Member::whereIn("id",['1','2'])->delete();
        dump($row);
    }

}

