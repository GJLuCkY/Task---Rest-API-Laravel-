<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersData extends Model
{
    protected $table = 'users_data';
    protected $fillable = ['user_id', 'name', 'surname', 'gender', 'town_id'];
}
