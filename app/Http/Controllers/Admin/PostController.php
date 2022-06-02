<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Post;   //importo il modello
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();   //recupero tutte le righe(tuple,record) della tabella posts
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');  //ritorno la vista che mostra il form dove l'utente inserisce i dati del post da creare
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //effettuo il controllo e la validazione dei dati immessi dall'utente e conservati in $request
        $request->validate([
            'title'=>'required|max:250',
            'content'=>'required'
        ]);

        $postData = $request->all();
        $newPost = new Post();
        $newPost->fill($postData);
        $slug = Str::slug($newPost->title); //creo uno slug tramite metodo statico slug() della classe Str;voglio derivare lo slug che sto creando da 'title'
        //slug dev'essere univoco e derivare da title cioè praticmente è il title ma scritto meglio(ovvero senz accenti o spazi) e ciò serve in ottica SEO
        //versione pulita del title ed inserito nell'url;è utile in ottica seo)
        $alternativeSlug = $slug;
        $postFound = Post::where('slug',$alternativeSlug)->first(); //con first() mi vado a prendere la prima occorrenza
        $counter = 1;   //a parità di titolo aggiungo un numero(contatore)
        while($postFound)
        {
            $alternativeSlug = $slug . '_' . $counter;
            $counter++;
            $postFound = Post::where('slug',$alternativeSlug)->first();
        }
        $newPost->slug = $alternativeSlug;
        $newPost->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);  // $post = Post::find($id);
        if(!$post)
        {
            abort(404);
        }

        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);  // $post = Post::find($id);
        if(!$post)
        {
            abort(404);
        }
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::findOrFail($id);  // $post = Post::find($id);
        $request->validate([
            'title'=>'required|max:250',
            'content'=>'required'
        ]);

        $postData = $request->all();
        $post->fill($postData);

        $slug = Str::slug($post->title);
        $alternativeSlug = $slug;
        $postFound = Post::where('slug',$alternativeSlug)->first();
        $counter = 1;
        while($postFound)
        {
            $alternativeSlug = $slug . '-' . $counter;
            $counter++;
            $postFound = Post::where('slug',$alternativeSlug)->first();
        }
        $post->slug = $alternativeSlug;

        $post->update();
        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);  // $post = Post::find($id);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
