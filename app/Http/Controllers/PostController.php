namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Muestra una lista de todos los posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Muestra el formulario para crear un nuevo post
    public function create()
    {
        return view('posts.create');
    }

    // Almacena un nuevo post en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post creado con éxito.');
    }

    // Muestra un post específico
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Muestra el formulario para editar un post existente
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Actualiza un post existente en la base de datos
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post actualizado con éxito.');
    }

    // Elimina un post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post eliminado con éxito.');
    }
}

}
