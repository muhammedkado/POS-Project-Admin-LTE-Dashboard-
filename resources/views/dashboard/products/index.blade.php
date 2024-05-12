@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Products') }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a>
                </li>
                <li class="active"> {{ __('Products') }}</li>
            </ol>
        </section>

        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-bottom: 15px">{{__('Products')}}</h3>
                        <form action="{{route('dashboard.products.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="{{__('Search')}}">
                                </div>
                                <div class="form-group col-md-3">
                                    {{--<label>{{__('Categories')}}</label>--}}
                                    <select class="form-control select2" name="category_id" style="width: 100%;">
                                        <option value="" selected>{{__('All Category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ request()->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary"><li class="fa fa-search mr-2"></li>{{__('Search')}}</button>
                                    @if(auth()->user()->hasPermission('products_create'))
                                        <a href="{{route('dashboard.products.create')}}" class="btn btn-primary "><li class="fa fa-plus mr-2"> </li>{{__('Add')}}</a>
                                    @else
                                        <a href="#" class="btn btn-primary disabled"><li class="fa fa-plus mr-2"> </li>{{__('Add')}}</a>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Purchasing Price')}}</th>
                                <th>{{__('Selling Price')}}</th>
                                <th>{{__('Profit Percent')}} %</th>
                                <th>{{__('Stock')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            @if($products->count() > 0)
                            <tbody>
                            @foreach($products as $index => $product)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td><img src="{{$product->image_path}}" alt="not found" style="max-width: 100px; max-height: 100px" class="img-thumbnail"></td>
                                    <td>{{$product->purchasing_price}}</td>
                                    <td>{{$product->selling_price}}</td>
                                    <td>{{$product->profit_percent}} %</td>
                                    <td>{{$product->stock}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('products_update'))
                                            <a href="{{ route('dashboard.products.edit', ['product' => $product->id]) }}" class="btn btn-info btn-sm"><li class="fa fa-edit mr-2"> </li>{{ __('Edit') }}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><li class="fa fa-edit mr-2"> </li>{{ __('Edit') }}</a>
                                       @endif

                                        @if(auth()->user()->hasPermission('products_delete'))
                                            <form action="{{ route('dashboard.products.destroy', ['product' => $product->id]) }}" method="post" style="display: inline-block">
                                                @csrf
                                                {{method_field('delete')}}
                                                <button type="submit" class="btn btn-danger btn-sm delete"><li class="fa fa-trash mr-2"> </li>{{__('Delete')}}</button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-danger btn-sm disabled"><li class="fa fa-trash mr-2"> </li>{{__('Delete')}}</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">{{__('No Data Found')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{$products->appends(request()->query())->links()}}
                    </div>
                </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
