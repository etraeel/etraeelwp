<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:articles_show')->only(['index']);
        $this->middleware('can:article_create')->only(['create' , 'store']);
        $this->middleware('can:article_edit')->only(['edit' , 'update']);
        $this->middleware('can:article_delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::paginate(10);
        return view('admin.articles.all' , compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'key_words' => ['required', 'string'],
            'reading_time' => ['required', 'string'],
            'image' => ['required'],
            'description' => ['required'],
        ]);

        $image = $request->file('image');
        $image->move(public_path('images/articles/') , $image->getClientOriginalName());
        $data['image'] = 'images/articles/' . $image->getClientOriginalName();

        $data['writer'] = Auth::user()->name;

       $article = Article::create($data);
        alert()->success('مقاله با موفقیت ایجاد شد ');
       return redirect(route('admin.articles.index'));
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
    public function edit(Article $article)
    {
        return view('admin.articles.edit' , compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'key_words' => ['required', 'string'],
            'reading_time' => ['required', 'string'],
            'writer' => ['required', 'string'],
            'description' => ['required'],
        ]);
        $article->update($data);
        alert()->success('مقاله با موفقیت ویرایش شد ');
        return redirect(route('admin.articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(َArticle $article)
    {
        $article->delete();
        alert()->success('مقاله با موفقیت حذف شد ');
        return back();
    }

}
