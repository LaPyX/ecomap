<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->department_id) {
            $department = Department::find(Auth::user()->department_id);
            $request = Request::where('region_name', $department->region_name);

            return view('admin.index', [
                'total'    => Request::where('region_name', $department->region_name)->where('status', '>=', 0)->count(),
                'moderate' => Request::where('region_name', $department->region_name)->where('status', 0)->count(),
                'pending'  => Request::where('region_name', $department->region_name)->where('status', 1)->count(),
                'work'     => Request::where('region_name', $department->region_name)->where('status', 2)->count(),
                'done'     => Request::where('region_name', $department->region_name)->where('status', 3)->count(),
            ]);
        }

        return view('admin.index', [
            'total'    => Request::where('status', '>=', 0)->count(),
            'moderate' => Request::where('status', 0)->count(),
            'pending'  => Request::where('status', 1)->count(),
            'work'     => Request::where('status', 2)->count(),
            'done'     => Request::where('status', 3)->count(),
        ]);
    }
    
    public function faq()
    {
        return view('admin.faq');
    }
}
