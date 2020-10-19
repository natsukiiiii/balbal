<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 21 Jun 2019 10:41:46 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M500Benchmark
 * 
 * @property string $bench_cd
 * @property string $keisai_date
 * @property string $top_pic
 * @property string $hanbai_nm
 * @property string $item_nm
 * @property string $shokuhin_kb
 * @property string $zaikei
 * @property string $meyasu
 * @property string $kn
 * @property string $sale_kn
 * @property string $day_kn
 * @property string $shuseibun
 * @property string $genzairyo_nm
 * @property string $yukoseibun
 * @property string $juryo
 * @property string $naiyoryo
 * @property string $shurui
 * @property string $site
 * @property string $tokucho
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
class M500Benchmark extends BaseModel
{
	protected $table = 'm500_benchmark';
	protected $primaryKey = 'bench_cd';
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
		'keisai_date',
		'top_pic',
		'hanbai_nm',
		'item_nm',
		'shokuhin_kb',
		'zaikei',
		'meyasu',
		'kn',
		'sale_kn',
		'day_kn',
		'shuseibun',
		'genzairyo_nm',
		'yukoseibun',
		'juryo',
		'naiyoryo',
		'shurui',
		'site',
		'tokucho',
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
		'mokuteki_categories1' => [],
		'benchmark_genryo' => [],
		'zaikei' => [],
		// supplier
		'url_sup' => [],
		'genzairyo_sup' => [],
	];

	/**
	 * Many to Many: M500Benchmark with M504MokutekiCategory1 by M503MokutekiCateCh
	 * @return type
	 */
	public function mokuteki_categories1() {
		return $this->belongsToMany(M504MokutekiCategory1::class, M503MokutekiCateCh::getTableName(), 'bench_cd', 'mokuteki_cate_cd')
			->where(M503MokutekiCateCh::getTableName().'.del_flg', config('constant.flg.no'))
			->withTimestamps();
	}

	/**
	 * Many to Many: M500Benchmark with M470Seibun by M501BenchmarkGenryo
	 * @return type
	 */
	public function benchmark_genryo() {
		return $this->belongsToMany(M470Seibun::class, M501BenchmarkGenryo::getTableName(), 'bench_cd', 'seibun')
			->where(M501BenchmarkGenryo::getTableName().'.del_flg', config('constant.flg.no'))
			->withTimestamps();
	}

	/**
	 * One to Many: M500Benchmark has many M502BenchmarkSupplier
	 * @return type
	 */	
	public function benchmark_suppliers() {
		return $this->hasMany(M502BenchmarkSupplier::class, 'bench_cd')
			->where(M502BenchmarkSupplier::getTableName().'.del_flg', config('constant.flg.no'));
	}

	/**
	 * Convert zaikei from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getZaikeiAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['zaikei'];
    }

    /**
     * Convert zaikei from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setZaikeiAttribute($value) {
    	$this->attributes['zaikei'] = implode(',', $value);
    }
}
