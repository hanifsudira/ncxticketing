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
                <div class="attachment-block clearfix">
                    <img class="attachment-img" src="{{ URL::asset('storage/'.$data->author.'_'.$data->original_filename) }}" alt="Attachment Image">
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