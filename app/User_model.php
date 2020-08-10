<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class User_model extends Model
{
    protected $table = 'tb_user';
    public $timestamps = true;

    static function cek_user($where=array())
    {
        $cek = self::where($where)->get()->count();
        return $cek;
    }
    static function add_user($params = array())
    {
        DB::beginTransaction();

        try {
            $insert = self::insert($params);

            DB::commit();
            return TRUE;
        } catch (\Exception $e) {

            DB::rollback();
            return FALSE;
        }
    }

    static function getAll()
    {
        return self::get();
    }

    static function edit($where= array())
    {
        return self::where($where)->first();
    }

    static function updated($params = array(), $where = array())
    {
        return self::where($where)->update($params);
    }

    static function deleted($where = array())
    {
        return self::where($where)->delete();
    }
}
