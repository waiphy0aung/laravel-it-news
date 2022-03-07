@extends("blog.master")
@section("title") {{ $article->title }} @endsection
@section("content")
    <div class="">
        <div class="py-3">

            <div class="small post-category mb-3">
                <a href="{{ route("baseOnCategory",$article->category->id) }}" rel="category tag">{{ $article->category->title }}</a>
            </div>

            <h2 class="fw-bolder">{{ $article->title }} </h2>
            <div class="my-3 feature-image-box">
                <div class="d-block d-md-flex justify-content-between align-items-center my-3">
                    <div class="">
                        <img alt="" src="{{ isset($article->user->photo) ? asset('storage/profile/'.$article->user->photo) : asset('dashboard/img/user-default-photo.png') }}"
                             class="avatar avatar-30 photo rounded-circle" height="30" width="30">
                        <a href="{{ route("baseOnUser",$article->user->id) }}" class="text-decoration-none ms-2">{{ $article->user->name }}</a>
                    </div>

                    <div class="text-primary">
                        <a href="{{ route("baseOnDate",$article->created_at) }}" class="text-decoration-none">
                            <i class="feather-calendar"></i>
                            {{ $article->created_at->format("j F Y h:i A") }}
                        </a>
                    </div>
                </div>

                <p class="text-black-50" style="white-space: pre-line">{{ $article->description }}</p>
                @php
                    $previousArticle = \App\Article::where("id","<",$article->id)->latest("id")->first();
                    $nextArticle = \App\Article::where("id",">",$article->id)->first();
                @endphp
                <div class="nav d-flex justify-content-between p-3">
                    @if(isset($previousArticle))
                    <a href="{{ route("detail",$previousArticle->id)}}"
                       class="btn btn-outline-primary page-mover rounded-circle">
                        <i class="feather-chevron-left"></i>
                    </a>
                    @endif
                    <a class="btn btn-outline-primary px-3 rounded-pill" href="{{ route("index") }}">
                        Read All
                    </a>
                    @if(isset($nextArticle))
                    <a href="{{ route("detail",$nextArticle->id)}}"
                       class="btn btn-outline-primary page-mover rounded-circle">
                        <i class="feather-chevron-right"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
