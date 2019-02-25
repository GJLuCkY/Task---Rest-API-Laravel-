<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersData extends Model
{
    protected $table = 'users_data';
    protected $fillable = ['user_id', 'name', 'surname', 'gender', 'town_id'];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function town()
    {
        return $this->belongsTo('App\Town', 'town_id');
    }
}
