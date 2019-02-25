<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = 'towns';

    protected $filliable = ['name', 'translit_name'];


    public function town()
    {
        return $this->hasOne('App\UsersData', 'town_id');
    }
}
