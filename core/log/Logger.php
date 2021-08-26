<?php 

namespace App\Core\Log;

class Logger
{

    /**
     * $log_file - path and log file name
     *
     * @var string
     */
    protected $log_file;

    /**
     * $file - file
     *
     * @var string
     */
    protected $file;

    /**
     * Class constructor
     *
     * @param string $log_file - path and filename of log
     */
    public function __construct($log_file = '')
    {
        $log_file = $this->configPath();
        $this->log_file = $log_file;

        if (!file_exists($log_file)) {               
            fopen($log_file, 'w') or exit("Can't create $log_file!");
        }

        if (!is_writable($log_file)) {   
            throw new \Exception("ERROR: Unable to write to file!", 1);
        }
    }

    /**
     * ConfigPath - log location
     *
     * @param string $message
     * 
     * @return string
     */
    public function configPath()
    {
        return strval(config('configuration.logging_path'));
    }

    /**
     * Info method (write info message)
     *
     * @param string $message
     * 
     * @return void
     */
    public static function info($message)
    {
        return (new self)->writeLog($message, 'INFO');
    }

    /**
     * Debug method (write debug message)
     *
     * @param string $message
     * 
     * @return void
     */
    public static function debug($message)
    {
        return (new self)->writeLog($message, 'DEBUG');
    }

    /**
     * Warning method (write warning message)
     *
     * @param string $message
     * 
     * @return void
     */
    public static function warning($message)
    {
        return (new self)->writeLog($message, 'WARNING');    
    }

    /**
     * Error method (write error message)
     *
     * @param string $message
     * 
     * @return void
     */
    public static function error($message)
    {
        return (new self)->writeLog($message, 'ERROR');
    }

    /**
     * Write to log file
     *
     * @param string $message
     * @param string $severity
     * 
     * @return void
     */
    private function writeLog($message, $severity) 
    {
        if (!is_resource($this->file)) {
            $this->openLog();
        }

        $path = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

        $time = date('m-d-Y h:m:s'); 

        fwrite($this->file, "[{$time}] [{$path}] : [{$severity}] - {$message}" . PHP_EOL);
    }

    /**
     * Open log file
     *
     * @return void
     */
    private function openLog()
    {
        $openFile = $this->log_file;
        $this->file = fopen($openFile, 'a') or exit("Can't open $openFile!");
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }
}