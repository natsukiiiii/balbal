<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 16:10:31 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M300Kinosei
 * 
 * @property string $kinosei_cd
 * @property string $todokede_no
 * @property string $todokede_date
 * @property string $todokede_nm
 * @property string $item_nm
 * @property string $shokuhin_kb
 * @property string $henko_date
 * @property string $tekkai_date
 * @property string $hyoji_kinosei
 * @property string $kanyo_seibun_nm
 * @property string $taisho
 * @property string $hyoka
 * @property string $info
 * @property string $hyoka_hoho
 * @property string $henko_rireki
 * @property string $tekkai_jiyu
 * @property string $shohi_info
 * @property string $meyasu
 * @property string $kanyo_seibun
 * @property string $genzairyo_nm
 * @property string $pict
 * @property string $hp
 * @property string $meisho
 * @property string $hanbai_yotei_date
 * @property string $kinosei_shokuhin
 * @property string $search_kanyo
 * @property string $up_contents
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
class M300Kinosei extends BaseModel
{
	protected $table = 'm300_kinosei';
	protected $primaryKey = 'kinosei_cd';
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
		'todokede_no',
		'todokede_date',
		'todokede_nm',
		'item_nm',
		'shokuhin_kb',
		'henko_date',
		'tekkai_date',
		'hyoji_kinosei',
		'kanyo_seibun_nm',
		'taisho',
		'hyoka',
		'info',
		'hyoka_hoho',
		'henko_rireki',
		'tekkai_jiyu',
		'shohi_info',
		'meyasu',
		'kanyo_seibun',
		'genzairyo_nm',
		'pict',
		'hp',
		'meisho',
		'hanbai_yotei_date',
		'kinosei_shokuhin',
		'search_kanyo',
		'up_contents',
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
		'kinosei_categories' => [],
		'kinosei_shokuhin' => [],
		'search_kanyo' => [],
		// supplier
		'url_sup' => [],
		'genzairyo_sup' => [],
	];

	/**
	 * Many to Many: M300Kinosei with M301KinoseiCategory by M310KinoseiCategoryCn
	 * @return type
	 */
	public function kinosei_categories() {
		return $this->belongsToMany(M301KinoseiCategory::class, M310KinoseiCategoryCn::getTableName(), 'kinosei_cd', 'kinosei_category_cd')
			->where(M310KinoseiCategoryCn::getTableName().'.del_flg', config('constant.flg.no'))
			->withTimestamps();
	}

	/**
	 * One to Many: M300Kinosei has many M303KinoseiSupplier
	 * @return type
	 */	
	public function kinosei_suppliers() {
		return $this->hasMany(M303KinoseiSupplier::class, 'kinosei_cd')
			->where(M303KinoseiSupplier::getTableName().'.del_flg', config('constant.flg.no'));
	}

	/**
	 * Convert kinosei_shokuhin from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getKinoseiShokuhinAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['kinosei_shokuhin'];
    }

    /**
     * Convert kinosei_shokuhin from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setKinoseiShokuhinAttribute($value) {
    	$this->attributes['kinosei_shokuhin'] = implode(',', $value);
    }

    /**
	 * Convert search_kanyo from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getSearchKanyoAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['search_kanyo'];
    }

    /**
     * Convert search_kanyo from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setSearchKanyoAttribute($value) {
    	$this->attributes['search_kanyo'] = implode(',', $value);
    }
}
