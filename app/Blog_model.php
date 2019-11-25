<?php

namespace App;
use Illuminate\Support\Facades\DB; 

class Blog_model 
{
    public static function get_posts(){
        $sql  = "SELECT microposts.content, microposts.created_at, microposts.updated_at, users.name, microposts.upvotes,microposts.downvotes,microposts.user_id, microposts.id
             FROM microposts, users
             WHERE microposts.user_id = users.id
             ORDER BY microposts.updated_at DESC";
        $query=DB::select($sql);
        return $query;
    } 

    public static function check_email($Email){
        $email="SELECT * FROM users where email='$Email'";
        $query=DB::select($email);
        return $query;
    }

    public static function register_user($Username,$Email,$pwdHash){
        $newUser="INSERT INTO users(name,email,password_digest,created_at,updated_at)
        VALUES ('$Username','$Email','$pwdHash',NOW(),NOW())";
        DB::insert($newUser);
    }

    public static function check_pwd($Email,$pwdHash){
        $pass="SELECT * FROM users where email = '$Email' AND password_digest='$pwdHash'";
        $query=DB::select($pass);
        return $query;
    }
    
    public static function new_blog($user_id,$blog){
        $newBlog  = "INSERT INTO microposts(user_id,content,created_at,updated_at) VALUES ('$user_id','$blog',NOW(),NOW())";
        DB::insert($newBlog);
    }
    
    public static function get_blog($user_id,$blog_id){
         $blog  = "SELECT content FROM microposts WHERE user_id ='$user_id' AND id='$blog_id'";
         $query=DB::select($blog);
         return $query;
    } 
    
    public static function update_blog($user_id,$blog_id,$content){
        $updateBlog = "UPDATE microposts SET content='$content', updated_at=NOW() WHERE id='$blog_id' AND user_id='$user_id'";
        DB::update($updateBlog);
    
    }

    public static function set_remember_digest($Email,$value){
        $setCookie="UPDATE users SET remember_digest='$value' WHERE email='$Email'";
        DB::update($setCookie);
    }

    public static function check_remember_digest($value) {
        $checkCookie="SELECT * FROM users WHERE remember_digest='$value'";
        $query=DB::select($checkCookie);
        return $query;
    }
}
?>
