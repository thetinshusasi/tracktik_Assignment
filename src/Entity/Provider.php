<?php
namespace App\Entity;

use Exception;

abstract class Provider
{
    protected array $data;
	
    public function __construct($data)
    {
        $this->data = $data;
    }
	const KEY = null;

    public static function getProvider($data): static
    {
        if (!isset($data['provider_type'])) {
            throw new Exception("Please provide a provider_type!");
        }
		return match($data['provider_type']) {
			ProviderAEmployee::KEY => new ProviderAEmployee($data),
			ProviderBEmployee::KEY => new ProviderBEmployee($data),
			default => throw new Exception('Invalid provider_type')
		};
    }
   
    protected function get(string $field): mixed
    {
        return $this->data[$field] ?? null;
    }

	abstract public function map(): TrackTikEmployee;
}