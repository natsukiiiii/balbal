<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 27 Jun 2019 10:04:00 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M403GenryoLink
 * 
 * @property int $seq
 * @property string $genryo_id
 * @property string $url
 * @property string $link_mei
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
class M403GenryoLink extends BaseModel
{
	protected $table = 'm403_genryo_link';
	protected $primaryKey = 'seq';
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
		'genryo_id',
		'url',
		'link_mei',
		'del_flg',
		'crt_usr_id',
		'crt_pg_id',
		'crt_date',
		'upd_usr_id',
		'upd_pg_id',
		'upd_date'
	];
}
