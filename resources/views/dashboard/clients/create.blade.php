@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Clients') }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a> </li>
                <li><a href="{{route('dashboard.clients.index')}}">{{ __('Clients') }}</a></li>
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
                <form action="{{route('dashboard.clients.store')}}" method="POST">
                    @csrf
                    {{@method_field('post')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}">
                        </div>

                        @for($i = 0 ; $i < 2; $i++)
                            <div class="form-group">
                                <label>{{__('Phone') .' '. $i+1}}</label>
                                <input type="text" class="form-control" name="phone[]" placeholder="{{__('Phone')}}">
                            </div>
                        @endfor

                       {{-- <div class="form-group">
                            <label>{{__('Phone 2')}}</label>
                            <input type="text" class="form-control" name="phone[]" placeholder="{{__('Phone')}}">
                        </div>--}}

                        <div class="form-group">
                            <label>{{__('Address')}}</label>
                            <textarea type="text" class="form-control" name="address"></textarea>
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
