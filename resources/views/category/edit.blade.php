@extends("layouts.app")

@section('title') Update Category @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route("category.index") }}">Category Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-edit"></i>
                        Edit Category
                    </h4>
                    <hr>
                    <form action="{{ route("category.update",$category->id) }}" method="post" class="mb-3">
                        @csrf
                        @method('put')
                        <div class="form-inline">
                            <input type="text" placeholder="New Category" name="title" value="{{ old("title",$category->title) }}" class="form-control @error('title') is-invalid @enderror form-control-lg mr-2">
                            <button class="btn btn-lg btn-primary">Update</button>
                        </div>
                        @error("title")
                        <small class="text-danger font-weight-bold text-center">{{ $message }}</small>
                        @enderror
                        @if(session("message"))
                            <small class="text-success font-weight-bold">{{ session("message") }}</small>
                        @endif
                    </form>
                    @include("category.list")
                </div>
            </div>
        </div>
    </div>
@endsection
