<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\Http\Controllers\Controller;
use App\Like;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $articles = Article::paginate(12);;
        return view('article.index', compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article , Request $request)
    {
        $article->increment('counter');

        $ip = $request->ip();
        $ips = $article->likes()->pluck('ip')->toArray();

        if(in_array($ip , $ips)){
            $article['status_like'] = 'like';
        }else{
            $article['status_like'] = 'dislike';
        }

        return view('article.single', compact('article'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $ip = $request->ip();
        $ips = $article->likes()->pluck('ip')->toArray();
        $likes = count($ips);

        if(! in_array($ip , $ips)){
            $article->likes()->create([
                'ip' => $ip,
                'article_id' => $article->id,
            ]);
            return response( [ 'like_number' => $likes+1  ,   'status' =>'like'] );
        }
        elseif (in_array($ip , $ips)){
            $article->likes()->where('ip' , $ip)->delete();
            return response( [ 'like_number' => $likes-1  ,   'status' =>'dislike']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
