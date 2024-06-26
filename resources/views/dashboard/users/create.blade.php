@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Users') }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a> </li>
                <li><a href="{{route('dashboard.users.index')}}">{{ __('Users') }}</a></li>
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
                <form action="{{route('dashboard.users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{@method_field('post')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('First Name')}}</label>
                            <input type="text" class="form-control" name="first_name" placeholder="{{__('First Name')}}" value="{{old('first_name')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Last Name')}}</label>
                            <input type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" value="{{old('last_name')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Image')}}</label>
                            <input type="file" class="form-control image" id="image" name="image" placeholder="{{__('Image')}}">
                        </div>

                        <div class="form-group">
                            <img src="{{asset('uploads/user_images/default.png')}}" alt="not found" style="width: 100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Email Address')}}</label>
                            <input type="email" class="form-control" name="email" placeholder="{{__('Email Address')}}" value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__('Password')}}</label>
                            <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                        </div>


                        <div class="form-group">
                            <label>{{__('Permissions')}}</label>
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        @php
                                            $models = ['users', 'categories', 'products', 'clients'];
                                            $maps = ['create', 'read', 'update', 'delete'];
                                            $icons = [
                                                'users' => 'fa-users',
                                                'products' => 'fa-shopping-basket',
                                                'categories' => 'fa-list',
                                                'clients' => 'fa-handshake-o',
                                            ];
                                        @endphp
                                        @foreach($models as $index => $model)
                                            <li class="nav-item {{$index === 0 ? 'active' : ''}}">
                                                <a class="nav-link" id="{{$model}}-tab" data-toggle="pill" href="#{{$model}}" role="tab">
                                                    <i class="fa {{ $icons[$model] }} mr-2"></i>
                                                    @php
                                                        $model = ucfirst($model);
                                                    @endphp
                                                    {{ ucfirst(__($model)) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        @foreach($models as $index => $model)
                                            <div class="tab-pane  {{$index === 0 ? "active" : " "}}" id="{{$model}}">
                                                @foreach($maps as $map)
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" name="permissions[]" type="checkbox" value="{{$model . '_' . $map}}">
                                                        @php
                                                          $map = ucfirst($map);
                                                        @endphp
                                                        <label  class="custom-control-label">{{__($map)}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
