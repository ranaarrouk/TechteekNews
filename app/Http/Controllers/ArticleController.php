<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $article = Article::create(['title' => $request['title'], 'content' => json_encode($request['content']), 'user_id' => Auth::id()]);
        $article = $article->fresh();
        return route('articles.show', $article->slug);
    }

    public function show($slug)
    {
        $article = Article::query()->where('slug', $slug)->first();
        if ($article)
        {
            return view('articles.show', compact('article'));
        }
        abort(404);
    }
}
