<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog_model; 
use Illuminate\Support\Facades\Cookie;
class Blog extends Controller
{
    public function index(){
        $db=Blog_model::get_posts();
        self::checkForCookie('siteAuth');
        if(session()->has('id')){
            $values = array(
                'MENU1' => 'SubForum1',
                'MENU2' => 'SubForum2',
                'MENU3' => 'SubForum3',
                'MENU4' => 'Logout',
                'href4' => 'blog/logout',
                'MENU5' => 'Welcome'.' '.session()->get('name'),
                'MENU6' => 'Blog',
                'href6' => 'blog/post',
                'loginId' => session()->get('id'),
                'href5' => '#',
                'db'   => $db
            ); 
        }
        else{
            $values = array(
                'MENU1' => 'SubForum1',
                'MENU2' => 'SubForum2',
                'MENU3' => 'SubForum3',
                'MENU4' => 'Login',
                'href4' => 'blog/login',
                'MENU5' => 'Register',
                'href5' => 'blog/register',
                'db'   => $db
            ); 
        }
        return view('index_template',$values);
    }

    public function register(){
        $values = array(
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'href4' => 'login',
            'MENU5' => 'Register',
            'href5' => 'register'
         );  

        return view('register_template',$values);
    }

    public function register_action(Request $request){
        $values = array(
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'MENU5' => 'Register',
            'Msg'   => 'Registration Completed.Welcome!',
            'text_color' => 'green',
            'back_color' => '#00d269',
            'icon' => 'glyphicon glyphicon-ok'
         );

        $Username=$request->Username;
        $Email=$request->Email;
        $pwdHash=substr(md5($request->Pwd),0,32);
        $nrows=Blog_model::check_email($request->Email);

        if(count($nrows)>0)
            return redirect('blog/register')->withErrors('Email já existe na base de dados')->withInput($request->except('Email'));
        elseif($request->Pwd!=$request->ConfPwd)
            return redirect('blog/register')->withErrors('Passwords não coincidem')->withInput();
        else{
            Blog_model::register_user($Username,$Email,$pwdHash);
            return view('message_template',$values);
        }     
    }

    public function login(){
        $values = array(
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'href4' => 'login',
            'MENU5' => 'Register',
            'href5' => 'register',
         ); 

        return view('login_template',$values);
    }

    public function login_action(Request $request){
        $values = array(
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Logout',
            'MENU5' => 'Welcome',
            'Msg'   => 'Welcome back!',
            'text_color' => 'green',
            'back_color' => '#00d269',
            'icon' => 'glyphicon glyphicon-log-in',
         );
        
        $pwdHash=substr(md5($request->pwd),0,32);
        $nrows=Blog_model::check_pwd($request->email,$pwdHash);
        if(count($nrows)>0){
            session()->regenerate();
            session(['name' => $nrows[0]->name]);
            session(['id' => $nrows[0]->id]);
            if($request->autologin == true){ 
                $cookie_name = 'siteAuth';
                $cookie_time = (60 * 24 * 30); // 30 days
                $remember_digest = substr(md5(time()),0,32);
                Blog_model::set_remember_digest($request->email,$remember_digest);
                Cookie::queue($cookie_name,$remember_digest,$cookie_time);
            }
            return view('message_template',$values); 
        } 
        else 
         return redirect('blog/login')->withErrors('Wrong email or password.'); 
    }

    public function logout(){
        session()->flush();
        $values = array(
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'MENU5' => 'Register',
            'Msg'   => 'See you back soon!',
            'text_color' => 'black',
            'back_color' => '#ff9966',
            'icon' => 'glyphicon glyphicon-log-out'
        );
        Cookie::queue('siteAuth','',-1);
        return view('message_template',$values);
    }

    public function post($blog_id = FALSE )
    {
        if(!session()->has('id')) {
        $values = array(
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
            'MENU5' => 'Register',
            'Msg'   => 'ERROR: Login first',
            'text_color' => 'red',
            'back_color' => '#ff9d9d',
            'icon' => 'glyphicon glyphicon-remove'
        );
            return view('message_template',$values);
        }

        $user_id=session()->get('id');
        
        $nrows=Blog_model::get_blog($user_id,$blog_id);
        $values = array(
            'MENU0' => 'Logout',
            'href0' => 'blog/logout',
            'MENU1' => 'Welcome'.' '.session()->get('name'),
            'href1' => 'blog/post',
            'ActionPost' => 'Write',
            'PostId' => '',
            'Post_content' => ''
        ); 
        if(!empty($blog_id)) {
            $values['Post_content'] = $nrows[0]->content;
            $values['PostId'] = $blog_id;
        } 
        return view('blog_template',$values);
    } 
    
    public function post_action(Request $request, $blog_id = FALSE)
    {   
        $user_id=session()->get('id');
        $nrows=Blog_model::get_blog($user_id,$blog_id);
        $content=$request->postContent;
        if(count($nrows)>0){
           Blog_model::update_blog($user_id,$blog_id,$content);
            $values = array(
                'MENU1' => 'SubForum1',
                'MENU2' => 'SubForum2',
                'MENU3' => 'SubForum3',
                'MENU4' => 'Logout',
                'MENU5' => 'Welcome'.' '.session()->get('name'),
                'Msg'   => 'SUCCESS: Post updated',
                'text_color' => 'green',
                'back_color' => '#00d269',
                'icon' => 'glyphicon glyphicon-ok'
            );
            return view('message_template',$values);
        }
        else{ 
            Blog_model::new_blog($user_id,$content);
            $values = array(
                'MENU1' => 'SubForum1',
                'MENU2' => 'SubForum2',
                'MENU3' => 'SubForum3',
                'MENU4' => 'Logout',
                'MENU5' => 'Welcome'.' '.session()->get('name'),
                'Msg'   => 'SUCCESS: New post submitted!',
                'text_color' => 'green',
                'back_color' => '#00d269',
                'icon' => 'glyphicon glyphicon-ok'
            );
            return view('message_template',$values);
        }
    }

    public function checkForCookie($name){
        if(Cookie::has($name)==1) { //retorna 1 se existir a cookie
            $cookie = Cookie::get($name); //retorna o valor associado a cookie...
            $nrows = Blog_model::check_remember_digest($cookie);
            if(count($nrows)>0) {
                session(['name' => $nrows[0]->name]);
                session(['id' => $nrows[0]->id]);
            }
        }      
    }
}
?>
