<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 16:10:31 +0900.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class M423YotoCategory3
 * 
 * @property string $yoto_cate3_cd
 * @property string $yoto_cate3_nm
 * @property string $yoto_cate_cd
 * @property string $yoto_cate2_cd
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
class M423YotoCategory3 extends Eloquent
{
	protected $table = 'm423_yoto_category3';
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
		'yoto_cate3_nm',
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
