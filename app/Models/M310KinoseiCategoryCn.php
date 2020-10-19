<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 13 Jun 2019 14:31:12 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M310KinoseiCategoryCn
 * 
 * @property string $kinosei_cd
 * @property string $kinosei_category_cd
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
class M310KinoseiCategoryCn extends BaseModel
{
	protected $table = 'm310_kinosei_category_cn';
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
		'del_flg',
		'crt_usr_id',
		'crt_pg_id',
		'crt_date',
		'upd_usr_id',
		'upd_pg_id',
		'upd_date'
	];

	/**
	 * Preset the default values before being filled by request data
	 */
	public $default_values = [
	];
}
