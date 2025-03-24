<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        return view('index', compact('user'));
    }
}
