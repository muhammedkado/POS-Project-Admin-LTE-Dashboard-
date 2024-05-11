@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Products') }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a> </li>
                <li><a href="{{route('dashboard.products.index')}}">{{ __('Products') }}</a></li>
                <li class="active">{{ __('Update') }}</li>
            </ol>
        </section>

        <section class="content">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ __('Update') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include('partials._errors')
                <form action="{{route('dashboard.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{@method_field('put')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Product Name')}}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{__('Product Name')}}" value="{{$product->name}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Product Descriptions')}}</label>
                            <input type="text" class="form-control" name="description" placeholder="{{__('Product Descriptions')}}" value="{{$product->description}}">
                        </div>

                        <div class="form-group">
                            <label>{{__('Categories')}}</label>
                            <select class="form-control select2" name="category_id" style="width: 100%;">
                                @foreach($categories as $category)
                                    <option {{$product->category_id === $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <input type="file" class="form-control image" id="image" name="image" placeholder="{{__('Image')}}">
                        </div>

                        <div class="form-group">
                            <img src="{{$product->image_path}}" alt="not found" style="width: 100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Purchasing Price')}}</label>
                            <input type="number" step="0.01" class="form-control" name="purchasing_price" placeholder="{{__('Purchasing Price')}}" value="{{$product->purchasing_price}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Selling Price')}}</label>
                            <input type="number" step="0.01" class="form-control" name="selling_price" placeholder="{{__('Selling Price')}}" value="{{$product->selling_price}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Stock')}}</label>
                            <input type="number" class="form-control" name="stock" placeholder="{{__('Stock')}}" value="{{$product->stock}}">
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
