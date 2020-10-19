<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 24 Jun 2019 13:48:46 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M504MokutekiCategory1
 * 
 * @property string $mokuteki_cate_cd
 * @property string $mokuteki_cate_nm
 * @property string $order_by
 * @property string $biko
 * @property string $del_flg
 * @property int $crt_usr_id
 * @property string $crt_pg_id
 * @property \Carbon\Carbon $crt_date
 * @property int $upd_usr_id
 * @property string $upd_pg_id
 * @property \Carbon\Carbon $upd_date
 *
 * @package App\Models
 */
class M504MokutekiCategory1 extends BaseModel
{
	protected $table = 'm504_mokuteki_category_1';
	protected $primaryKey = 'mokuteki_cate_cd';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'crt_usr_id' => 'int',
		'upd_usr_id' => 'int'
	];

	protected $dates = [
		'crt_date',
		'upd_date'
	];

	protected $fillable = [
		'mokuteki_cate_nm',
		'order_by',
		'biko',
		'del_flg',
		'crt_usr_id',
		'crt_pg_id',
		'crt_date',
		'upd_usr_id',
		'upd_pg_id',
		'upd_date'
	];
}
