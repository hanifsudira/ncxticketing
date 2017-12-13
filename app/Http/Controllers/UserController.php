<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ticket,App\User;
use Auth,DB;
use Yajra\Datatables\Datatables;
use Collection;
use Storage;
use File;

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
        $user = User::where('role','=','2')->orderBy('name', 'asc')->get();
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
        $temp_ticket->detail_error = null;
        $temp_ticket->id_jenis = null;

        //upload image
        $file = $req->image;
        if($file){
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->put((string)(Auth::user()->id).'_'.(string)$now->getTimestamp().'_'.$file->getClientOriginalName(),  File::get($file));
            $temp_ticket->mime = $file->getClientMimeType();
            $temp_ticket->original_filename = (string)$now->getTimestamp().'_'.$file->getClientOriginalName();
            $temp_ticket->filename = $file->getFilename().'.'.$extension;
        }
        
        // save to db
        #return $temp_ticket->save() ? TRUE : FALSE;
        if($temp_ticket->save()){
            $temp_ticket->id_root = $temp_ticket->id;
            if($temp_ticket->save()){
                return redirect('user/myTicket');    
            }
        } 
    }

    // fungsi transfer tiket: eskalasi, request complete, return to user
    public function transferTicket(Request $req){
        $now = new \DateTime();
        $temp_ticket = new Ticket();

        $temp_root_author = getAuthor($req->id_ticket); //*

        // penentuan assignee
        if($req->next_action == "Moban"){
            $temp_ticket->assignee = $req->next_assignee;
        }else{
            $temp_ticket->assignee = $temp_root_author;
        }

        // persiapan simpan tiket
        $temp_ticket->konten = $req->next_konten;
        $temp_ticket->no_order = null;
        $temp_ticket->segmen = null;
        $temp_ticket->author = Auth::user()->id;
        
        $temp_ticket->tanggal = $now->format('Y-m-d H:i:s'); 
        $temp_ticket->action = $req->next_action;
        $temp_ticket->status = "Pending";
        $temp_ticket->url_gambar = null;
        $temp_ticket->is_root = "N";
        $temp_ticket->id_root = $req->id_root;
        $temp_ticket->tanggal_complete = null;
        $temp_ticket->prev_ticket = $req->id_ticket;
        $temp_ticket->detail_order = $req->next_detail_order;
        $temp_ticket->id_jenis = $req->next_id_jenis;

        // action ke tiket sebelumnya
        if($temp_ticket->save()){
            if($req->is_intervensi){
                updateStatusTicket($req->id_ticket, "Cancelled", null);
            }else{
                updateStatusTicket($req->id_ticket, "Escalated", null);
            }
        }
    }

    // update status ticket
    public function updateStatusTicket($id_ticket, $vals, $comp_date){
        $temp_ticket = DB::statement("update tiket set status = '".$vals."', tanggal_complete = '".$comp_date."' where id = '".$id_ticket."'");
        return $temp_ticket;
    }

    // mendapatkan id author dari sebuah tiket manapun
    public function getAuthor($id_ticket){

        $temp_ticket = DB::select("select * from tiket where id = '".$id_ticket."'");

        if($temp_ticket[0]->is_root == "Y"){
            $temp_root = $temp_ticket;
        }else{
            $temp_root = DB::select("select * from tiket where id = '".$temp_ticket[0]->id_root."'");    
        }

        return $temp_root[0]->author;
    }

    // cek satu dua tiga

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

    // fungsi menutup tiket
    public function closeTicket(Request $req){
        $now = new \DateTime();

        if($req->action == "Pending Complete"){
            updateStatusTicket($req->id_ticket, "Complete", null);
            updateStatusTicket($req->id_root, "Complete", $now->format('Y-m-d H:i:s'));
        }else if($req->action == "Return to User"){
            updateStatusTicket($req->id_ticket, "Complete", null);
            updateStatusTicket($req->id_root, "Returned", $now->format('Y-m-d H:i:s'));
        }
    }

    public function myTicket(){
        return view('user.myTicket');
    }

    public function getMyTicket(){
        $temp_dict = DB::select("select t1.id_root, t2.name, t1.status from tiket t1 left join users t2 on t2.id = t1.assignee where (status <> 'Complete') and is_root = 'N'");
        $dict = array();
        foreach ($temp_dict as $value) {
                $dict[$value->id_root] = [$value->name,$value->status];
        }
        $userid = Auth::user()->id;
        $temp_ticket = DB::select("select t1.* , t2.name from tiket t1 left join users t2 on t2.id = t1.assignee where author = '".$userid."' and is_root = 'Y'");
        
        $data = array();
        foreach ($temp_ticket as $value) {
            $temp = array();
            $temp['id']       = $value->id;
            $temp['no_order'] = $value->no_order;
            $temp['segmen']   = $value->segmen;
            $temp['konten']   = $value->konten;
            $temp['assignee'] = array_key_exists($value->id, $dict) ? $dict[$value->id][0] :  $value->name;
            $temp['status']   = array_key_exists($value->id, $dict) ? $dict[$value->id][1] :  $value->status;
            $temp['id_root']  = $value->id_root;
            array_push($data, $temp);
        }
        return Datatables::of($data)
            ->addColumn('action', function ($tiket) {
                return '<a href="'.route('user.viewTicket',$tiket['id']."+".$tiket['id_root']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>View</a>';
            })
            ->make(true);
    }

    public function viewTicket($param){
        $temp = explode("+", $param);
        $id = $temp[0];
        $id_root = $temp[1];

        $root_author = $this->getAuthor($id);

        $ticket = DB::select("select t1.*, t2.name as namauser, t3.nama as jenis, t4.name as derror from tiket t1 left join users t2 on t2.id = t1.assignee left join jenis t3 on t3.id = t1.id_jenis left join detail_error t4 on t4.id = t1.detail_error where id_root = '".$id_root."' order by tanggal asc");
        return view('user.viewTicket',['ticket' => $ticket, 'root_author' => $root_author]);
    }
}
