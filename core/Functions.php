<?php 

use App\Core\Http\Response;
use App\Core\Http\Request;

if (! function_exists('view')) {
    /**
     * Return a view
     *
     * @param string $name - name of view
     * @param array  $data - optional data to inject
     * 
     * @return view
     */
    function view($name, $data = [])
    {
        extract($data);
        return include "../app/views/{$name}.view.php";
    }
}

if (! function_exists('notFound')) {
    /**
     * Return a not found view
     * 
     * @param string $message - message for view
     * 
     * @return view
     */
    function notFound($message)
    {
        return view('notfound', ['message' => $message]);
    }
}

if (! function_exists('json')) {
    /**
     * Return json response
     *
     * @param array $data   - array to convert
     * @param int   $status - http status code
     * 
     * @return App\Core\Response
     */
    function json($data = [], $status = 200)
    {
        return Response::toJson($data, $status);
    }
}

if (! function_exists('arraySearch')) {
    /**
     * Recursive tree search
     *
     * @param string $query - search term
     * @param array  $array - array to search in
     * @param int    $depth - how deep
     * 
     * @return mixed
     */
    function arraySearch($query, $array, $depth = 0)
    {
        if (is_string($query)) { 
            $query = explode(".", $query);
        }
        
        $search = $query[$depth];

        if (isset($array[$search])) {
            if ($depth == count($query) - 1) {
                return $array[$search];
            } else {
                return arraySearch($query, $array[$search], ++$depth);
            }
        } else {
            return false;
        }
    }
}

if (! function_exists('conifg')) {
    /**
     * Return configuration value
     *
     * @param string $key - search term
     * 
     * @return mixed
     */
    function config($key)
    {
        $config = include '../config.php';
        return arraySearch($key, $config);
    }
}

if (! function_exists('dd')) {
    /**
     * Dump and Dieeee!
     *
     * @param array $data - data to dump
     * 
     * @return void
     */
    function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        
        die();
    }
}

if (! function_exists('params')) {
    /**
     * Request parameters
     * 
     * @return App\Core\Request
     */
    function params()
    {
        return Request::params();
    }
}

if (! function_exists('redirect')) {
    /**
     * Redirect
     * 
     * @param string $to      - page to redirect
     * @param int    $status  - http status code
     * @param array  $headers - optional headers
     * 
     * @return App\Core\Response
     */
    function redirect($to = null, $status = 302, $headers = [])
    {
        return Response::redirect($to, $status, $headers);
    }
}

if (! function_exists('flatten')) {
    /**
     * Flatten array
     * 
     * @param array $array - array to flatten
     * 
     * @return array
     */
    function flatten(array $array)
    {
        $return = array();
        
        array_walk_recursive(
            $array, function ($a) use (&$return) {
                $return[] = $a; 
            }
        );
        return $return;
    }
}
