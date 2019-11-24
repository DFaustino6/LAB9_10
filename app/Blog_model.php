<?php

namespace App;
use Illuminate\Support\Facades\DB; 

class Blog_model 
{
    public static function get_posts(){
        $sql  = "SELECT microposts.content, microposts.created_at, microposts.updated_at, users.name, microposts.upvotes,microposts.downvotes
             FROM microposts, users
             WHERE microposts.user_id = users.id
             ORDER BY microposts.updated_at DESC";
        $query=DB::select($sql);
        return $query;
    } 
}
