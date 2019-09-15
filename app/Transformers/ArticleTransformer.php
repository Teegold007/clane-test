<?php

namespace App\Transformers;

use App\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Article $article)
    {
        return [
            'title'=>$article->title,
            'body'=>$article->body,
            'ratings'=>$article->ratings,
            'created_at' => $article->created_at->diffForHumans()
        ];
    }
}
