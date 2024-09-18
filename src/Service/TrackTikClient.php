<?php

namespace App\Service;

use App\Entity\TrackTikEmployee;
use Exception;
use GuzzleHttp\Client;

class TrackTikClient
{
	public function __construct(
		public string $access_token, 
		private Client $client = new Client(['base_uri' => 'https://smoke.staffr.net/rest/v1/'])
	) {}

	public function createEmployee(TrackTikEmployee|null $employee = null): string {
		$request = $this->client->post(
			'employees',
			[
				'headers' => 
					[
						'Authorization' => "Bearer {$this->access_token}"
					], 
				'json' => $employee->getAllData()
			],
		);

		return json_decode(
			$request->getBody()->getContents(),
			true
		)['data']['customId'] ?? throw new Exception('Malformed response!');
	}
		
	public function updateEmployee(string $employee_id, TrackTikEmployee|null $employee = null): string {
		$request = $this->client->patch(
			"employees/{$employee_id}",
			[
				'headers' => 
				[
					'Authorization' => "Bearer {$this->access_token}"
				], 
				'json' => $employee->getUpdateData()
			],
		);
		return json_decode(
			$request->getBody()->getContents(),
			true
		)['data']['customId'] ?? throw new Exception('Malformed response!');
	}

	public function fetchEmploye(int $employee_id): bool 
	{
		$asd = $this->client->get(
			"employees/{$employee_id}",
			[
				'headers' => 
					[
						'Authorization' => "Bearer {$this->access_token}"
					], 
			],
		);
		return $asd->getStatusCode() === 200;
	}
}