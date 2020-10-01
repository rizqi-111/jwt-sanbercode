<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;

class StudentController extends Controller
{
    //
    public function register(Request $request){
        $request->validate([
             'username' => ['required','min:3','max:25'],
             'password' => ['required','min:4','max:25'],
             'role' => ['required'],
             'nama' => ['required','min:1','max:100'],
             'nim' => ['required','max:12','unique:students,nim'],
             'fakultas' => ['required','max:100'],
             'jurusan' => ['required','max:100'],
             'no_hp' => ['required','max:15'],
             'no_wa' => ['required','max:15'],
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);

        $student = Student::create([
            'users_id' => $user->id,
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'fakultas' => $request->input('fakultas'),
            'jurusan' => $request->input('jurusan'),
            'no_hp' => $request->input('no_hp'),
            'no_wa' => $request->input('no_wa'),
        ]); 

        return response('Berhasil Daftar');
    }
}
