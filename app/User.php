<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'm010_user';
    protected $primaryKey = 'user_id';
    protected $rememberTokenName = false;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'password',
        'name',
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifier() {
        return $this->user_id;
    }
}
