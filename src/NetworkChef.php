<?php

namespace Flutterwave\Payouts;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Str;

class NetworkChef
{
    private array $config;
    private Request $request;

    private string $secret_key;

    private string $endpoint;
    private string $action;

    private int $lastResponseCode;
    private ResponseInterface $lastResponse;
    private array $lastResponsePad;

    /**
     * @return int
     *
     * get the last w3 request code as returned from the server
     */
    public function getLastResponseCode(): int
    {
        return $this->lastResponseCode;
    }

    /**
     * @return ResponseInterface
     *
     * get the last GuzzleHttp Response
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @return ResponsePad
     *
     * get a simplified formatted array containing the request in a simple way that can be used
     */
    public function getLastResponsePad()
    {
        return $this->lastResponsePad;
    }

    private $request_body;

    /**
     * NetworkChef constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->fetchAPIKeys();
        $this->setConfig($config);
    }

    private function fetchAPIKeys()
    {
        $this->secret_key = config('flutterwave.keys.secret_key');
    }

    private function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint): void
    {
        if (Str::contains($endpoint, ':')) {
            $parts = explode(':', $endpoint);
            $this->setAction($parts[0]);
            $this->endpoint = $parts[1];
        } else {
            $this->endpoint = $endpoint;
        }
    }

    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->request_body;
    }

    /**
     * @param mixed $request_body
     *
     * set the parameters in array form for the request being made
     */
    public function setRequestBody($request_body): void
    {
        $this->request_body = $request_body;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function makeRequest()
    {
        return $this->buildCompleteUri();
    }

    private function buildCompleteUri()
    {
        $client = new Client();

        try {
            $response = $client->request(
                $this->action,
                $this->createFormattedUrl(
                    $this->config['base_url'],
                    $this->config['api_version'],
                    $this->endpoint
                ),
                [
                    'headers' => $this->getHeaders(),
                    'json'    => $this->request_body,
                ],
            );
            $this->lastResponsePad = ResponsePad::getArrayResponseBody($response);
            $this->lastResponse = $response;
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $this->lastResponse = $response;
            $this->lastResponsePad = ResponsePad::getArrayResponseBody($response);
        } catch (Exception $exception) {
            $message = $exception->getMessage();

            throw new Exception($message);
        }

        $this->lastResponseCode = $this->lastResponse->getStatusCode();

        return $this->lastResponsePad;
    }

    private function createFormattedUrl(...$parts): string
    {
        $finalString = '';

        foreach ($parts as $urlPart) {
            $urlPart = trim($urlPart, '/');
            $finalString .= $urlPart.'/';
        }

        return $finalString;
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer '.$this->secret_key,
            'Accept'        => 'Application/Json',
        ];
    }
}
