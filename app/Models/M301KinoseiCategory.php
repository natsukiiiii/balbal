<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 16:10:31 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M301KinoseiCategory
 * 
 * @property string $kinosei_category_cd
 * @property string $kinosei_category
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
class M301KinoseiCategory extends BaseModel
{
	protected $table = 'm301_kinosei_category';
	protected $primaryKey = 'kinosei_category_cd';
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
		'kinosei_category',
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

	/**
	 * Many to Many: M301KinoseiCategory with M300Kinosei by M310KinoseiCategoryCn
	 * @return type
	 */
	public function kinosei() {
		return $this->belongsToMany(M300Kinosei::class, M310KinoseiCategoryCn::getTableName(), 'kinosei_cd', 'kinosei_category_cd')
			->where(M310KinoseiCategoryCn::getTableName().'.del_flg', config('constant.flg.no'))
			->withTimestamps();
	}
}
