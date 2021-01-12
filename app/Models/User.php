<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Musonza\Chat\Traits\Messageable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Messageable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function user_data(){
        return $this->hasOne('App\Models\UserData', 'user_id');
    }

    public function checkDataField($field){
        $field_data =  $this->hasOne('App\Models\UserData', 'user_id')
            ->select([$field])
            ->first()
            ->toArray();
        return $field_data[$field];
    }


    /* Sort Section Start */
    public function namekanjiSortable($query, $direction)
    {
        return $query->orderBy('name_kanji', $direction);
    }
    public function namekanaSortable($query, $direction)
    {
        return $query->orderBy('name_kana', $direction);
    }
    /* Sort Section Start */

}
