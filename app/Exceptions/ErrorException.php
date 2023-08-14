<?php

namespace App\Exceptions;

use Exception;
use Log;

class ErrorException extends Exception
{
    protected $message = '';
    protected $code;

    /**
     * @param array[] $data
     * @param string $message
     * @param int $code
     * @param bool $doReport
     */
    public function __construct(string $message = "", int $code = 500, bool $doReport = true)
    {
        $this->message  =   $message;
        $this->code     =   $code;
        Log::error("錯誤訊息 : ".$this->getMessage());
        Log::error("錯誤檔案 : ".$this->getFile());
        Log::error("錯誤行數 : ".$this->getLine());
    }

    public function render()
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
