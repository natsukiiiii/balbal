<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 24 Jun 2019 13:49:44 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M503MokutekiCateCh
 * 
 * @property string $bench_cd
 * @property string $mokuteki_cate_cd
 * @property string $mokuteki_cate2_cd
 * @property string $mokuteki_cate3_cd
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
class M503MokutekiCateCh extends BaseModel
{
	protected $table = 'm503_mokuteki_cate_ch';
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
