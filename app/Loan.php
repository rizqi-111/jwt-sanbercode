<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'tanggal_pinjam','tanggal_pinjam_akhir', 'tanggal_kembali', 'ontime', 'student_id', 'book_id'
    ];

    public function book(){
        return $this->belongsTo('App\Book');
    }

    public function student(){
        return $this->belongsTo('App\Student','student_id');
    }
}
