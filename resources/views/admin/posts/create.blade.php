@extends('layouts.dashboard')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h1>Crea un nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <div>
            <label for="title">Titolo:</label>
            <input type="text" name="title" placeholder="Inserisci il titolo" value="{{ old('title') }}">
        </div>

        <div>
            <label for="content">Contenuto</label>
            <textarea name="content"></textarea>
        </div>

        <button type="submit">Salva il post creato</button>

    </form>
@endsection
