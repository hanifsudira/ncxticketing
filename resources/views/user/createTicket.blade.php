@extends('template.app')
@section('title', 'Create Ticket')
@section('content')
<section class="content-header">
    <h1>Create Ticket</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Ticket</h3>
                    <br>
                    <span>Keluhan bisa berupa order mandeg atau request selain order. Jika selain order kosongkan saja field order dan segmen.</span>
                    <form role="form" action="{{ Route('user.storeTicket') }}" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group label-floating">
                            <label class="control-label">No Order</label>
                            <input type="text" class="form-control" name="no_order">
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Segment</label>
                            <input type="text" class="form-control" name="segmen">
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Jelaskan dengan detail masalah</label>
                            <textarea class="form-control" rows="5" required name="konten"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="sel1">Assign To</label>
                            <select class="form-control select2" id="sel1" name="assignee" required>
                            @foreach($user as $d)
                                <option value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="exampleInputFile">Input Gambar</label>
                            <input type="file" name='image' id="exampleInputFile">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ Route('user.home') }}"><button class="btn btn-info pull-right" >Cancel</button></a>
                        <div class="clearfix"></div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection