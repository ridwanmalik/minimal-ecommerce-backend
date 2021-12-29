@extends('admin.layouts.default', [
'pageName1' => 'All Orders',
'pageName2' => '',
'pageDesc' => ' Orders',
])

@section('page-css')
<link href="{{ asset('website/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('website/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i>
            </a>
        </div>
        <h4 class="panel-title">All Orders</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <table id="data-table-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="1%"></th>
                    <th class="text-nowrap">User</th>
                    <th class="text-nowrap">Products</th>
                    <th class="text-nowrap">Unique Id</th>
                    <th class="text-nowrap">Total Price</th>
                    <th class="text-nowrap">Status</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr class="gradeU">
                    <td width="1%" class="f-s-600 text-inverse">{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <ul class="list-group">
                            @foreach ($order->products as $product)
                            <li class="list-group-item">
                                {{$product->name}} -
                                {{$product->details->price}} *
                                {{$product->details->qty}} =
                                {{$product->details->qty * $product->details->price}}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->unique_id }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                        <select class="form-control" name="status" id="order{{ $order->id }}" onchange="changeStatus('order{{ $order->id }}')" {{ $order->status == 'delivered' ? 'disabled' : '' }}>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option value="reject" {{ $order->status == 'reject' ? 'selected' : '' }}>
                                Reject
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                Shipped
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                Delivered</option>
                        </select>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteClass{{ $order->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteClass{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deleting order
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to delete?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end panel-body -->
</div>
@endsection

@section('init-js')
TableManageButtons.init();
@endsection

@section('page-js')
<script src="{{ asset('website/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}">
</script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}">
</script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('website/assets/js/demo/table-manage-buttons.demo.min.js') }}"></script>

<script type='text/javascript'>
    function changeStatus(id) {
            var parameter = id;
            var status = $("#" + parameter).val();
            var id = id.slice(5);
            if (confirm("Do you want to change the status?")) {
                if (status == 'delivered') {
                    $("#" + parameter).attr("disabled", "disabled");
                }
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "changeOrderStatus",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {}
                });
            } else {
                var url = "{{ route('orders.index') }}" + "/" + id;
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url,
                    success: function(data) {
                        $('#' + parameter).val(data.status);
                    }
                });
                return false;
            }
        };
</script>

@endsection
