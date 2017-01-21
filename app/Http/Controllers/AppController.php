<?php

namespace App\Http\Controllers;

use App\News;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        return view('home', [
            'user' => Auth::user() ?: false,
        ]);
    }

    public function page(Request $request)
    {
        $page       = Pages::find($request->id);
        $page->text = nl2br($page->text);

        return response()->json([
            'status' => 'ok',
            'page'   => $page,
        ]);
    }

    public function news(Request $request)
    {
        $news = News::where('status', 1)->orderBy('created_at', 'desc')->paginate(15);
        foreach ($news as $key => $value) {
            $value['text'] = nl2br($value['text']);
            $news[$key]    = $value;
        }

        return response()->json([
            'status'    => 'ok',
            'news'      => $news['data'],
            'next_page' => $news['next_page_url'],
            'prev_page' => $news['prev_page_url']
        ]);
    }
}
