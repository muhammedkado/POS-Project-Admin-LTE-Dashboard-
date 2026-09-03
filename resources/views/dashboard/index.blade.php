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

            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $stats['products'] }}</h3>
                            <p>{{ __('Products') }}</p>
                        </div>
                        <div class="icon"><i class="fa fa-shopping-basket"></i></div>
                        <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">
                            {{ __('More info') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $stats['clients'] }}</h3>
                            <p>{{ __('Clients') }}</p>
                        </div>
                        <div class="icon"><i class="fa fa-handshake-o"></i></div>
                        <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">
                            {{ __('More info') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $stats['categories'] }}</h3>
                            <p>{{ __('Categories') }}</p>
                        </div>
                        <div class="icon"><i class="fa fa-list"></i></div>
                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">
                            {{ __('More info') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>${{ number_format($stats['inventory_value'], 0) }}</h3>
                            <p>{{ __('Inventory value') }}</p>
                        </div>
                        <div class="icon"><i class="fa fa-money"></i></div>
                        <span class="small-box-footer">&nbsp;</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Low stock') }} <small>(&lt; 5)</small></h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                @forelse($lowStock as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category?->name }}</td>
                                        <td><span class="label label-danger">{{ $product->stock }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td class="text-muted">{{ __('Nothing low on stock.') }}</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Latest products') }}</h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                @foreach($latestProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category?->name }}</td>
                                        <td>${{ number_format($product->selling_price, 2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Products per category') }}</h3>
                        </div>
                        <div class="box-body">
                            @foreach($productsPerCategory as $category)
                                <div style="margin-bottom:10px">
                                    <span>{{ $category->name }}</span>
                                    <div class="progress progress-sm" style="margin:4px 0">
                                        <div class="progress-bar progress-bar-aqua" style="width: {{ $stats['products'] ? round($category->products_count / $stats['products'] * 100) : 0 }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $category->products_count }} {{ __('products') }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
