<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        'nama', 'nim', 'fakultas', 'jurusan', 'no_hp', 'no_wa'
    ];
}