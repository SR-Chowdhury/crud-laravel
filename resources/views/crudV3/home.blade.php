@extends('crudV3.dashboard')

@section('content')

<a href="{{ URL::to('crud-v3/create')}}" class="btn btn-outline-success mb-3">Create Employee</a>

<table class="table table-responsive-lg">
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

        @foreach ($employee as $data)
            <tr>
                <td> {{ $data->id }} </td>
                <td> {{ $data->user_name }} </td>
                @if($data->image)
                    <td>
                        <img src="{{ URL::to( $data->image ) }}" alt="Image" style="height: 50px; 80px;" />
                    </td>
                @else
                    <td class="text-warning">No Image</td>
                @endif

                <td> {{ $data->phone }} </td>
                <td>
                    <a href=" {{ URL::to('crud-v3/'.$data->id)}} " class="btn btn-outline-info btn-sm">View</a>
                    <a href=" {{ URL::to('crud-v3/'.$data->id.'/edit')}} " class="btn btn-outline-warning btn-sm">Edit</a>
                    <form action="{{ URL::to('crud-v3/'.$data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" >Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </tbody>
    {{-- If you want to see up --}}
    {{-- {{ $Bio->links() }}  --}}

</table>

{{-- <span class="float-right">{{ $student->links() }}</span> --}}


@endsection
