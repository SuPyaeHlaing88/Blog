@extends("layouts.app")
@section("content")
<div class="container" style="max-width: 800px">
    @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach
        </div>
    @endif
    <form action="" method="post">
        @csrf
        <input type="text" class="form-control mb-2" name="title" placeholder="Title">
        <textarea name="body" id="" class="form-control mb-2" cols="30" rows="10" placeholder="Body"></textarea>
        <select name="category_id" class="form-control mb-2" id="">
            <option value="1">News</option>
            <option value="2">Tech</option>
            <option value="3">Sport</option>
            <option value="4">Fashion</option>
            <option value="5">Health</option>
        </select>
        <button class="btn btn-secondary">Add Article</button>
    </form>
</div>
@endsection
