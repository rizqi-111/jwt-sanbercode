<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
             'judul' => ['required','max:255'],
             'pengarang' => ['required','max:255'],
             'tahun_terbit' => ['required','date']
        ]);

        $book = Book::create([
            'judul' => $request->input('judul'),
            'pengarang' => $request->input('pengarang'),
            'tahun_terbit' => $request->input('tahun_terbit'),
        ]);

        return response('Berhasil Daftar');
    }
}
