<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\common\model;

use app\common\model\Base;
use think\Db;

class ThreadColumnMember extends Base {

    public function model_where() {


        if (request()->get('keyword'))
            $this->where('m.nickname', 'like', '%' . request()->get('keyword') . '%');

        $this->join('member m', 'm.id = a.member_id');

        $this->alias('a');

        $this->order('a.id asc');

        $this->field('a.*,m.nickname');

        return $this;
    }

//    public function model_single() {
//        if (request()->param('id'))
//            $this->db('thread_column_member')->where('column_id', '=', request()->param('id'));
//        $this->join('member m', 'm.id = a.member_id');
//        $this->alias('a');
//        $this->order('a.id asc');
//        $this->field('a.*,m.nickname');
//        return $this;
//    }

}
