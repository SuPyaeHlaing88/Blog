<div>
    @extends('layouts.app')
    @section('content')
        <div class="container" style="max-width: 800px">
            @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            <div class="card mb-2 border-primary">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ $article->title }}
                    </h3>

                    <div class="text-muted">
                        <strong class="text-success">{{ $article->user->name }}</strong>
                        Category: <b>{{ $article->category->name }}</b>
                        {{ $article->created_at }}
                    </div>
                    <div>
                        {{ $article->body }}
                    </div>
                    @auth
                        @can('delete-articlce', $article)
                            <a href="{{ url("/articles/delete/$article->id ") }}" class="btn btn-outline-danger">Delete</a>
                            <a href="{{ url("/articles/edit/$article->id ") }}" class="btn btn-outline-warning">Edit</a>
                        @endcan
                    @endauth

                </div>
            </div>

            <ul class="mt-4 list-group">
                <li class="list-group-item active">
                    Comments: <b>{{ count($article->comments) }}</b>
                </li>
                @foreach ($article->comments as $comment)
                    <li class="list-group-item">
                        <strong class="text-success">{{ $comment->user->name }}</strong>
                        {{ $comment->created_at }}
                        @auth
                            @can('delete-comment', $comment)
                                <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                            @endcan
                        @endauth
                        <br>
                        {{ $comment->content }}
                    </li>
                @endforeach
            </ul>
            @auth
                <form action="{{ url('/comments/add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="content" class="form-control my-2"></textarea>
                    <button class="btn btn-success">Add Comment</button>
                </form>
            @endauth

        </div>
    @endsection
</div>
