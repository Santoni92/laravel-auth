@extends('layouts.dashboard')

@section('content')

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


    <h1>Crea un nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <div>
            <label for="title">Titolo:</label>
            <input type="text" name="title" placeholder="Inserisci il titolo" value="{{ old('title') }}" required>
            <!--old() evita che quando sbaglio l'inserimento del valore quello vecchio  venga spianato(tolto)-->
            <!--metto il required per un minimo di validazione anche lato frontend-->
            @error('title')
                {{ $message }}
                <!-- o è quello di default oppure i l messaggio personalizzato che ho messo nel metodo validate()-->
            @enderror
        </div>

        <div>
            <label for="content">Contenuto</label>
            <textarea name="content" rows="10" placeholder="Inizia a scrivere qualcosa" required>{{ old('content') }}</textarea>
            @error('content')
                {{ $message }}
                <!-- o è quello di default oppure i l messaggio personalizzato che ho messo nel metodo validate()-->
            @enderror
        </div>

        <button type="submit">Salva il post creato</button>

    </form>
@endsection
