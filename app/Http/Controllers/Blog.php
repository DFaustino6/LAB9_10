<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog_model; 

class Blog extends Controller
{
    public function index(){
        $db=Blog_model::get_posts();
        return view('index_template',compact('db'));
    }
}
