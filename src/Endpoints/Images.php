<?php

namespace Foodticket\Cloudflare\Endpoints;

use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\API;
use Cloudflare\API\Traits\BodyAccessorTrait;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Images implements API
{
    use BodyAccessorTrait;

    private Adapter $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function listImages(
        string $accountID,
        int $page = 1,
        int $perPage = 20,
    ): array {
        $query = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        $response = $this->adapter->get("accounts/{$accountID}/images/v2", $query);

        $this->body = json_decode($response->getBody());

        return $this->body->result->images;
    }

    public function uploadImage(string $accountID, string $path, $contents, string $id = null, array $metadata = [], ?string $batchToken = null): object
    {
        $body = [
            'file' => [
                'Content-type' => 'multipart/form-data',
                'name' => 'file',
                'filename' => $path,
                'contents' => $contents,
            ],
        ];

        if ($id) {
            $body['id'] = $id;
        }

        if (!empty($metadata)) {
            $body['metadata'] = \GuzzleHttp\json_encode($metadata);
        }

        $http = $this->getRequestObject(accountID: $accountID, batchToken: $batchToken);

        $response = $http->asMultipart()
            ->post('images/v1', $body);

        $response->throw();

        return $response->object()->result;
    }

    public function deleteImage(string $accountID, string $path): string
    {
        $response = $this->adapter->delete("accounts/{$accountID}/images/v1/{$path}");

        $this->body = $response->getBody();

        return $this->body->getContents();
    }

    public function getImagesUsageStatistics(string $accountID, string $path): string
    {
        $response = $this->adapter->get("accounts/{$accountID}/images/v1/{$path}");

        $this->body = $response->getBody();

        return $this->body->getContents();
    }

    public function getImageDetails(string $accountID, string $path): object
    {
        $response = $this->adapter->get("accounts/{$accountID}/images/v1/{$path}");

        $this->body = $response->getBody();

        return json_decode($this->body->getContents())->result;
    }

    public function updateImage(string $accountID, string $path, array $metadata = [], bool $requireSignedURLs = false): object
    {
        $response = $this->adapter->patch("accounts/{$accountID}/images/v1/{$path}", [
            'metadata' => $metadata,
            'requireSignedURLs' => $requireSignedURLs,
        ]);

        $this->body = json_decode($response->getBody());

        return $this->body->result;
    }

    /**
     * Get the root URL for the application.
     */
    public function getBaseImage(string $accountID, string $path): string
    {
        $response = $this->adapter->get("accounts/{$accountID}/images/v1/{$path}/blob");

        $this->body = $response->getBody();

        return $this->body->getContents();
    }

    /**
     * Get batch API token for making unrated, consecutive requests.
     */
    public function getBatchToken(string $accountID): string
    {
        $response = $this->adapter->get("accounts/{$accountID}/images/v1/batch_token");

        $this->body = $response->getBody();

        return json_decode($this->body->getContents())->result->token;
    }

    private function getRequestObject(string $accountID, ?string $batchToken): PendingRequest
    {
        $config = config('cloudflare');

        $baseUrl = $batchToken
            ? "https://batch.imagedelivery.net"
            : "https://api.cloudflare.com/client/v4/accounts/{$accountID}";

        $http = Http::baseUrl($baseUrl);

        if ($batchToken) {
            return $http->withToken(
                $batchToken
            );
        }

        return $http->withHeaders([
            'X-Auth-Email' => $config['api_email'],
            'X-Auth-Key' => $config['api_key'],
        ]);
    }
}
