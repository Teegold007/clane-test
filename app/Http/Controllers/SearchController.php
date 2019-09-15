<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {


        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            $articles = Article::search($request->get('q'))->get();




            return $articles->count() ? $articles : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }


}
