<?php
namespace App\Entity;

class TrackTikEmployee
{
    public function __construct(
        public ?string $jobTitle,
        public ?string $password,
        public ?string $gender,
        public ?string $birthday,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $primaryPhone,
        public ?string $email,
    ){}

    public function getAllData(): array
    {
        return get_object_vars($this);
    }

    public function getUpdateData() : array
    {
        return array_filter($this->getAllData());
    }
}