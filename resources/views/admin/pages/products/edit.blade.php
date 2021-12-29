@extends('admin.layouts.default', [
'pageName1' => 'Edit Product',
'pageName2' => '',
'pageDesc' => ' Edit Product',
])

@section('content')
<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Edit Product</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            {{-- @livewire('admin.products.edit', ['product' => $product, 'type' => ]) --}}
            <div class="panel-body">
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email">Product Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control m-b-5" id="name" name="name" placeholder="Product Name" value="{{ old('name') ? old('name') : $product->name }}" required />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email">Price</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control m-b-5" id="price" name="price" placeholder="Enter price" value="{{ old('price') ? old('price') : $product->price }}" required />
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email">Quantity</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control m-b-5" id="qty" name="qty" placeholder="Enter Quantity" value="{{ old('qty') ? old('qty') : $product->qty }}" required />
                            @error('qty')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email">Description</label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control m-b-5" id="description" name="description" placeholder="Enter product description">{{ old('description') ? old('description') : $product->description }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email"> Product Image </label>
                        <div class="col-md-6">
                            <input type="file" class="form-control m-b-5" id="banner" name="image" onchange="previewFile(this);" />
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if ($product->product_image_url)
                        <div class="col-md-3">
                            <img src="{{ $product->product_image_url }}" class="img-fluid" alt="" id="previewImg">
                        </div>
                        @else
                        <div class="col-md-3">
                            <img src="http://via.placeholder.com/640x360" class="img-fluid" alt="" id="previewImg">
                        </div>
                        @endif
                    </div>
                    <div class="row m-b-15">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end panel-body -->
            <!-- begin hljs-wrapper -->
            <!-- end hljs-wrapper -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
</div>
@endsection

@section('init-js')
FormWysihtml5.init();
@endsection

@section('page-js')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
</script>
@endsection
