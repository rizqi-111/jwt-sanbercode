<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Loan;
use App\Book;
use JWTAuth;

class StudentController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

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
            'password' => bcrypt($request->input('password') ),
            'role' => $request->input('role'),
        ]);

        $student = Student::create([
            'id' => $user->id,
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'fakultas' => $request->input('fakultas'),
            'jurusan' => $request->input('jurusan'),
            'no_hp' => $request->input('no_hp'),
            'no_wa' => $request->input('no_wa'),
        ]); 

        return response('Berhasil Daftar');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username','password','role');

        try {
            if (! $token = auth()->attempt(($credentials))) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function logout(Request $request){
        auth()->logout();
    }

    public function index(Request $request){
        $student = Student::where('id',$request->user()->id)->get();
        
        return $student[0]->nama;
    }

    public function loan(Request $request){
        $student_id = $request->user()->id;
        $student = Student::find($student_id);

        $book_id = $request->input('book_id');
        $book = Book::find($book_id);

        $loan = new Loan;
        $loan->tanggal_pinjam = $request->input('tanggal_pinjam');
        $loan->tanggal_pinjam_akhir = $request->input('tanggal_pinjam_akhir');
        $loan->student()->associate($student);
        $loan->book()->associate($book);
        $loan->save();
    }
}
