<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 14 Jun 2019 14:53:13 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M303KinoseiSupplier
 * 
 * @property int $seq
 * @property string $kinosei_cd
 * @property string $url
 * @property string $genryo_mei
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
class M303KinoseiSupplier extends BaseModel
{
	protected $table = 'm303_kinosei_supplier';
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
		'kinosei_cd',
		'url',
		'genryo_mei',
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

	/**
	 * One to Many: many M303KinoseiSupplier belongs to M300Kinosei
	 * @return type
	 */	
	public function kinosei() {
		return $this->belongsTo(M300Kinosei::class, 'kinosei_cd')
			->where(M303KinoseiSupplier::getTableName().'.del_flg', config('constant.flg.no'));
	}
}
