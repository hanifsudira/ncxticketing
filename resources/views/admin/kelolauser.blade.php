@extends('dashboard.app')
@section('title', 'Kelola User')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">List User NCX Ticketing</h4>
                </div>
                <div class="card-content table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($user as $d)
                             <tr>
                                <td>{{$d->username}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->email}}</td>
                                <td class="text-primary">{{$d->role}}</td>
                                <td>{{$d->created_at}}</td>
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