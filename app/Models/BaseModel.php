<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Eloquent
{
	const CREATED_AT = 'crt_date';
	const UPDATED_AT = 'upd_date';

	/**
	 * Auto change created_by, updated_by value when insert, update, delete
	 * @return type
	 */
	public static function boot() {
        parent::boot();
        $user_id = (@Auth::user()->id) ? Auth::user()->id : '0';
        static::creating(function($table) use($user_id) {
        	$table->crt_usr_id = $user_id;
            $table->upd_usr_id = $user_id;
        });
        static::updating(function($table) use($user_id) {
            $table->upd_usr_id = $user_id;
        });
        static::deleting(function($table) use($user_id) {
            $table->upd_usr_id = $user_id;
        });
	}

	/**
	 * Get the table name by a static call. 
	 * Eg: M310KinoseiCategoryCn::getTableName()
	 * @return type
	 */
	public static function getTableName() {
        return with(new static)->getTable();
    }

	/**
	 * Must MANUALLY call this function $model->after_fill_insert after: $model->fill($req->all()) in insert function in Controller
	 * @param type $request 
	 * @param type $page_id 
	 * @return type
	 */
	public function after_fill_insert($request, $page_id) {
		$this->attributes['del_flg'] = ($request->del_flg) ? config('constant.flg.yes') : config('constant.flg.no');
        $this->attributes['crt_pg_id'] = $page_id;
        $this->attributes['upd_pg_id'] = $page_id;
	}

	/**
	 * Must MANUALLY call this function $model->after_fill_update after: $model->fill($req->all()) in update function in Controller
	 * @param type $request 
	 * @param type $page_id 
	 * @return type
	 */
	public function after_fill_update($request, $page_id) {
		$this->attributes['del_flg'] = ($request->del_flg) ? config('constant.flg.yes') : config('constant.flg.no');
        $this->attributes['upd_pg_id'] = $page_id;
	}
}