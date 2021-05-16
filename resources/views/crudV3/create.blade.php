@extends('crudV3.dashboard')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <form action="{{ URL::to('crud-v3') }}" class="row g-3" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="user_name" placeholder="Enter your name...">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone">
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="col-md-3">
            <label for="passion" class="form-label">Passion</label>
            <select class="form-select" name="category_id">
                <option selected disabled>Choose...</option>
                @foreach ($categories as $categories)
                    <option value="{{ $categories->id }}"> {{ $categories->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-outline-success mt-3">Insert Data</button>
            <a href="{{ URL::to('crud-v3') }}" class="btn btn-outline-info mt-3">All Employee List</a>
        </div>
    </form>
</div>

@endsection
