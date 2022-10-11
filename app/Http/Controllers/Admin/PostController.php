<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected function slugCalc($title) {
        $slug = Str::slug($title, '-');
        $check = Post::where('slug', $slug)->first();
        $counter = 1;
        while($check) {
            $slug = Str::slug($title . '-' . $counter . '-');
            $counter++;
            $check = Post::where('slug', $slug)->first();
        }
        return $slug;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'media' => 'required|max:255|url',
                'author' => ['required', Rule::in(['Simone Giusti', 'Alessio Vietri', 'Jacopo Damiani'])],
                'content' => 'required|max:65535',
            ]
            );
            $data = $request->all();
            $post = new Post;
            $post->fill($data);
            $slug = $this->slugCalc($post->title);
            $post->slug = $slug;
            $post->save();
            return redirect()->route('admin.posts.index')->with('status', 'Post creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'media' => 'required|max:255|url',
                'author' => ['required', Rule::in(['Simone Giusti', 'Alessio Vietri', 'Jacopo Damiani'])],
                'content' => 'required|max:65535',
            ]
        );
        $data = $request->all();
        if ($post->title !== $data['title']) {
            $data['slug'] = $this->slugCalc($data['title']);
        }
        $post->update($data);
        $post->save();
        return redirect()->route('admin.posts.index')->with('status', 'La modifica al post è stata apportata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Il post è stato eliminato!');
    }

    public function showSimone(Post $post)
    {
        $posts = Post::where('author', 'Simone Giusti')->get();
        return view('admin.posts.simone', compact('posts'));
    }

    public function showAlessio(Post $post)
    {
        $posts = Post::where('author', 'Alessio Vietri')->get();
        return view('admin.posts.alessio', compact('posts'));
    }

    public function showJacopo(Post $post)
    {
        $posts = Post::where('author', 'Jacopo Damiani')->get();
        return view('admin.posts.jacopo', compact('posts'));
    }
}
