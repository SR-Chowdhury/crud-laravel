@extends('crudV2.dashboard')

@section('content')

    <div class="col-lg-6 offset-lg-3">

        <a href="{{ route('create-form-v2')}}" class="btn btn-outline-success">Insert User Info</a>
        <a href="{{ route('home-v2')}}" class="btn btn-outline-info">All Student List</a><hr>


        <h1>Name: {{ $singleData->user_name }}</h1>
        <div>
            @if ($singleData->image)
                <img src="{{ URL::to($singleData->image) }}" alt="Image" style="height: 340px">
            @else
                No Image
            @endif
        </div>
        <div class="col">
            <h5>Email: {{ $singleData->email }}</h3>
        </div>
        <div class="col">
            <h5>Phone: {{ $singleData->phone }}</h3>
        </div>
        <div class="col">
            <h5>Passion: {{ $singleData->name }}</h3>
        </div>
    </div>

@endsection
