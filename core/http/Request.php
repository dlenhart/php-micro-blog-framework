<?php

namespace App\Core\Http;

class Request
{
    /**
     * Uri - parse url
     *
     * @return string
     */
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * Method - get request method
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Params - get request parameters
     *
     * @return object
     */
    public static function params()
    {
        $object = new \stdClass();

        foreach ($_GET as $key => $value) {
            $object->$key = htmlspecialchars(strip_tags($value));
        }

        return $object;
    }
}

