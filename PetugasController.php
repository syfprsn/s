<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index(){
        //cek apakah user yang login adalah petugas
        $user = Auth::user();
        if($user->level!=='petugas'){
            //redirect jika bukan petugas
            return redirect('/user')->with('error','Access Denied');
        }

        return view('petugas.index');
    }
}
