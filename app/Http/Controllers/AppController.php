<?php

namespace App\Http\Controllers;

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
        $page = Pages::find($request->id);
        $page->text = nl2br($page->text);

        return response()->json([
            'status' => 'ok',
            'page'   => $page,
        ]);
    }
}
