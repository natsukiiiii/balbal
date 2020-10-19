<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 16:10:31 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M005Code
 * 
 * @property string $code_id
 * @property string $code
 * @property string $code_nm
 * @property string $code_rnm
 * @property string $sort_no
 * @property string $moji_1
 * @property string $moji_2
 * @property string $moji_3
 * @property string $moji_4
 * @property string $moji_5
 * @property float $suchi_1
 * @property float $suchi_2
 * @property float $suchi_3
 * @property float $suchi_4
 * @property float $suchi_5
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
class M005Code extends BaseModel
{
	protected $table = 'm005_code';
	public $incrementing = false;
	public $timestamps = true;

	protected $casts = [
		'suchi_1' => 'float',
		'suchi_2' => 'float',
		'suchi_3' => 'float',
		'suchi_4' => 'float',
		'suchi_5' => 'float',
		'crt_usr_id' => 'int',
		'upd_usr_id' => 'int'
	];

	protected $dates = [
		'crt_date',
		'upd_date'
	];

	protected $fillable = [
		'code_nm',
		'code_rnm',
		'sort_no',
		'moji_1',
		'moji_2',
		'moji_3',
		'moji_4',
		'moji_5',
		'suchi_1',
		'suchi_2',
		'suchi_3',
		'suchi_4',
		'suchi_5',
		'biko',
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
