<?php
class UnauthorizedHTTPException extends HTTPException {

    public function __construct($message, $code)
    {
        $this->message = $code . ' ' . $message;
    }
}