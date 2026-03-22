<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'location',
        'status'
    ];

    //department ekat innw user godk
    public function employees(){
        return $this->hasMany(User::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
