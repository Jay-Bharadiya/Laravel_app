<?php

namespace App\Models;
class Post{


    public static  function find($slug){
        return file_get_contents(resource_path("posts/{$slug}.html"));

    }
}


?>
