<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 29 May 2019 17:33:23 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M200Company
 * 
 * @property string $kigyo_cd
 * @property string $kigyo_nm
 * @property string $address
 * @property string $tel
 * @property string $fax
 * @property string $kigyo_hp
 * @property string $tantosha
 * @property string $biko
 * @property \Carbon\Carbon $keiyaku_date
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
class M200Company extends BaseModel
{
	protected $table = 'm200_company';
	protected $primaryKey = 'kigyo_cd';
	public $incrementing = true;
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
		'kigyo_nm',
		'address',
		'tel',
		'fax',
		'kigyo_hp',
		'tantosha',
		'biko',
		'keiyaku_date',
		'del_flg',
		'crt_usr_id',
		'crt_pg_id',
		'crt_date',
		'upd_usr_id',
		'upd_pg_id',
		'upd_date',
	];

	/**
	 * Preset the default values before being filled by request data
	 */
	public $default_values = [
	];
}
