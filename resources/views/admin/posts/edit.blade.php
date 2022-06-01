@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}">
        @csrf

        @method('put')

        <div>
            <label for="title">Titolo:</label>
            <input type="text" name="title" value="{{ $post->title }}">
        </div>
        <div>
            <label for="content">Contenuto:</label>
            <textarea name="content">{{ $post->content }}</textarea>
        </div>

        <button type="submit">Modifica il post</button>

    </form>
@endsection
