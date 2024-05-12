@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Products') }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a> </li>
                <li><a href="{{route('dashboard.products.index')}}">{{ __('Products') }}</a></li>
                <li class="active">{{ __('Add') }}</li>
            </ol>
        </section>

        <section class="content">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ __('Add') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include('partials._errors')
                <form action="{{route('dashboard.products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{@method_field('post')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">{{__('Product Name')}}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{__('Product Name')}}" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="description">{{__('Product Descriptions')}}</label>
                            <textarea type="text" class="form-control ckeditor " name="description" placeholder="{{__('Product Descriptions')}}" rows="10" cols="30" >{{old('description')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>{{__('Categories')}}</label>
                            <select class="form-control select2" name="category_id" style="width: 100%;">
                                <option value="" selected disabled>{{__('Please choose one category')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <input type="file" class="form-control image" id="image" name="image" placeholder="{{__('Image')}}">
                        </div>

                        <div class="form-group">
                            <img src="{{asset('uploads/product_images/default.jpg')}}" alt="not found" style="width: 100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label for="purchasing_price">{{__('Purchasing Price')}}</label>
                            <input type="number" step="0.01" class="form-control" name="purchasing_price" placeholder="{{__('Purchasing Price')}}" value="{{old('purchasing_price')}}">
                        </div>

                        <div class="form-group">
                            <label for="selling_price">{{__('Selling Price')}}</label>
                            <input type="number" step="0.01" class="form-control" name="selling_price" placeholder="{{__('Selling Price')}}" value="{{old('selling_price')}}">
                        </div>

                        <div class="form-group">
                            <label for="stock">{{__('Stock')}}</label>
                            <input type="number" class="form-control" name="stock" placeholder="{{__('Stock')}}" value="{{old('stock')}}">
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">{{__('Add')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
