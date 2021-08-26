<?php

namespace App\Core\Http;

use App\Core\Log\Logger;

class Router
{
    /*
     * Allowed HTTP Methods
    */
    public $routes = [
        'GET'      =>   [],
        'POST'     =>   []
    ];

    /**
     * Load routes
     * 
     * @param string $file - file to load
     * 
     * @return static
     */
    public static function load($file)
    {
        $router = new static; 

        include $file;

        return $router;
    }

    /**
     * Set routes
     * 
     * @param string $routes - set routes
     * 
     * @return void
     */
    public function define($routes)
    {
        $this->routes = $routes;
    }

    /**
     * GET - Set GET route
     * 
     * @param string $uri        - uri
     * @param string $controller - controller
     * 
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * POST - Set POST route
     * 
     * @param string $uri        - uri
     * @param string $controller - controller
     * 
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Determine is the requested route exists in our
     * routes array.
     *
     * @param string $uri  - uri to validate
     * @param string $type - http method to validate
     * 
     * @return boolean
     */
    public function hasRoute(string $uri, string $type)
    {
        return array_key_exists($uri, $this->routes[$type]);
    }

    /**
     * Dispatch the resource.
     *
     * @param string $uri  - uri
     * @param string $type - method
     * 
     * @return mixed
     */
    public function dispatch($uri, $type)
    {
        if (!isset($this->routes[$type])) {
            if (config('configuration.logging_enabled')) { 
                Logger::error("HTTP method not allowed: {$uri} - {$type}");
            }
            if (config('configuration.debug')) { 
                throw new \Exception('HTTP method not allowed here!');
            }            
        }

        if ($this->hasRoute($uri, $type)) {
            $split = explode('@', $this->routes[$type][$uri]);

            return $this->action($split[0], $split[1]);
        }

        if (config('configuration.logging_enabled')) { 
            Logger::error("File not found requesting: {$uri} - {$type}");
        }
        
        return view('notfound', ['message' => '404 | FILE NOT FOUND']);
    }

    /**
     * Dispatch the Controller
     *
     * @param string $controller - controller
     * @param string $method     - method
     * 
     * @return mixed
     */
    protected function action($controller, $method) 
    {
        $callController = "App\\Controllers\\{$controller}";
        $callController = new $callController;

        if (! method_exists($callController, $method)) {
            if (config('configuration.debug')) { 
                throw new \Exception(
                    "{$controller} is unable to call the '{$method}' method!"
                );
            }
        }

        return $callController->$method();
    }
}
