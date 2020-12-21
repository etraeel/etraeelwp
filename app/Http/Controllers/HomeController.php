<?php

namespace App\Http\Controllers;

use App\Article;
use App\Banner;
use App\Comment;
use App\Price;
use App\Product;
use App\Setting;
use App\userLike;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Banner::all();
        $articles = Article::all();
        return view('home', compact(['banners' , 'articles']));
    }

    public function comment(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent' => 'required',
        ]);

        auth()->user()->comments()->create($data);

        alert()->success('نظر با موفقیت ثبت شد');
        return back();
    }

    public function likeAndDislike(Request $request)
    {
        $user_ip = $request->getClientIp();
        $comment = Comment::find($request->comment_id);
        $like_number = $comment->like;
        $dis_like_number = $comment->dislike;

        if (is_null(userLike::where([['user_ip', $user_ip], ['comment_id', $request->comment_id]])->first())) {

            userLike::insert([
                'user_ip' => $user_ip,
                'like_or_dislike' => $request->like_or_dislike,
                'comment_id' => $request->comment_id,
            ]);

            if ($request->like_or_dislike == 'like') {
                $comment->forceFill([
                    'like' => $like_number + 1
                ])->save();
                $like_number++;

            }
            if ($request->like_or_dislike == 'dislike') {
                $comment->forceFill([
                    'dislike' => $dis_like_number + 1
                ])->save();
                $dis_like_number++;
            }

        }
        if (!is_null(userLike::where([['user_ip', $user_ip], ['comment_id', $request->comment_id]])->first())) {

            $userLike = userLike::where([['user_ip', $user_ip], ['comment_id', $request->comment_id]])->first();
            $like_or_dislike = $userLike->like_or_dislike;
            if ($like_or_dislike == 'like') {
                if ($request->like_or_dislike == 'dislike') {
                    $userLike->update([
                        'like_or_dislike' => 'dislike'
                    ]);

                    $comment->forceFill([
                        'dislike' => $dis_like_number + 1,
                        'like' => $like_number - 1
                    ])->save();
                    $dis_like_number++;
                    $like_number--;

                }

            }
            if ($like_or_dislike == 'dislike') {
                if ($request->like_or_dislike == 'like') {
                    $userLike->update([
                        'like_or_dislike' => 'like'
                    ]);

                    $comment->forceFill([
                        'like' => $like_number + 1,
                        'dislike' => $dis_like_number - 1
                    ])->save();
                    $like_number++;
                    $dis_like_number--;

                }
            }
            return ['like' => $like_number, 'dislike' => $dis_like_number];
        }

        return ['like' => $like_number, 'dislike' => $dis_like_number];
    }


    public function questions()
    {
        $questions_text = Setting::where('name' , 'question')->first();
        return view('singlePage.question', compact('questions_text'));
    }

    public function contactUs()
    {
        $contactUs_text = Setting::where('name' , 'site_contact_us')->first();
        return view('singlePage.contactUs', compact('contactUs_text'));
    }

    public function aboutUs()
    {
        $aboutUs_text = Setting::where('name' , 'site_about_us')->first();
        return view('singlePage.aboutUs', compact('aboutUs_text'));
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $products = Product::where('name' , 'LIKE',"%{$key}%")->orWhere('description' , 'LIKE',"%{$key}%")->orderBy('updated_at' , 'desc')->get();
        $articles = Article::where('title' , 'LIKE',"%{$key}%")->orWhere('description' , 'LIKE',"%{$key}%")->orWhere('key_words' , 'LIKE',"%{$key}%")->orWhere('text' , 'LIKE',"%{$key}%")->orderBy('updated_at' , 'desc')->get();
        $searches = $products->merge($articles);
//        $searches = $searches->sortByDesc('updated_at');
        return view('singlePage.search', compact(['searches' , 'key']));
    }
}
