<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenagihanController extends Controller
{
    //
    public function index()
    {
        return view("penagihan.index");
    }

    public function create()
    {
        return view("penagihan.create");
    }

    public function take()
    {
        return view("penagihan.take");
    }
}
