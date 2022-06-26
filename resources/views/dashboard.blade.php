@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <dashboard-index inline-template>
        <div>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <numbers-by-status></numbers-by-status>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <customers-by-status></customers-by-status>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $total_numbers }}</h3>
                            <p>Registered Numbers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('site.numbers.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6" id="teste4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_customers }}</h3>
                            <p>Registered Customers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('site.customers.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            @can('is-admin')
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Hey!</h5>
                    Only admins can see this alert ;).
                </div>
            @endcan
            <span id="teste2">
                <teste></teste>
            </span>

            <v-tour name="myTour" :steps="steps"></v-tour>
        </div>
    </dashboard-index>
@stop
