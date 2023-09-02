<?php

namespace IShop\Framework;

class ErrorHandler
{
    private string $errorDestination = TMP . DS . 'logs/errors.log'; 

    private string $errorsTemplates = WWW . DS . 'errors' . DS;
        
    public function __construct()
    {
        if (ENV === 'developer') {
            ini_set('display_errors', 1);
            error_reporting(-1);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($exception)
    {
        $message = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $this->logError($message, $file, $line);
        $trace = $exception->getTraceAsString();
        $this->displayError('Exception', $message, $file, $line, $trace, $exception->getCode());
    }

    private function logError($message = '', $file = '', $line = '')
    {
        $date = date('Y-m-d H:i:s');
        $message = "[{$date}] text error: {$message} | File: {$file} | Line: {$line}";
        error_log($message, 3, $this->errorDestination);
    }

    private function displayError($errno, $errstr, $errfile, $errline, $traceback, $response = 404)
    {
        http_response_code($response);

        if ($response === 404 && ENV !== 'developer') {
            require $this->errorsTemplates . '404.php';
            exit;
        }
        if (ENV === 'developer') {
            $path = $this->errorsTemplates . 'dev.php';
        } else {
            $path = $this->errorsTemplates . 'prod.php';
        }
        require $path;
    }
}

