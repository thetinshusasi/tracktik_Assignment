<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;

class OAuthService
{
	private string $accessToken;

	public function __construct() {
		$client = new Client();
		$response = $client->post( $_ENV["TRACKTIK_OAUTH_URL"], [
            'json' => [
				"grant_type"=>"password",
				"client_id"=>$_ENV['CLIENT_ID'],
				"client_secret"=>$_ENV['CLIENT_SECRET'],
				"username"=>$_ENV['OAUTH_USERNAME'],
				"password"=>$_ENV['OAUTH_PASSWORD'],
            ],
        ]);
		if ($response->getStatusCode() !== 200) {
			throw new Exception('Authentication with TrackTik error!');
		}
		['access_token' => $this->accessToken] = json_decode((string) $response->getBody()->getContents(), true);
	}

	public function getAccessToken(): string 
	{
		return $this->accessToken;
	}
}