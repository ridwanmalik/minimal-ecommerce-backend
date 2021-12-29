@extends('admin.layouts.default', [
'pageName1' => 'All Products',
'pageName2' => '',
'pageDesc' => ' Products',
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
        <h4 class="panel-title">All Products</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <a href="{{ route('products.create') }}">
            <button class="btn btn-primary float-right">Create Product</button>
            <div class="clearfix mb-2"></div>
        </a>
        <table id="data-table-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Description </th>
                    <th class="text-nowrap">Price</th>
                    <th class="text-nowrap">Qty </th>
                    <th class="text-nowrap">Image </th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="gradeU">
                    <td width="1%" class="f-s-600 text-inverse">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{!! $product->description !!}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>
                        @if ($product->image)
                        <img src="{{ $product->image }}" alt="" style="width: 100px; height:100px; object-fit:cover; object-position: center;">
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary"><i class="far fa-edit"></i>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteClass{{ $product->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteClass{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deleting product
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
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
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
@endsection
