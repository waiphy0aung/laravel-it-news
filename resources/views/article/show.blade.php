@extends('layouts.app')

@section('title') {{ $article->title }} @endsection
@section('head')
    <style>
        .description{
            white-space: pre-line;
        }
    </style>
@endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Article Detail</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        {{ $article->title }}
                    </h4>
                    <div class="mt-2 mb-4 text-primary">
                        <span class="small mr-2 font-weight-bold">
                            <i class="feather-layers"></i>
                            {{ $article->category->title }}
                        </span>
                        <span class="small mr-2 font-weight-bold">
                            <i class="feather-user"></i>
                            {{ $article->user->name }}
                        </span>
                        <span class="small mr-2 font-weight-bold">
                            <i class="feather-calendar"></i>
                            {{ $article->created_at->format("d-m-Y") }}
                        </span>
                        <span class="small mr-2 font-weight-bold">
                            <i class="feather-clock"></i>
                            {{ $article->created_at->format("h:i A") }}
                        </span>
                    </div>
                    <p class="text-black-50 description">{{ $article->description }}</p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <a href="{{ route("article.edit",$article->id) }}" class="btn btn-outline-primary"><i class="feather-edit"></i> Edit</a>
                            <form action="{{ route("article.destroy",$article->id) }}" id="form{{ $article->id }}" method="post" class="d-inline-block">
                                @csrf
                                @method("delete")
                                <button type="button" class="btn btn-outline-danger" onclick="askConfirm({{ $article->id }})"><i class="feather-trash"></i> Delete</button>
                            </form>
                        </div>
                        <p>{{ $article->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script>
        function askConfirm(id){
            Swal.fire({
                title: 'Are you sure <br> to delete this Article?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Article Deleted!',
                        'article has been deleted successfully',
                        'success'
                    )
                    setTimeout(function (){
                        $("#form"+id).submit();
                    },500)
                }
            })
        }
    </script>
@endsection
