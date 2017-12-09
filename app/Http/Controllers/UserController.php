<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ticket,App\User;
use Auth,DB;
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

    public function createTicket(){
        $user = User::all();
        return view('user.createTicket', ['user' => $user]);
    }

    // fungsi membuat tiket baru
    public function storeTicket(Request $req){
        $now = new \DateTime();

        // assigning
        $temp_ticket = new Ticket();

        
        $temp_ticket->konten = $req->konten;
        $temp_ticket->assignee = $req->assignee;
        $temp_ticket->no_order = $req->no_order;
        $temp_ticket->segmen = $req->segmen;
        $temp_ticket->author = Auth::user()->id;
        
        $temp_ticket->tanggal = $now->format('Y-m-d H:i:s'); 
        $temp_ticket->action = "Moban";
        $temp_ticket->status = "Pending";
        $temp_ticket->url_gambar = null;
        $temp_ticket->is_root = "Y";
        $temp_ticket->id_root = null;
        $temp_ticket->tanggal_complete = null;
        $temp_ticket->prev_ticket = null;
        $temp_ticket->detail_order = null;
        $temp_ticket->id_jenis = null;

        // save to db
        #return $temp_ticket->save() ? TRUE : FALSE;
        if($temp_ticket->save()){
            return redirect('user/myTicket');
        } 
    }

    // fungsi transfer tiket: eskalasi, request complete, return to user
    public function transferTicket(Request $req){
        $now = new DateTime();

        $temp_action = $req->action;
        $temp_action = $req->action;
    }

    // mendapatkan id author dari sebuah tiket manapun
    public function getAuthor($id_ticket){

    }

    // mendapatkan status pengerjaan sebuah tiket root
    public function getRootStatus($id_ticket){
        $temp_ticket = DB::select("select * from tiket where (id = '".$id_ticket."' or id_root='".$id_ticket."') and (status='Pending' or status='In Progress')");
        return $temp_ticket[0]->status;
    }

    // mendapatkan assignee pengerjaan sebuah tiket root
    public function getRootAssignee($id_ticket){
        $temp_ticket = DB::select("select * from tiket where (id = '".$id_ticket."' or id_root='".$id_ticket."') and (status='Pending' or status='In Progress')");
        return $temp_ticket[0]->assignee;
    }

    public function myTicket(){
        $data = DB::select('select * from users');
        var_dump($data[0]->id);
    }
}
