<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'phone', 'status',
    ];
    protected $with = ['data'];

    protected $casts = [
        "status" => "boolean",
    ];


    public static function boot()
    {
        parent::boot();
        static::saved(function($obj) {
            Cache::forget('get_all_users');
            Cache::forget('get_user_' . $obj->id);
        });
        static::deleting(function($obj) {
            Cache::forget('get_all_users');
            Cache::forget('get_user_' . $obj->id);
            Cache::forget('get_users_count');
        });
        static::created(function($obj) {
            Cache::forget('get_all_users');
            Cache::forget('get_user_' . $obj->id);
            Cache::forget('get_users_count');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function data()
    {
        return $this->hasOne('App\UsersData', 'user_id');
    }


   
    public function createUser($data)
    {
        $user = $this->create(
            [
                'phone'    =>  $data['phone'],
                'email'    =>  $data['email'],
            ]
        );

        $user->data()->create([
            'name' => $data['name'],
            'surname' => $data['surname']
        ]);

        return $user;
    }


}
