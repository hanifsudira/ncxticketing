<?php

namespace App\Http\Controllers;
use App\Ticket;

use Illuminate\Http\Request;

class UserController extends Controller
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
        return view('user.home');
        //$data = auth()->user()->role;
        //var_dump($data);
    }


    // fungsi membuat tiket baru
    public function storeTicket(Request $req){
        $now = new DateTime();

        // assigning
        $temp_ticket = new Ticket();

        
        $temp_ticket->konten = $req->konten;
        $temp_ticket->assignee = $req->assignee;
        $temp_ticket->id_jenis = $req->id_jenis;
        $temp_ticket->no_order = $req->no_order;
        $temp_ticket->segmen = $req->segmen;
        $temp_ticket->author = $req->author;
        
        $temp_ticket->tanggal = $now->getTimestamp();
        $temp_ticket->status = "Pending";
        $temp_ticket->url_gambar = null;
        $temp_ticket->is_root = "Y";
        $temp_ticket->id_root = null;
        $temp_ticket->tanggal_complete = null;
        $temp_ticket->prev_ticket = null;
        $temp_ticket->detail_order = null;

        // save to db
        return $temp_ticket->save() ? TRUE : FALSE;
    }

    // fungsi transfer tiket: eskalasi, request complete, return to user
    public function transferTicket(){
        $now = new DateTime();
    //     
    }
}
