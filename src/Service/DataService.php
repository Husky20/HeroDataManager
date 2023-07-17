<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DataService
{
    /**
     * @throws Exception
     */
    function getDataFromApiWithGuzzle(string $url): ?array
    {
        $httpClient = new Client();

        try {
            $response = $httpClient->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    function getDataFromApi(string $url): ?array
    {
        $response = file_get_contents($url);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $data;
    }

    public function getNumberOfPages(string $baseUrl): ?int
    {
        $data = $this->getDataFromApi($baseUrl);

        if ($data === null) {
            return null;
        }

        return (int)$data['count'];
    }

}