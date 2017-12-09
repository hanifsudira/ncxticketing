@extends('dashboard.app')
@section('title', 'Homepage')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Create Ticket</h4>
                    <p>Keluhan bisa berupa order mandeg atau request selain order. Jika selain order kosongkan saja field order dan segmen.</p>
                </div>
                <div class="card-content">
                    <form action="{{ Route('user.storeTicket') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">No Order</label>
                                    <input type="text" class="form-control" name="no_order">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Segment</label>
                                    <input type="text" class="form-control" name="segmen">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Konten</label>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Jelaskan dengan detail masalah</label>
                                        <textarea class="form-control" rows="5" required name="konten"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="form-group">
                                  <label for="sel1">Assign To</label>
                                  <select class="form-control" id="sel1" name="assignee" required>
                                    @foreach($user as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                    @endforeach
                                  </select>
                                </div> 
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ Route('user.home') }}">
                            <button class="btn btn-info pull-right" >Cancel</button>
                        </a>
  
                        <div class="clearfix"></div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection