<?php
namespace App\Controllers;

use App\Core\Blog;

class HomeController extends Controller
{
    /**
     * Home - Root
     *
     * @return view
     */
    public function home()
    {
        $posts = (new Blog)->posts(__DIR__. config('app.posts_dir'));

        return view(
            'index', [
                'posts' => (!$posts) ? [] : $posts
            ]
        );
    }

}
