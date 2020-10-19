<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 16:10:31 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M401GenryoSokyu
 * 
 * @property string $genryo_id
 * @property string $sokyu_cate_cd
 * @property string $sokyu_cate2_cd
 * @property string $sokyu_cate3_cd
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
class M401GenryoSokyu extends BaseModel
{
	protected $table = 'm401_genryo_sokyu';
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
		'genryo_id', 'sokyu_cate_cd', 'sokyu_cate2_cd', 'sokyu_cate3_cd',
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

	/**
	 * Preset the default values before being filled by request data
	 */
	public $default_values = [
	];

	/**
	 * One to Many: many M401GenryoSokyu belongs to M400Genryo
	 * @return type
	 */	
	public function genryo() {
		return $this->belongsTo(M400Genryo::class, 'genryo_id')
			->where(M401GenryoSokyu::getTableName().'.del_flg', config('constant.flg.no'));
	}

	/**
	 * One to Many: many M401GenryoSokyu belongs to M411SokyuCategory1
	 * @return type
	 */	
	public function sokyu_cate() {
		return $this->belongsTo(M411SokyuCategory1::class, 'sokyu_cate_cd')
			->where(M411SokyuCategory1::getTableName().'.del_flg', config('constant.flg.no'));
	}

	/**
	 * One to Many: many M401GenryoSokyu belongs to M412SokyuCategory2
	 * @return type
	 */	
	public function sokyu_cate2() {
		return $this->belongsTo(M412SokyuCategory2::class, 'sokyu_cate2_cd')
			->where(M412SokyuCategory2::getTableName().'.del_flg', config('constant.flg.no'));
	}

	/**
	 * One to Many: many M401GenryoSokyu belongs to M413SokyuCategory2
	 * @return type
	 */	
	public function sokyu_cate3() {
		return $this->belongsTo(M413SokyuCategory3::class, 'sokyu_cate3_cd')
			->where(M413SokyuCategory3::getTableName().'.del_flg', config('constant.flg.no'));
	}
}
