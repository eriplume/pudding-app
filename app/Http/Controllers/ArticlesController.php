<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();
    
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }
    
        if ($request->filled('pref_id')) {
            $query->where('pref_id', $request->input('pref_id'));
        }
    
        if ($request->filled('shop')) {
            $query->where('shop', 'like', '%' . $request->input('shop') . '%');
        }
    
        $articles = $query->orderBy('created_at', 'desc')->paginate(8);
    
        $data = [
            'articles' => $articles,
        ];
    
        if (\Auth::check()) {
            return view('articles.index', $data);
        }
    
        return view('welcome', $data);
    }

    
    public function create()
    {
        $prefs = config('pref');
        
        return view('articles.create');
    }
    
    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required|max:20',
            'type_id' => 'required',
            'shop' => 'required|max:50',
            'pref_id' => 'required',
            'content' => 'max:255',
            'image' => 'file|mimes:gif,png,jpg,webp|max:1024'
        ]);
        
        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');
        // storage > public > img配下に画像が保存される
        $path = $img->store('img','public');

        $request->user()->articles()->create([
            'title' => $request->title,
            'type_id' => $request->type_id,
            'shop' => $request->shop,
            'pref_id' => $request->pref_id,
            'content' => $request->content,
            'address' => $request->address,
            'image' => $path,
        ]);
        
        return redirect('/')->with('message', 'Successfully!');
    }
    
    public function show(string $id)
    {
        
        $article = Article::findOrFail($id);
        
        return view('articles.show', [
            'article' => $article,
        ]);
    }
    
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        
        if (\Auth::id() === $article->user_id) {
            return view('articles.edit', [
                'article' => $article,
            ]);
        }
        
        return redirect('/');
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:20',
            'type_id' => 'required',
            'shop' => 'required|max:50',
            'pref_id' => 'required',
            'content' => 'max:255',
        ]);
    
        $article = Article::findOrFail($id);
        
        if (\Auth::id() === $article->user_id) {
            $article->title = $request->title;
            $article->type_id = $request->type_id;
            $article->shop = $request->shop;
            $article->pref_id = $request->pref_id;
            $article->content = $request->content;
            $article->address = $request->address;
            $article->save();
            
            return redirect('/')->with('message', 'Successfully updated!');
        }
        
        return redirect('/');
    }
    
    public function destroy(string $id) 
    {
        $article = Article::findOrFail($id);
        
        if (\Auth::id() === $article->user_id) {
            $article->delete();
            return redirect('/')->with('message', 'Successfully deleted.');;
        }
        
        return redirect('/');
    }
}
