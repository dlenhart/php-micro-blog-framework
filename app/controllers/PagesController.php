<?php

namespace App\Controllers;


class PagesController extends Controller
{
    /**
     * About - About page
     *
     * @return view
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Contact - Contact page
     *
     * @return view
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Example - example
     *
     * @return view
     */
    public function example()
    {
        echo params()->id;
    }
}
