<?php 

namespace App\class;

use App\
{
    class\Host,
    class\Customer,
    traits\IdTrait,
    traits\HostCustomerTrait,
    interfaces\IdInterface,
    interfaces\HostCustomerInterface
};

class Contact implements
    IdInterface,
    HostCustomerInterface
{
    use IdTrait;
    use HostCustomerTrait;

    public function __construct(
        int $id,
        private string $email,
        private string $phoneNumber,
        private string $role,
        Host $host,
        Customer $customer
    ) {
        $this->id = $id;
        $this->host = $host;
        $this->customer = $customer;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $newEmail): void
    {
        $this->email = $newEmail;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
    public function setPhoneNumber(string $newPhoneNumber): void
    {
        $this->phoneNumber = $newPhoneNumber;
    }

    public function getRole(): string
    {
        return $this->role;
    }
    public function setRole(string $newRole): void
    {
        $this->role = $newRole;
    }
}