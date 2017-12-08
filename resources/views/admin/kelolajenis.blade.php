@extends('dashboard.app')
@section('title', 'Kelola User')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">List Jenis Masalah NCX</h4>
                </div>
                <div class="card-content table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($jenis as $d)
                             <tr>
                                <td>{{$d->id}}</td>
                                <td>{{$d->nama}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection