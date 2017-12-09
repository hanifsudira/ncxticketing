@extends('dashboard.app')
@section('title', 'Homepage')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">My Tickets</h4>
                </div>
                <div class="card-content table-responsive">
                    <table class="table" id="datatable">
                        <thead class="text-primary">
                            <th>No Order</th>
                            <th>Segment</th>
                            <th>Detail Order</th>
                            <th>Assign To</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table =  $('#datatable').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.getMyTicket') }}',
                columns: [
                    { data: 'no_order',name: 'no_order'},
                    { data: 'segmen',name: 'segmen'},
                    { data: 'konten',name: 'konten'},
                    { data: 'assignee',name: 'assignee'},
                    { data: 'status',name: 'status'}
                ]
            });
        });
    </script>
@endsection