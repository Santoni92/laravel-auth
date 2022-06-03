@extends('layouts.dashboard')

@section('content')

    <h1>Modifica post {{ $post->id }}</h1>

    <!--ci stampa la lista degli errori-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
        @csrf

        @method('put')

        <div>
            <label for="title">Titolo:</label>
            <input type="text" placeholder="Inserisci il titolo" value="{{ old('title', $post->title) }}" required>
            <!--se sbaglio qualcosa e la validazione fallisce la funzione old() ci stampa ciò che avevamo scritto-->
            <!--la prima volta che vengo reindirizzato mi stampa il title-->
            @error('title')
                {{ $message }}
                <!-- o è quello di default oppure i l messaggio personalizzato che ho messo nel metodo validate()-->
            @enderror
        </div>

        <div>
            <label for="content">Contenuto:</label>
            <textarea name="content" rows="10" placeholder="Inizia a scrivere qualcosa"
                required>{{ old('content', $post->content) }}</textarea>
            @error('title')
                {{ $message }}
                <!-- o è quello di default oppure i l messaggio personalizzato che ho messo nel metodo validate()-->
            @enderror
        </div>

        <button type="submit">Modifica il post</button>

        <a href="{{ route('admin.posts.index') }}">Torna alla visualizzazione di tutti i post presenti</a>
    </form>
@endsection
