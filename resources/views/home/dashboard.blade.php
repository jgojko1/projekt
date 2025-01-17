@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card border-primary mb-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Services</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Number of services:
                        <a href="{{ route('services.index') }}">
                            <strong>{{ $statistics['number_of_services'] }}</strong>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary mb-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Users</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Number of users: <strong>{{ $statistics['number_of_users'] }}</strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Devices</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Number of devices: <strong>{{ $statistics['number_of_devices'] }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection