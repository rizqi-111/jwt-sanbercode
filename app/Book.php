<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    //
    public $timestamps = false;
    
    protected $fillable = [
        'judul', 'pengarang', 'tahun_terbit', 
    ];

    public function loans(){
        return $this->hasMany('App\Loan');
    }
}
