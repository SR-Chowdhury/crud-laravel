@extends('crudV1.dashboard')

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
    <form action="{{ URL::to('crud-v1/update/'.$data->id) }}" class="row g-3" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="user_name" value="{{ $data->user_name }}">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $data->email }}">
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ $data->phone }}">
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" name="image">
            <Label>Old Image</Label>
            @if($data->image)
                <img class=" mt-3" src="{{URL::to($data->image)}}" alt="" style="height: 120px; width: 150px;">
            @else
                No Imaged Added
            @endif
            <input type="hidden" name="old_photo" value="{{$data->image}}">
        </div>
        <div class="col-md-3">
            <label for="passion" class="form-label">Passion</label>
            <select class="form-select" name="category_id">
                <option selected disabled>Choose...</option>
                @foreach ($categories as $categories)
                    <option value="{{ $categories->id }}" <?php if($data->category_id == $categories->id) echo "selected"; ?> > {{ $categories->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-outline-warning mt-3">Update Data</button>
            <a href="{{ route('dashboard-v1')}}" class="btn btn-outline-info mt-3">All User List</a>
        </div>
    </form>
</div>

@endsection

