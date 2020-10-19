<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 25 Jun 2019 15:33:10 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M502BenchmarkSupplier
 * 
 * @property int $seq
 * @property string $bench_cd
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
class M502BenchmarkSupplier extends BaseModel
{
	protected $table = 'm502_benchmark_supplier';
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
		'bench_cd',
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
}
