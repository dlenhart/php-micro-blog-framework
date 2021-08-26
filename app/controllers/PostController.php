<?php

namespace App\Controllers;
use App\Core\Blog;

class PostController extends Controller
{
    /**
     * Post - Individual post view
     *
     * @return view
     */
    public function post()
    {
        $filename = __DIR__. config('app.posts_dir') . params()->post . ".post";

        if (file_exists($filename)) {
            $post = (new Blog($filename))->open();

            return view(
                'post', [
                    'post'  => $post->content(),
                    'meta'  => $post->metadata(),
                ]
            );
        }

        return notFound('404 | POST NOT FOUND.');
    }
}
