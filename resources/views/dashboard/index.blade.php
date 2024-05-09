@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('Dashboard') }}</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</li>
            </ol>
        </section>

        <section class="content">

            <h1>{{__('This is dashboard')}}</h1>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
