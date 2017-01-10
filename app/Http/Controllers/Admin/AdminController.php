<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\SystemPage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->department_id) {
            $department = Department::find(Auth::user()->department_id);
            $request = \App\Request::where('region_name', $department->region_name);

            return view('admin.index', [
                'total'    => \App\Request::where('region_name', $department->region_name)->where('status', '>=', 0)->count(),
                'moderate' => \App\Request::where('region_name', $department->region_name)->where('status', 0)->count(),
                'pending'  => \App\Request::where('region_name', $department->region_name)->where('status', 1)->count(),
                'work'     => \App\Request::where('region_name', $department->region_name)->where('status', 2)->count(),
                'done'     => \App\Request::where('region_name', $department->region_name)->where('status', 3)->count(),
            ]);
        }

        return view('admin.index', [
            'total'    => \App\Request::where('status', '>=', 0)->count(),
            'moderate' => \App\Request::where('status', 0)->count(),
            'pending'  => \App\Request::where('status', 1)->count(),
            'work'     => \App\Request::where('status', 2)->count(),
            'done'     => \App\Request::where('status', 3)->count(),
        ]);
    }

    public function faq(Request $request)
    {
        $faq = SystemPage::find(1);
        if (null == $faq) {
            $faq = SystemPage::create([
                'name' => 'FAQ',
                'text' => ''
            ]);
        }

        if ($request->input('faq')) {
            $faq->text = $request->faq;
            $faq->save();
        }

        return view('admin.faq', [
            'faq'  => $faq->text,
            'mode' => (boolean)Auth::user()->department_id 
        ]);
    }
}
