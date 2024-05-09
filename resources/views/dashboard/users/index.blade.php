@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Users') }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a>
                </li>
                <li class="active"> {{ __('Users') }}</li>
            </ol>
        </section>

        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-bottom: 15px">{{__('Users')}}</h3>
                        <form action="{{route('dashboard.users.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="{{__('Search')}}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><li class="fa fa-search mr-2"></li>{{__('Search')}}</button>
                                    @if(auth()->user()->hasPermission('users_create'))
                                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary "><li class="fa fa-plus mr-2"> </li>{{__('Add')}}</a>
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
                                <th>{{__('First Name')}}</th>
                                <th>{{__('Last Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            @if($users->count() > 0)
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('users_update'))
                                            <a href="{{ route('dashboard.users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-sm"><li class="fa fa-edit mr-2"> </li>{{ __('Edit') }}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><li class="fa fa-edit mr-2"> </li>{{ __('Edit') }}</a>
                                        @endif

                                        @if(auth()->user()->hasPermission('users_delete'))
                                            <form action="{{ route('dashboard.users.destroy', ['user' => $user->id]) }}" method="post" style="display: inline-block">
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
                                    <td colspan="5" class="text-center">{{__('No Data Found')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
