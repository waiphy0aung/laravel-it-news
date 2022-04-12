@extends('layouts.app')

@section('title') Article List @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Article List</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="feather-list"></i>
                            Article List
                        </h4>
                        <a href="{{ route("article.create") }}" class="h2 text-decoration-none"><i class="feather-plus-circle"></i></a>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="d-flex align-items-center">
                            {{ $articles->appends(request()->all())->links() }}
                            @isset(request()->search)
                                <a href="{{ route("article.index") }}" class="btn btn-sm btn-outline-dark ml-2 mb-3">
                                    <i class="feather-list"></i>
                                    All Articles
                                </a>
                                <span class="font-weight-bold ml-2 mb-3">Search by : "{{ request()->search }}"</span>
                            @endisset
                        </div>
                        <form action="{{ route("article.index") }}" method="get" class="mb-3">
                            <div class="form-inline">
                                <input type="text" placeholder="Search Article" name="search" value="{{ request()->search }}" class="form-control mr-2">
                                <button class="btn btn-primary">
                                    <i class="feather-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @if(session("message"))
                        <p class="alert alert-success">{{ session("message") }}</p>
                    @endif
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Article</th>
                            <th>Category</th>
                            @if(Auth::user()->role == 0)
                            <th>Owner</th>
                            @endif
                            <th>Controls</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ Str::words($article->title,5) }}</span>
                                    <br>
                                    <small class="text-black-50">{{ Str::words($article->description,8) }}</small>
                                </td>
                                <td>{{ $article->category->title }}</td>
                                @if(Auth::user()->role == 0)
                                <td>{{ $article->user->name }}</td>
                                @endif
                                <td>
                                    <a href="{{ route("article.show",$article->id) }}" class="btn btn-outline-success"><i class="feather-info"></i> Show</a>
                                    <a href="{{ route("article.edit",$article->id) }}" class="btn btn-outline-primary"><i class="feather-edit"></i> Edit</a>
                                    <form action="{{ route("article.destroy",[$article->id,"page"=>request()->page]) }}" id="form{{ $article->id }}" method="post" class="d-inline-block">
                                        @csrf
                                        @method("delete")
                                        <button type="button" class="btn btn-outline-danger" onclick="askConfirm({{ $article->id }})"><i class="feather-trash"></i> Delete</button>
                                    </form>
                                </td>
                                <td>
                                <span class="small">
                                    <i class="feather-calendar"></i>
                                    {{ $article->created_at->format("d-m-Y") }}
                                </span>
                                <br>
                                <span class="small">
                                    <i class="feather-clock"></i>
                                    {{ $article->created_at->format("h:i A") }}
                                </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no Article</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <p class="font-weight-bold mb-0">Total : {{ $articles->total() }}</p>
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
