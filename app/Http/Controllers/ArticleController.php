<?php

namespace App\Http\Controllers;

use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Validator;

class ArticleController extends Controller
{


    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return Article::paginate(10);
    }

    public function show($id)
    {
        return Article::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:5',
            'body'=>'required|min:5'
        ]);


       // dd(Auth::user()->id);

        $article= Article::create([
            'user_id' => $this->user->id,
            'title' => $request->title,
            'body' => $request->body
        ]);


        return response()->json($this->transformArticle($article), 201);


    }

    public function update(Request $request, $id)
    {

        $article = Article::findOrFail($id);
        $this->authorize('update',$article);
        $article->update($request->all());

        return response()->json($this->transformArticle($article), 200);

    }

    public function delete(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return response()->json(['message' => 'Article has been deleted'], 204);
    }

    public function rateArticles(Request $request, $id)
    {
        $request->validate([
            'ratings'=>'required|numeric|min:0|max:5'
        ]);

        $article = Article::findOrFail($id);

        $article->update(['ratings'=>$request->ratings]);

        return response()->json($this->transformArticle($article), 200);


    }

    private function transformArticle(Article $article)
    {
        $response = fractal()
            ->item($article)
            ->transformWith(new ArticleTransformer)
            ->toArray();

        return $response;

    }

}
