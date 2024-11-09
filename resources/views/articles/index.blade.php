<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>

<body>
    {{-- <h1>Articles</h1>
    <ul>
        @foreach ($articles as $article)
            <li>{{ $article['title']}}</li>
            <span>{{ $article['name']}}</span>
        @endforeach
    </ul> --}}

    @extends('layouts.app')
    @section('content')
        <div class="container" style="max-width: 800px">
            {{-- pagination  --}}
            {{ $articles->links() }}

            @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif

            @foreach ($articles as $article)
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ $article['title'] }}
                        </h3>
                        <div class="text-muted">
                            <strong class="text-success">{{ $article->user->name }}</strong>
                            Category: <b>{{ $article->category->name }}</b>
                            Comments: <b>{{ count($article->comments) }}</b>
                            {{ $article['created_at'] }}
                        </div>
                        <div>
                            {{ $article['body'] }}
                        </div>
                        <a href="{{ url("/articles/detail/$article->id ") }}">View Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
</body>

</html>
