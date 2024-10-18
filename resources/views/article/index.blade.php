@extends("layouts.app")
@section("content")
    <div class="container" style="max-width: 800px">

        @if(session("info"))
            <div class="alert alert-danger">
                {{ session("info") }}
            </div>
        @endif

            @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h4>{{ $article->title }}</h4>
                    <div class="text-muted">
                        <b class="text-primary">{{ $article->user->name }}</b>,
                        <b class="text-success">Category:</b> {{ $article->category->name }},
                        <b class="text-danger">Comments:</b> {{ count($article->comments) }},
                        {{ $article->created_at->diffForHumans(), }}
                    </div>
                    <div>
                        {{ $article->body }}
                    </div>

                    <a href="{{ url("/articles/detail/$article->id") }}">
                        View Detail
                    </a>
                </div>
            </div>
        @endforeach
        {{ $articles->links() }}
    </div>
@endsection