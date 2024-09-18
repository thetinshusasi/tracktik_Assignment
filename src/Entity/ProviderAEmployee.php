<?php
namespace App\Entity;

class ProviderAEmployee extends Provider
{
    const KEY = "A";

    public function map(): TrackTikEmployee 
    {
        return new TrackTikEmployee(
            jobTitle: $this->get('Role'),
            password:$this->get('Password'),
            gender:$this->get('Gender'),
            birthday:$this->get('Birthday'),
            firstName: explode(' ', $this->get('FullName') ?? '')[0] ?? null,
            lastName: explode(' ', $this->get('FullName') ?? '')[1] ?? null,
            primaryPhone:$this->get('Telephone'),
            email:$this->get('EmailAddress')
        );
    }

}