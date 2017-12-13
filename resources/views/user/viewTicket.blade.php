@extends('template.app')
@section('title', 'View Ticket')
@section('content')
<section class="content">
    @foreach($ticket as $data)
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="box box-widget">
                @if($data->is_root == 'Y')
                    <div class="alert alert-success box-header with-border">
                @else
                    <div class="alert alert-info box-header with-border">
                @endif
                    <div class="user-block">
                        <span><a href="#">Author : {{$data->namauser}}</a></span>
                        <br>
                        <span>No Order : {{$data->no_order}}</span>
                        <br>
                        <span>Detai Error : {{$data->derror}}</span>
                        <br>
                        <span>Perbaikan Di : {{$data->jenis}}</span>
                        <br>
                        <span>Root Author : {{$root_author}} | {{Auth::user()->id}}</span>
                        <br>
                        <span>Status : {{$data->status}}</span>
                    </div>
                    <div class="box-tools">
                        <span class="description">{{$data->tanggal}}</span>
                    </div>
                </div>
                 <div class="box-body">
                <p>{{$data->konten}}</p>

                <!-- Attachment -->
                <div class="attachment-block clearfix">
                    <img class="attachment-img" src="../dist/img/photo1.png" alt="Attachment Image">
                    <div class="attachment-pushed">
                        <h4 class="attachment-heading"><a href="http://www.lipsum.com/">Lorem ipsum text generator</a></h4>
                    </div>
                </div>
                @if($data->assignee == Auth::user()->id)
                    @if($data->status == 'Pending')
                        <button type="button" class="btn btn-default btn-xs"><i></i>Kerjakan</button>
                    @elseif($data->status == 'In Progress')
                        <button type="button" class="btn btn-default btn-xs"><i></i>Eskalasi</button>
                        <button type="button" class="btn btn-default btn-xs"><i></i>Kembalikan ke User</button>
                        <button type="button" class="btn btn-default btn-xs"><i></i>Request Complete</button>
                    @endif
                @endif
                @if($root_author == Auth::user()->id)
                    @if(($data->status == 'Pending Complete') or ($data->status == 'Return to User'))
                        <button type="button" class="btn btn-default btn-xs"><i></i>Close</button>
                    @endif
                @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection
<!-- <div class="container-fluid">
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
</div> -->
