@extends('crudV1.dashboard')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">SL</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($Bio as $data)
            <tr>
                <td> {{ $data->id }} </td>
                <td> {{ $data->name }} </td>
                @if($data->image)
                    <td>
                        <img src="{{ URL::to( $data->image ) }}" alt="Image" style="height: 50px; 80px;" />
                    </td>
                @else
                    <td class="text-warning">No Image</td>
                @endif

                <td> {{ $data->phone }} </td>
                <td>
                    <a href=" {{ URL::to('/crud-v1/single/'.$data->id)}} " class="btn btn-outline-info btn-sm">View</a>
                    <a href="#" class="btn btn-outline-warning btn-sm">Edit</a>
                    <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

@endsection
