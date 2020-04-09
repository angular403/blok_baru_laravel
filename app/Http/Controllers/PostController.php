<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('created_at','desc')
                      ->paginate(4);
        return view('post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::all();
        $category = Category::all();
        return view('post.create',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pesan = [
            'name' => ':attribute Harus Diisi Terlebih Dahulu',
            'max' => ':attribue Harus Diisi Maksimal :max Karakter',
            'min' => ':attribute Harus Diisi Minimal :min Karakter'
        ];

        $this->validate($request,[
            'judul' => 'required|min:3|max:100',
            'content' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg|max:2048',

        ],$pesan);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $post = post::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'gambar' => 'uploads/post/'.$new_gambar,
            'slug' => Str::slug($request->judul),
            'users_id' => Auth::id()
        ]);
        // dd($post);
            $post->tag()->attach($request->tag);

        $gambar->move('uploads/post/',$new_gambar);
        return redirect()->route('post.index')->with('success','Postingan Berhasil Disimpan');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $tag = Tag::all();
        $post = Post::findOrFail($id);
        return view('post.edit',compact('post','tag','category'));
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
        $post = Post::findOrFail($id);

        $pesan = [
            'name' => ':attribute Harus Diisi Terlebih Dahulu',
            'max' => ':attribue Harus Diisi Maksimal :max Karakter',
            'min' => ':attribute Harus Diisi Minimal :min Karakter'
        ];

        $this->validate($request,[
            'judul' => 'required|min:3|max:100',
            'content' => 'required',

        ],$pesan);

        if($request->has('gambar'))
        {
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('uploads/post/',$new_gambar);

            $post_data =[
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'gambar' => 'uploads/post/'.$new_gambar,
                'slug' => Str::slug($request->judul),
            ];
        }
        else
        {
            $post_data =[
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->judul)
            ];
        }

        $post->tag()->sync($request->tag);
        $post->update($post_data);

        return redirect()->route('post.index')->with('success','Postingan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('post.index')->with('success','Data Post Berhasil Dihapus');
    }

    public function tampil_hapus()
    {
        $post = Post::onlyTrashed()->paginate(2);
        return view('post.hapus',compact('post'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        return redirect()->route('post.index')->with('success','Data Post Berhasl Di Restore, (Silahkan
        Cek List Post)');
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forcedelete();

        return redirect()->route('post.index')->with('success','Data Post Berhasl Dihapus Permanen)');
    }
}
