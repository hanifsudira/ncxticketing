<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User,App\Jenis;

class AdminController extends Controller
{
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
        return view('admin.home');
        //$data = auth()->user()->role;
        //var_dump($data);
    }

    public function kelolauser(){
        $data = User::all();
        return view('admin.kelolauser',['user'=>$data]);
    }

    public function kelolajenis(){
        $data = Jenis::all();
        return view('admin.kelolajenis',['jenis'=>$data]);
    }

}
