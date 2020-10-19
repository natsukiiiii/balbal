<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 05 Jun 2019 13:44:52 +0900.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class M400Genryo
 * 
 * @property string $genryo_id
 * @property string $top_pic
 * @property string $hitokoto
 * @property string $item_gaiyo_title
 * @property string $item_gaiyo
 * @property string $item_nm
 * @property string $ippan_nm
 * @property string $ippan_nm_kana
 * @property string $kigyo_cd
 * @property string $seibun_nm
 * @property string $sokyu_koka
 * @property string $shokuten
 * @property string $jokyo
 * @property string $sotei_hc
 * @property string $kanyo
 * @property string $kikaku
 * @property string $yoko_seibun_kana
 * @property string $genryo_ex
 * @property string $en_nm
 * @property string $naiyo
 * @property string $kyokyu
 * @property string $seizo_maker
 * @property string $shomi_kigen
 * @property string $warning
 * @property string $kubun
 * @property string $tenka_kijun
 * @property string $zaikei
 * @property string $chaina
 * @property string $kaigai
 * @property string $pet
 * @property string $tokkyo
 * @property string $shohyo_logo
 * @property string $logo_pic1
 * @property string $logo_pic2
 * @property string $seijo
 * @property string $suiyosei
 * @property string $yuyosei
 * @property string $allergie
 * @property string $gmo_info
 * @property string $genseiyaku_hi
 * @property string $sesshu
 * @property string $anzen_data
 * @property string $evidence
 * @property string $tokuho
 * @property string $sokyu_bui
 * @property string $yurai
 * @property string $siyo_bui
 * @property string $gensankoku
 * @property string $saishu_koku
 * @property string $link
 * @property string $link_nm
 * @property string $ninsho_nm
 * @property string $ninsho_logo
 * @property string $ninsho_logo_halal
 * @property string $path
 * @property string $path2
 * @property string $path3 
 * @property string $lf_url
 * @property string $lf_url_dl
 * @property string $lf_url_sample
 * @property string $up_contents
 * @property string $top_random
 * @property string $rec_genryo
 * @property string $video_iframe_src
 * @property string $video_title
 * @property string $video_note
 * @property string $video_duration
 * @property string $video_text_content
 * @property string $video_get_password_url
 * @property string $hyojijun
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
class M400Genryo extends BaseModel
{
	protected $table = 'm400_genryo';
	protected $primaryKey = 'genryo_id';
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
		'top_pic',
        'hitokoto',
        'item_gaiyo_title',
		'item_gaiyo',
		'item_nm',
		'ippan_nm',
		'ippan_nm_kana',
		'hanbai_shutai',
		'kigyo_cd',
		'seibun_nm',
		'sokyu_koka',
		'shokuten',
		'jokyo',
		'sotei_hc',
		'kanyo',
		'kikaku',
		'yoko_seibun_kana',
		'genryo_ex',
		'en_nm',
		'naiyo',
		'kyokyu',
		'seizo_maker',
		'shomi_kigen',
		'warning',
		'kubun',
		'tenka_kijun',
		'zaikei',
		'chaina',
		'kaigai',
		'pet',
		'tokkyo',
		'shohyo_logo',
        'logo_pic1',
        'logo_pic2',
		'seijo',
		'suiyosei',
		'yuyosei',
		'allergie',
		'gmo_info',
		'genseiyaku_hi',
		'sesshu',
		'anzen_data',
		'evidence',
		'tokuho',
		'sokyu_bui',
		'yurai',
		'siyo_bui',
		'gensankoku',
		'saishu_koku',
		'link',
		'link_nm',
		'ninsho_nm',
		'ninsho_logo',
		'ninsho_logo_halal',
        'path',
        'path2',
        'path3',
        'lf_url',
        'lf_url_dl',
        'lf_url_sample',
        'up_contents',
        'top_random',
        'rec_genryo',
        'video_iframe_src',
        'video_title',
        'video_note',
        'video_duration',
        'video_text_content',
        'video_get_password_url',
        'hyojijun',
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
        'hanbai_shutai' => [],
		'seibun_nm' => [],
		'shokuten' => [],
		'kyokyu' => [],
		'kubun' => [],
		'zaikei' => [],
		'chaina' => [],
		'kaigai' => [],
		'pet' => [],
		'shohyo_logo' => [],
		'seijo' => [],
		'suiyosei' => [],
		'yuyosei' => [],
		'allergie' => [],
		'gmo_info' => [],
		'anzen_data' => [],
		'evidence' => [],
		'tokuho' => [],
		'sokyu_bui' => [],
		'gensankoku' => [],
		'saishu_koku' => [],
		'ninsho_logo' => [],
		'ninsho_logo_halal' => [],
        'sokyu_koka1' => [],
        'sokyu_koka2' => [],
        'sokyu_koka3' => [],
        // link_mei
        'url' => [],
        'link_mei' => [],
	];

	/**
	 * Convert hanbai_shutai from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getHanbaiShutaiAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['hanbai_shutai'];
    }

    /**
     * Convert hanbai_shutai from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setHanbaiShutaiAttribute($value) {
    	$this->attributes['hanbai_shutai'] = implode(',', $value);
    }

	/**
	 * Convert seibun_nm from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getSeibunNmAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['seibun_nm'];
    }

    /**
     * Convert seibun_nm from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setSeibunNmAttribute($value) {
    	$this->attributes['seibun_nm'] = implode(',', $value);
    }

    /**
	 * Convert shokuten from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getShokutenAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['shokuten'];
    }

    /**
     * Convert shokuten from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setShokutenAttribute($value) {
    	$this->attributes['shokuten'] = implode(',', $value);
    }

	/**
	 * Convert kyokyu from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getKyokyuAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['kyokyu'];
    }

    /**
     * Convert kyokyu from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setKyokyuAttribute($value) {
    	$this->attributes['kyokyu'] = implode(',', $value);
    }

    /**
	 * Convert kubun from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getKubunAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['kubun'];
    }

    /**
     * Convert kubun from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setKubunAttribute($value) {
    	$this->attributes['kubun'] = implode(',', $value);
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

    /**
	 * Convert chaina from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getChainaAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['chaina'];
    }

    /**
     * Convert chaina from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setChainaAttribute($value) {
    	$this->attributes['chaina'] = implode(',', $value);
    }

    /**
	 * Convert kaigai from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getKaigaiAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['kaigai'];
    }

    /**
     * Convert kaigai from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setKaigaiAttribute($value) {
    	$this->attributes['kaigai'] = implode(',', $value);
    }

    /**
	 * Convert pet from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getPetAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['pet'];
    }

    /**
     * Convert pet from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setPetAttribute($value) {
    	$this->attributes['pet'] = implode(',', $value);
    }

    /**
	 * Convert shohyo_logo from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getShohyoLogoAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['shohyo_logo'];
    }

    /**
     * Convert shohyo_logo from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setShohyoLogoAttribute($value) {
    	$this->attributes['shohyo_logo'] = implode(',', $value);
    }

    /**
	 * Convert seijo from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getSeijoAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['seijo'];
    }

    /**
     * Convert seijo from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setSeijoAttribute($value) {
    	$this->attributes['seijo'] = implode(',', $value);
    }

    /**
	 * Convert suiyosei from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getSuiyoseiAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['suiyosei'];
    }

    /**
     * Convert suiyosei from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setSuiyoseiAttribute($value) {
    	$this->attributes['suiyosei'] = implode(',', $value);
    }

    /**
	 * Convert yuyosei from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getYuyoseiAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['yuyosei'];
    }

    /**
     * Convert yuyosei from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setYuyoseiAttribute($value) {
    	$this->attributes['yuyosei'] = implode(',', $value);
    }

	/**
	 * Convert allergie from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getAllergieAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['allergie'];
    }

    /**
     * Convert allergie from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setAllergieAttribute($value) {
    	$this->attributes['allergie'] = implode(',', $value);
    }

    /**
	 * Convert gmo_info from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getGmoInfoAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['gmo_info'];
    }

    /**
     * Convert gmo_info from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setGmoInfoAttribute($value) {
    	$this->attributes['gmo_info'] = implode(',', $value);
    }

    /**
	 * Convert anzen_data from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getAnzenDataAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['anzen_data'];
    }

    /**
     * Convert anzen_data from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setAnzenDataAttribute($value) {
    	$this->attributes['anzen_data'] = implode(',', $value);
    }

    /**
	 * Convert evidence from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getEvidenceAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['evidence'];
    }

    /**
     * Convert evidence from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setEvidenceAttribute($value) {
    	$this->attributes['evidence'] = implode(',', $value);
    }

    /**
	 * Convert tokuho from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getTokuhoAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['tokuho'];
    }

    /**
     * Convert tokuho from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setTokuhoAttribute($value) {
    	$this->attributes['tokuho'] = implode(',', $value);
    }

    /**
	 * Convert sokyu_bui from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getSokyuBuiAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['sokyu_bui'];
    }

    /**
     * Convert sokyu_bui from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setSokyuBuiAttribute($value) {
    	$this->attributes['sokyu_bui'] = implode(',', $value);
    }

    /**
	 * Convert gensankoku from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getGensankokuAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['gensankoku'];
    }

    /**
     * Convert gensankoku from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setGensankokuAttribute($value) {
    	$this->attributes['gensankoku'] = implode(',', $value);
    }

    /**
	 * Convert saishu_koku from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getSaishuKokuAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['saishu_koku'];
    }

    /**
     * Convert saishu_koku from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setSaishuKokuAttribute($value) {
    	$this->attributes['saishu_koku'] = implode(',', $value);
    }

    /**
	 * Convert ninsho_logo from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getNinshoLogoAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['ninsho_logo'];
    }

    /**
     * Convert ninsho_logo from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setNinshoLogoAttribute($value) {
    	$this->attributes['ninsho_logo'] = implode(',', $value);
    }

    /**
	 * Convert ninsho_logo_halal from text to array when getting
	 * @param type $value 
	 * @return type
	 */
	public function getNinshoLogoHalalAttribute($value) {
        return ($value) ? explode(',', $value) : $this->default_values['ninsho_logo_halal'];
    }

    /**
     * Convert ninsho_logo_halal from array to text when setting
     * @param type $value 
     * @return type
     */
    public function setNinshoLogoHalalAttribute($value) {
    	$this->attributes['ninsho_logo_halal'] = implode(',', $value);
    }

    /**
     * One to Many: M400Genryo has many M401GenryoSokyu
     * @return type
     */ 
    public function sokyu_categories() {
        return $this->hasMany(M401GenryoSokyu::class, 'genryo_id')
            ->where(M401GenryoSokyu::getTableName().'.del_flg', config('constant.flg.no'));
    }

    /**
     * One to Many: M400Genryo has many M403GenryoLink
     * @return type
     */ 
    public function genryo_links() {
        return $this->hasMany(M403GenryoLink::class, 'genryo_id')
            ->where(M403GenryoLink::getTableName().'.del_flg', config('constant.flg.no'));
    }

    public function company() {
        return $this->belongsTo(M200Company::class, 'kigyo_cd');
    }
}
