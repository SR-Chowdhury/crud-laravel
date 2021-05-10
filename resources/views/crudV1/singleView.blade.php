@extends('crudV1.dashboard')

@section('content')

    <div class="col-lg-6 offset-lg-3">

        <a href="{{ route('create-form-v1')}}" class="btn btn-outline-success">Insert User Info</a>
        <a href="{{ route('dashboard-v1')}}" class="btn btn-outline-info">All User List</a><hr>


        <h1>Name: {{ $singleData->user_name }}</h1>
        <div>
            @if ($singleData->image)
                <img src="{{ URL::to($singleData->image) }}" alt="Image" style="height: 340px">
            @else
                No Image
            @endif
        </div>
        <div class="col-6">
            <h5>Email: {{ $singleData->email }}</h3>
        </div>
        <div class="col-6">
            <h5>Phone: {{ $singleData->phone }}</h3>
        </div>
    </div>

@endsection
