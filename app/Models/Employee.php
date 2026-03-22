<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable =[
        'first_name',
        'last_name',
        'email',
        'salary',
        'hire_date',
        'department_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
