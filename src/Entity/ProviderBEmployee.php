<?php
namespace App\Entity;

class ProviderBEmployee extends Provider
{
    const KEY = 'B';

    public function map(): TrackTikEmployee 
    {
        return new TrackTikEmployee(
            jobTitle: $this->get('position'),
            password:$this->get('password'),
            gender:$this->get('sex'),
            birthday:$this->get('day_of_birth'),
            firstName:$this->get('name'),
            lastName:$this->get('surname'),
            primaryPhone:$this->get('phone_number'),
            email:$this->get('email')
        );
    }
}