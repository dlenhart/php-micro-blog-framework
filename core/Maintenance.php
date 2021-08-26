<?php
namespace App\Core;

class Maintenance
{
    /**
     * Maintenance file.
     *
     * @var string
     */
    public $file;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->file = "maintenance";
    }

    /**
     * Check
     *
     * @return static
     */
    public static function check()
    {
        return new static;
    }

    /**
     * Status - check maintenance file
     *
     * @return mixed
     */
    public function status()
    {
        if (file_exists($file = __DIR__."/../{$this->file}")) {
            $data = json_decode(file_get_contents($file), true);

            if ($data['maintenance']) {
                http_response_code($data['status']);
                (new self)->maintenance($data['template']);
                exit;
            }
        }

        return;
    }

    /**
     * Maintenance - return view
     *
     * @param $name name of the view
     * 
     * @return void
     */
    public function maintenance($name)
    {
        return include "../app/views/{$name}";
    }
}