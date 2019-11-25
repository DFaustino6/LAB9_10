<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog_model; 

class Blog extends Controller
{
    public function index(){
        $db=Blog_model::get_posts();
        if(session()->has('id')){
            $values = array(
                'FORUMName' => 'Daw Forum',
                'MENU1' => 'SubForum1',
                'MENU2' => 'SubForum2',
                'MENU3' => 'SubForum3',
                'MENU4' => 'Logout',
                'href4' => 'logout_action',
                'MENU5' => 'Welcome'.' '.session()->get('name'),
                'MENU6' => 'Blog',
                'href6' => 'post',
                'loginId' => session()->get('id'),
                'href5' => '#',
                'db'   => $db
            ); 
        }
        else{
            $values = array(
                'FORUMName' => 'Daw Forum',
                'MENU1' => 'SubForum1',
                'MENU2' => 'SubForum2',
                'MENU3' => 'SubForum3',
                'MENU4' => 'Login',
                'href4' => 'login',
                'MENU5' => 'Register',
                'href5' => 'register',
                'db'   => $db
            ); 
        }
        return view('index_template',$values);
    }

    public function register(){
        $values = array(
            'FORUMName' => 'Daw Forum',
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
            'FORUMName' => 'Daw Forum',
            'MENU1' => 'SubForum1',
            'MENU2' => 'SubForum2',
            'MENU3' => 'SubForum3',
            'MENU4' => 'Login',
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
            return redirect('register')->withErrors('Email já existe na base de dados')->withInput($request->except('Email'));
        elseif($request->Pwd!=$request->ConfPwd)
            return redirect('register')->withErrors('Passwords não coincidem')->withInput();
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
            return view('message_template',$values); 
        } 
        else 
         return redirect('login')->withErrors('Wrong email or password.'); 
    }

    public function logout_action(){
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
        return view('message_template',$values);
    }

    public function post($blog_id = FALSE )
    {
        $user_id=session()->get('id');
        $nrows=Blog_model::get_blog($user_id,$blog_id);
        //print_r($blog_id);
        $values = array(
            'FORUMName' => 'Daw Forum',
            'href0' => 'index.php',
            'MENU1' => 'Blog',
            'href1' => 'post',
            'ActionPost' => 'Write',
        );

        if(count($nrows)<0)
            
        return view('blog_template',$values);
    } 
    
    public function post_action($blog_id = FALSE)
    {

    }

}
?>
