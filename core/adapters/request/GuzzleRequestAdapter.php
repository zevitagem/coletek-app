<?php

namespace app\adapters\request;

use GuzzleHttp\Client;
use app\contracts\HttpVerbsContract;

class GuzzleRequestAdapter implements HttpVerbsContract
{
    public function get(string $url, array $params)
    {
        $client = new Client();
        $res = $client->request('GET', $url, [
            'query' => $params
        ]);

        $body = $res->getBody();
        $content = $body->getContents();

        return [
            'status_code' => $res->getStatusCode(),
            'header' => $res->getHeader('content-type')[0],
            'body' => $body,
            'content' => json_decode($content, true)
        ];
    }
}
