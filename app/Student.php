<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'id','nama', 'nim', 'fakultas', 'jurusan', 'no_hp', 'no_wa'
    ];

    public function loans(){
        return $this->hasMany('App\Loan');
    }
}
