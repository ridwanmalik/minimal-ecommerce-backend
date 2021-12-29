@extends('admin.layouts.default', [
'pageName1' => 'Create Menu Link',
'pageName2' => '',
'pageDesc' => ' Create Menu Link',
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
                <h4 class="panel-title">Create Menu Link</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            {{-- @livewire('admin.products.create', ['type' => $type]) --}}
            <div class="panel-body">
                <form action="{{ route('menu-links.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3"> Menu Type</label>
                        <div class="col-md-9">
                            <select class="form-control" name="menu_type" required id="menu_type">
                                <option value="" selected>Select Menu Type</option>
                                <option value="Main Menu" {{ old('menu_type')=='Main Menu' ? 'selected' : '' }}>Main
                                    Menu
                                </option>
                                <option value="Footer Menu" {{ old('menu_type')=='Footer Menu' ? 'selected' : '' }}>
                                    Footer Menu
                                </option>
                            </select>
                            @error('menu_type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email">Menu Name</label>
                        <div class="col-md-9">
                            <div id="menu_name_show">
                                <input type="text" class="form-control m-b-5" id="menu_name" name="menu_name" placeholder="Menu Name" value="{{ old('menu_name') ? old('menu_name') : '' }}" />
                            </div>
                            @error('menu_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-form-label col-md-3" for="email">Menu Link</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control m-b-5" id="menu_link" name="menu_link" placeholder="Enter Menu Link" value="{{ old('menu_link') ? old('menu_link') : '' }}" required />
                            @error('menu_link')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button class="btn btn-primary">Submit</button>
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
