@extends('layouts.app')

@section('content')

<div class="container col-6">
    <div class="row">
        <div class="col-md-12 mb-5">
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Service name</label>
            <input type="text" class="form-control" id="service_name" name="service_name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="completed" selected>Completed</option>
                <option value="active">Active</option>
            </select>
        </div> 
        <div class="mb-3">
            <label for="start_date" class="form-label">Start date</label>
            <input type="date" class="form-control" id="start_date" name="start_date">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End date</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection