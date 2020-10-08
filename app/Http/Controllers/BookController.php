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

        return $book;
    }

    public function getAll(){
        $book = Book::all();

        return $book->toArray();
    }

    public function show($id){
        $book = Book::where('id',$id)->get()->first();

        return $book->toArray();
    }

    public function update(Request $request,$id){
        $book = Book::find($id);
        
        $request->validate([
            'judul' => ['required','max:255'],
            'pengarang' => ['required','max:255'],
            'tahun_terbit' => ['required','date']
        ]);

        $book->judul = $request->judul;
        $book->pengarang = $request->pengarang;
        $book->tahun_terbit = $request->tahun_terbit;

        $result = $book->save();

        if($result){
            return $book;
        }
        return 0;
    }

    public function destroy($id){
        $book = Book::find($id);

        $result = $book->delete();

        if($result){
            return 1;
        }
        return 0;
    }
}