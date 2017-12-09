@extends('dashboard.app')
@section('title', 'View Ticket')
@section('content')
<div class="container-fluid">
    <div class="card-content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <h5>Notifications Style</h5>
                @foreach($ticket as $data)
                    @if($data->is_root == 'Y')
                        <div class="alert alert-success alert-with-icon" data-notify="container">

                    @else
                        <div class="alert alert-info alert-with-icon" data-notify="container">
                    @endif
                    <i data-notify="icon" class="material-icons">add_alert</i>
                    <h3>{{$data->no_order}}</h3><span class="pull-right">{{$data->tanggal}}</span>
                    <span>Author : {{$data->namauser}}</span>
                    <span>Detai Error : {{$data->derror}}</span>
                    <span>Perbaikan Di : {{$data->jenis}}</span>
                    <span>Root Author : {{$root_author}} | {{Auth::user()->id}}}</span>
                    <span>Status : {{$data->status}}</span>
                    <br>
                    <span data-notify="message">{{$data->konten}}</span>
                    <br>

                    @if($data->assignee == Auth::user()->id)
                        @if($data->status == 'Pending')
                            <button class="btn btn-danger">Kerjakan</button>
                        @elseif($data->status == 'In Progress')
                            <button class="btn btn-danger">Eskalasi</button>
                            <button class="btn btn-danger">Kembalikan ke User</button>
                            <button class="btn btn-danger">Request Complete</button>
                        @endif
                    @endif
                    @if($root_author == Auth::user()->id)
                        @if(($data->status == 'Pending Complete') or ($data->status == 'Return to User'))
                            <button class="btn btn-danger">Close!</button>
                        @endif
                    @endif

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection