<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function favorites($id)
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $favorites = $user->favorites()->paginate(10);
        
        return view('users.favorites', [
            'user' => $user,
            'articles' => $favorites,
        ]);
    }
    
    public function articles($id)
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $articles = $user->articles()->paginate(10);
        
        return view('users.articles', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }
}
