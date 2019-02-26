<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = 'towns';

    protected $filliable = ['name', 'translit_name'];


    public static function boot()
    {
        parent::boot();
        static::saved(function() {
            Cache::forget('get_all_towns');
        });
        static::deleting(function() {
            Cache::forget('get_all_towns');
        });
        static::created(function() {
            Cache::forget('get_all_towns');
        });
    }

    public function data()
    {
        return $this->hasOne('App\UsersData', 'town_id');
    }
}
