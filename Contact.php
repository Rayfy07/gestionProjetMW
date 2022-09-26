<?php 

    require __DIR__."/Customer.php";
    require __DIR__."/Host.php";

    class Contact 
    {
        public function __construct(private int $id, private string $email, private string $phoneNumber, private string $role, Host $host, Customer $customer)
        {
            
        }

        public function getId(): int
        {
            return $this->id;
        }
        public function setId(string $id): void
        {
            $this->id = $id;
        }

        public function getEmail(): string
        {
            return $this->email;
        }
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function getPhoneNumber(): string
        {
            return $this->phoneNumber;
        }
        public function setPhoneNumber(string $phoneNumber): void
        {
            $this->phoneNumber = $phoneNumber;
        }

        public function getRole(): string
        {
            return $this->role;
        }
        public function setRole(string $role): void
        {
            $this->role = $role;
        }

        public function getHost(): Hote
        {
            return $this->hote;
        }
        public function setHost(Hote $hote): void
        {
            $this->hote = $hote;
        }

        public function getCustomer(): Customer
        {
            return $this->customer;
        }
        public function setCustomer(Customer $customer): void
        {
            $this->customer = $customer;
        }
    }