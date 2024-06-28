<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index() 
    {
        $data = [];

        $articles = Article::orderBy('created_at', 'desc')->paginate(12);
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
            'shop' => 'required|max:20',
            'pref_id' => 'required',
            'content' => 'max:255',
        ]);
        
        $request->user()->articles()->create([
            'title' => $request->title,
            'type_id' => $request->type_id,
            'shop' => $request->shop,
            'pref_id' => $request->pref_id,
            'content' => $request->content,
            'address' => $request->address,
        ]);
        
        return redirect('/');
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
            'shop' => 'required|max:20',
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
            
            return redirect('/');
        }
        
        return redirect('/');
    }
    
    public function destroy(string $id) 
    {
        $article = Article::findOrFail($id);
        
        if (\Auth::id() === $article->user_id) {
            $article->delete();
            return redirect('/');
        }
        
        return redirect('/');
    }
}
