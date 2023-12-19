<?php

namespace App\DTO;

class RequestDTO
{
    private int $code = 0;
    private string $message;

    private string $source = "product-service";
    private $data;

    /**
     * @param int $code
     * @param string $message
     * @param $data
     */
    public function __construct(int $code, string $message, $data)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }


    public function toArray()
    {
        return [
            'data'=>$this->data,
            'message'=>$this->message,
            'errorCode'=>$this->code,
            'source' => $this->source,
        ];
    }

}
