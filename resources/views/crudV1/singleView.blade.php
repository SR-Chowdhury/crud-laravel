@extends('crudV1.dashboard')

@section('content')

    <div class="col-lg-6 offset-lg-3">
        <h1>Name: {{ $singleData->name }}</h1>
        <div>
            <img src="{{ URL::to($singleData->image) }}" alt="Image" style="height: 340px">
        </div>
        <div class="col-6">
            <h5>Email: {{ $singleData->email }}</h3>
        </div>
        <div class="col-6">
            <h5>Phone: {{ $singleData->phone }}</h3>
        </div>
    </div>

@endsection
