<?php

namespace Flutterwave\Payouts;

use Psr\Http\Message\ResponseInterface;
use Str;

class ResponsePad
{
    private $status;
    private array $body;
    private string $message;
    private int $code;

    public function __construct($response)
    {
        $body = self::getArrayResponseBody($response);

        $this->status = self::getStatus($body);
        $this->message = self::getMessage($body);
        $this->code = self::getResponseCode($body);
        array_key_exists('data', self::getArrayResponseBody($response)) ? $this->data = self::getData() : [];
    }

    public static function getArrayResponseBody(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    public static function getStatus(array $body)
    {
        if (array_key_exists('status', $body)) {
            if (Str::contains($body['status'], 'success')) {
                return true;
            } elseif (Str::contains($body['status'], 'error')) {
                return false;
            } else {
                return $body['status'];
            }
        }

        return null;
    }

    public static function getMessage($body): string
    {
        if (array_key_exists('message', $body)) {
            return $body['message'];
        }

        return nullOrEmptyString();
    }

    public static function getResponseCode(ResponseInterface $response)
    {
        return $response->getStatusCode();
    }

    /**
     * @param string $body
     *
     * @return array
     */
    public static function getData(string $body): array
    {
        if (array_key_exists('data', $body)) {
            return $body['data'];
        }

        return [];
    }

    public static function parseResponse(ResponseInterface $response)
    {
        $body = self::getBodyInJson($response);
    }
}
