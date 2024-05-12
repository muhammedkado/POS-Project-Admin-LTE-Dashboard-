@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Categories') }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a>
                </li>
                <li class="active"> {{ __('Categories') }}</li>
            </ol>
        </section>

        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-bottom: 15px">{{__('Categories')}}</h3>
                        <form action="{{route('dashboard.categories.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="{{__('Search')}}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><li class="fa fa-search mr-2"></li>{{__('Search')}}</button>
                                    @if(auth()->user()->hasPermission('categories_create'))
                                        <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary "><li class="fa fa-plus mr-2"> </li>{{__('Add')}}</a>
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
                                <th>{{__('Product Count')}}</th>
                                <th>{{__('Product Related')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            @if($categories->count() > 0)
                            <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{ $category->products->count() ?? 0 }}</td>
                                    <td><a href="{{route('dashboard.products.index', ['category_id' => $category->id])}}" class="btn btn-info btn-sm">{{__('Related Product')}}</a></td>
                                    <td>
                                        @if(auth()->user()->hasPermission('categories_update'))
                                            <a href="{{ route('dashboard.categories.edit', ['category' => $category->id]) }}" class="btn btn-info btn-sm"><li class="fa fa-edit mr-2"> </li>{{ __('Edit') }}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><li class="fa fa-edit mr-2"> </li>{{ __('Edit') }}</a>
                                       @endif

                                        @if(auth()->user()->hasPermission('categories_delete'))
                                            <form action="{{ route('dashboard.categories.destroy', ['category' => $category->id]) }}" method="post" style="display: inline-block">
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
                                    <td colspan="3" class="text-center">{{__('No Data Found')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
