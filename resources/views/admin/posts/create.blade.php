<form action="{{ route('admin.posts.store') }}" method="post">
    @csrf
    <div>
        <label for="title">Titolo:</label>
        <input type="text" name="title">
    </div>

    <div>
        <label for="content">Contenuto</label>
        <textarea name="content"></textarea>
    </div>

    <button type="submit">Salva il post creato</button>

</form>
