<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Artigo;
use App\User;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //contagem dos artigos/ users / autor
        $totalUsuarios=User::count();
        $totalArtigos=Artigo::count();
        $totalAutores=User::where('autor','=','S')->count();
        $totalAdm=User::where('adm','=','S')->count();

        return view('admin',compact('totalUsuarios','totalArtigos','totalAutores','totalAdm'));
    }
}
