<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    //
    protected $fillable = [
        'judul', 'pengarang', 'tahun_terbit', 
    ];
}
