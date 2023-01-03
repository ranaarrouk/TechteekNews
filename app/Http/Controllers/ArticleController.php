<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
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
        $response = [];
        $storeRequest = new StoreArticle();
        try {
            $this->validate($request, $storeRequest->rules(), $storeRequest->messages());
            $article = Article::create(['title' => $request['title'], 'content' => json_encode($request['content']), 'user_id' => Auth::id()]);
            // to get added article
            $article = $article->fresh();
            return route('articles.show', $article->slug);
        } catch (\Exception $exception) {
            $response['status'] = 'fail';
            $response['message'] = $exception->getMessage();
            return $response;
        }
    }

    public function show($slug)
    {
        $response = [];
        try {
            $article = Article::query()->where('slug', $slug)->first();
            if ($article) {
                return view('articles.show', compact('article'));
            }
            abort(404);
        } catch (\Exception $exception) {
            $response['status'] = 'fail';
            $response['message'] = $exception->getMessage();
        }
    }
}
