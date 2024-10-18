@extends("layouts.app")
@section("content")
    <div class="container" style="max-width: 800px">

        @if (@session('info'))
            <div class="alert alert-info">
                {{ session("info")}}
            </div>
        @endif
            

            <div class="card mb-2 border-primary">
                <div class="card-body">
                    <h4>{{ $article->title }}</h4>
                    <div class="text-muted">
                        <b class="text-primary">{{ $article->user->name }}</b>,
                        <b>Category:</b> {{ $article->category->name }},
                        {{-- <b>Comments:</b> {{ count($article->comments) }}, --}}
                        {{ $article->created_at->diffForHumans() }}
                    </div>
                    <div class="mb-2">
                        {{ $article->body }}
                    </div>

                    @auth
                        @can("delete-article", $article)
                        <a href="{{ url("/articles/delete/$article->id") }}"
                            class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                        @endcan
                    @endauth
                </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item active">
                    Comments
                    ({{ count($article->comments) }})
                </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-items">
                    <a href="{{ url("/comments/delete/$comment->id")}}"
                        class="btn-close float-end"></a>

                        <b class="text-primary">{{ $comment->user->name}}</b>
                    {{ $comment->content}}
                </li>
            @endforeach
            </ul>
                @auth
                <form action="{{ url("/comments/add")}}" method="post">
                @endauth
            @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id}}">
                    <textarea name="content" class="form-control my-2"></textarea>
                    <button class="btn btn-secondary">Add Comment</button>
                </form>
        </div>
@endsection