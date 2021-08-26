<?php 

namespace App\Core\Http;

class Response
{

     /**
      * Not Found - return not found view
      *
      * @return view
      */
    public static function notFound()
    {
        return view('notfound', ['message' => '404 | FILE NOT FOUND.']);
    }

    /**
     * Redirect - redirect to url
     *
     * @param string $url 
     *
     * @return void
     */
    public static function redirect($url)
    {
        header("Location: {$url}"); 
        exit();
    }

    /**
     * To JSON - return JSON response
     *
     * @param array   $data   - array to convert
     * @param integer $status - http status code
     *
     * @return void
     */
    public static function toJson($data = null, $status = 200)
    {
        header_remove();
        header("Content-Type: application/json");

        $json = json_encode($data);

        if ($json === false) {
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            
            http_response_code(500);
        }

        http_response_code($status);
        echo $json;

        exit();
    }
}