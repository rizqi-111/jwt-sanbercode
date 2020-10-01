<?php

namespace App\Http\Controllers;
use App\User;
use App\Loan;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function register(Request $request){
        $request->validate([
            'username' => ['required','min:3','max:25'],
            'password' => ['required','min:4','max:25'],
            'role' => ['required'],
       ]);

       $user = User::create([
           'username' => $request->input('username'),
           'password' => bcrypt($request->input('password') ),
           'role' => $request->input('role'),
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

        return "Berhasil Logout";
    }

    public function index(Request $request){
        $admin = User::where('id',$request->user()->id)->get();
        
        return $admin[0]->username;
    }

    public function return(Request $request){
        $loan = Loan::find($request->input('loan_id'));
        $loan->tanggal_kembali = $request->input('tanggal_kembali');
        $loan->ontime = $request->input('ontime');
        $loan->save();

        return "Berhasil Update Pengembalian Buku";
    }
}
