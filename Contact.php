<?php 

    require_once __DIR__."/Customer.php";
    require_once __DIR__."/Host.php";

    class Contact 
    {
        public function __construct(private int $id, private string $email, private string $phoneNumber, private string $role, Host $hostId, Customer $customerId)
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

        public function getHostId(): Host
        {
            return $this->hostId;
        }
        public function setHostId(Hote $newHost): void
        {
            $this->hostId = $newHost;
        }

        public function getCustomerId(): Customer
        {
            return $this->customerId;
        }
        public function setCustomerId(Customer $newCustomer): void
        {
            $this->customerId = $newCustomer;
        }
    }
