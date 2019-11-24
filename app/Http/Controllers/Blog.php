<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog_model; 

class Blog extends Controller
{
    public function index(){
        $db=Blog_model::get_posts();
        $values = array(
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'MENU5' => 'Register',
            'href5' => 'register',
            'db'   => $db,
         );
        
        return view('index_template',$values);
    }

    public function register(){
        $values = array(
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'MENU5' => 'Register',
           /* 'href4' => 'Login',*/
            'href5' => 'register',
         );
        
        return view('register_template',$values);
    }

    public function register_action(){
        $db=Blog_model::get_posts();
        $values = array(
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'MENU5' => 'Register',
           /*'href4' => 'Login',
            'href5' => 'Register',*/
            'Msg'   => 'Registration Completed.Welcome!',
            'text_color' => 'green',
            'back_color' => '#00d269',
            'icon' => 'glyphicon glyphicon-ok',
         ); 
        return view('message_template',$values);
    }
}
