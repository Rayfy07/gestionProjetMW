<?php 

    require_once __DIR__."/Customer.php";
    require_once __DIR__."/Host.php";

    class Contact 
    {
        public function __construct(private int $id, private string $email, private string $phoneNumber, private string $role, private Host $host, private Customer $customer)
        {
            
        }

        public function getId(): int
        {
            return $this->id;
        }
        public function setId(string $newId): void
        {
            $this->id = $newId;
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

        public function getHost(): Host
        {
            return $this->host;
        }
        public function setHost(Host $newHost): void
        {
            $this->host = $newHost;
        }

        public function getCustomer(): Customer
        {
            return $this->customer;
        }
        public function setCustomer(Customer $newCustomer): void
        {
            $this->customer = $newCustomer;
        }
    }