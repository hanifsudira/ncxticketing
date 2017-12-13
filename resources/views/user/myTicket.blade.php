@extends('template.app')
@section('title', 'My Ticket')
@section('content')
<section class="content-header">
    <h1>My Ticket</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead class="text-primary">
                            <th>No Order</th>
                            <th>Segment</th>
                            <th>Detail Order</th>
                            <th>Assign To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody> 
                            <tfoot>
                            </tfoot> 
                        </tbody>             
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
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
                    { data: 'status',name: 'status'},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection
