@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Categories') }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a> </li>
                <li><a href="{{route('dashboard.categories.index')}}">{{ __('Categories') }}</a></li>
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
                <form action="{{route('dashboard.categories.update', $category->id)}}" method="POST">
                    @csrf
                    {{@method_field('put')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Name')}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="{{__('Name')}}" value="{{$category->name}}">
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
