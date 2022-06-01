@extends('layouts.dashboard')

@section('content')
    <h1>Tutti i Posts</h1>
    <a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>

    <table>
        <thead>
            <tr>
                <td>Titolo</td>
                <td>Slug</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td><a href="{{ route('admin.posts.edit', $post->id) }}">Modifica post</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
