<?php

namespace App\Library;

class ActionResult
{
    public const STATUS_ERROR = 'error';

    public const STATUS_PENDING = 'pending';

    public const STATUS_PROCESSING = 'processing';

    public const STATUS_SUCCESS = 'success';

    public $status;

    public $message;

    public $payload;

    public function __construct($status, $message, $payload = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->payload = $payload;
    }

    public static function error($message, $payload = null)
    {
        return new ActionResult(self::STATUS_ERROR, $message, $payload);
    }

    public function isError()
    {
        return $this->status === self::STATUS_ERROR;
    }

    public function isSuccess()
    {
        return $this->status === self::STATUS_SUCCESS;
    }

    public function isProcessing()
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public static function success($message, $payload = null)
    {
        return new ActionResult(self::STATUS_SUCCESS, $message, $payload);
    }

    public static function pending($message, $payload = null)
    {
        return new ActionResult(self::STATUS_PENDING, $message, $payload);
    }

    public static function processing($message, $payload = null)
    {
        return new ActionResult(self::STATUS_PROCESSING, $message, $payload);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getFromPayload($key, $default = null)
    {
        return data_get($this->payload, $key, $default);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function printInLog()
    {
        $log = "El resultado de la acción es: {$this->status} - {$this->message}";
        \Log::info($log);
    }
}
