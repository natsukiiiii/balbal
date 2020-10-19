<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 16:10:31 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M413SokyuCategory3
 * 
 * @property string $sokyu_cate3_cd
 * @property string $sokyu_cate3_nm
 * @property string $sokyu_cate_cd
 * @property string $sokyu_cate2_cd
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
class M413SokyuCategory3 extends BaseModel
{
	protected $table = 'm413_sokyu_category_3';
	protected $primaryKey = 'sokyu_cate3_cd';
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
		'sokyu_cate3_nm',
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
