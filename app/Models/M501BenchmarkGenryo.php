<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 25 Jun 2019 11:45:17 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M501BenchmarkGenryo
 * 
 * @property int $seq
 * @property string $bench_cd
 * @property string $seibun
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
class M501BenchmarkGenryo extends BaseModel
{
	protected $table = 'm501_benchmark_genryo';
	protected $primaryKey = 'seq';
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
		'bench_cd',
		'seibun',
		'del_flg',
		'crt_usr_id',
		'crt_pg_id',
		'crt_date',
		'upd_usr_id',
		'upd_pg_id',
		'upd_date'
	];
}
