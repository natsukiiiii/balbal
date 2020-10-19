<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 24 Jun 2019 17:56:05 +0900.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class M440Sokyubui
 * 
 * @property string $sokyu_bui_cd
 * @property string $sokyu_bui_nm
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
class M440Sokyubui extends Eloquent
{
	protected $table = 'm440_sokyubui';
	protected $primaryKey = 'sokyu_bui_cd';
	public $incrementing = false;
	public $timestamps = true;

	protected $casts = [
		'crt_usr_id' => 'int',
		'upd_usr_id' => 'int'
	];

	protected $dates = [
		'crt_date',
		'upd_date'
	];

	protected $fillable = [
		'sokyu_bui_nm',
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
