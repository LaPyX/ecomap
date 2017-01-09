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
        return response()->json([
            'status' => 'ok',
            'page'   => Pages::find($request->id),
        ]);
    }
}
