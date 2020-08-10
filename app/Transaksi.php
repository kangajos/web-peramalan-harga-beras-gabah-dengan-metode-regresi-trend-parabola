<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    public $timestamps = false;

    static function getAll()
    {
        $transaksi = self::where('created_by', Session::get('email'))->orderBy('tanggal', 'DESC')->get();
        return $transaksi;
    }

    static function add_transaksi($params = array())
    {
        DB::beginTransaction();

        try{
            $insert = self::insert($params);

            DB::commit();
            return TRUE;
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return FALSE;
        }
    }

    static function add_dataset($params = array())
    {
        DB::beginTransaction();

        try{
            $insert = DB::table('tb_dataset')->insert($params);

            DB::commit();
            return TRUE;
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return FALSE;
        }
    }

    static function edit_transaksi($where = array())
    {
        $edit = self::where($where)->first();
        return $edit;
    }

    static function update_transaksi($params=array(), $where=array())
    {
        $update = self::where($where)->update($params);
        return $update;
    }

    static function delete_transaksi($where = array())
    {
        $deleted = self::where($where)->delete();
        return $deleted;
    }

}
