<?php

namespace App\Core;

use App\Core\Log\Logger;

class Blog
{
    public $content;
    public $meta_data;
    private $filename;
    private $files_array = [];
    private $articles_array = [];

    /**
     * Class constructor
     *
     * @param string $filename - file name
     */
    public function __construct($filename = '')
    {
        $this->filename = $filename;
    }

    /**
     * Open file stream
     *
     * @return static
     */
    public function open()
    {
        $stream = stream_get_contents(fopen($this->filename, 'r'));

        $this->content = explode("#content#", $stream);
        $this->meta_data = array_shift($this->content);

        return $this;
    }

    /**
     * Content - extract contents
     *
     * @return string
     */
    public function content()
    {
        return implode("#content#", $this->content);
    }

    /**
     * Metadata - extract file meta data
     *
     * @return object
     */
    public function metadata()
    {
        return json_decode($this->meta_data, true);
    }

     /**
      * Posts - get all valid posts
      * 
      * @param string $dir - directory containing posts
      *
      * @return array
      */
    public function posts($dir)
    {
        $files = $this->readDirectory($dir);

        if (!$files) {
            Logger::error("Unable to locate any files in: {$dir}");
            return false;
        }

        foreach ($files as $file) {
            $post = (new Blog($file))->open();

            $this->articles_array[] = [
                'file'      => $this->splitFilePath($file),
                'meta'      => $post->metadata(),
                'content'   => substr($post->content(), 0, config('app.post_preview_text_limit'))
            ];
        }

        return $this->sortByDate($this->articles_array);
    }

     /**
      * Read Directory - get all valid post files
      * 
      * @param string $dir - Directory to read from
      *
      * @return mixed
      */
    private function readDirectory($dir)
    {
        if (is_dir($dir)) {
            $files = array_diff(scandir($dir), array('.', '..'));

            foreach ($files as $file) {
                $filename = $dir . $file;
    
                if ($this->checkFileType($filename)) {
                    $this->files_array[] = $filename;
                }
            }
    
            return $this->files_array;
        }

        return false;        
    }

     /**
      * Check File Type - validate file extension
      * 
      * @param string $filename - filename to validate
      *
      * @return boolean
      */
    private function checkFileType($filename)
    {
        $file_extension = (new \SplFileInfo($filename))->getExtension();

        if (filetype($filename) == 'file' && $this->inConfig($file_extension)) {
            return true;
        }

        return false;
    }

    /**
     * In Config - value is in configuration setting
     * 
     * @param string $value - string to search for
     *
     * @return boolean
     */
    public function inConfig($value)
    {
        return in_array($value, flatten(config('app.allowed_post_file_types')));
    }

     /**
      * Sort - sort array by meta date
      * 
      * @param array $array - array to sort
      *
      * @return array
      */
    private function sortByDate($array)
    {
        usort(
            $array, function ($old, $new) {
                return new \DateTime($new['meta']['date']) <=> new \DateTime($old['meta']['date']);
            }
        );

        return $array;
    }

    private function paginate($array, $page, $offset) 
    {
        //
    }

    /**
     * Split File Path - split path by slashes
     * 
     * @param string $string - filepath to split
     *
     * @return string
     */
    private function splitFilePath($string)
    {
        $post = explode('/', $string);
        return explode('.', end($post))[0];
    }
}