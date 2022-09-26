<?php

    require_once __DIR__."/Customer.php";
    require_once __DIR__."/Host.php";

    class Project
    {
        public function __construct(private int $id, private string $name, private string $code, private string $lastPassFolder, private string $linkMockUps, private bool $managedServer, private string $notes, private Host $host, private Customer $customer)
        {

        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getCode(): string
        {
            return $this->code;
        }

        public function getLastPassFolder(): string
        {
            return $this->lastPassFolder;
        }
        
        public function getLinkMockUps(): string
        {
            return $this->linkMockUps;
        }

        public function getManagedServer(): bool
        {
            return $this->managedServer;
        }

        public function getNotes(): string
        {
            return $this->notes;
        }

        public function getHost(): Host
        {
            return $this->host;
        }

        public function getCustomer(): Customer
        {
            return $this->customer;
        }

        public function setId(int $newId): void
        {
            $this->id = $newId;
        }

        public function setName(string $newName): void
        {
            $this->code = $newName;
        }

        public function setCode(string $newCode): void
        {
            $this->code = $newCode;
        }
        
        public function setLastPassFolder(string $newLastPassFolder): void
        {
            $this->lastPassFolder = $newLastPassFolder;
        }
        
        public function setLinkMockUps(string $newLinkMockUps): void
        {
            $this->linkMockUps = $newLinkMockUps;
        }
        public function setManagedServer(bool $newManagedServer): void
        {
            $this->managedServer = $newManagedServer;
        }
        public function setNotes(string $newNotes)
        {
            $this->notes = $newNotes;
        }
        public function setHost(Host $newHost): void
        {
            $this->host = $newHost;
        }
        public function setCustomer(Customer $newCustomer): void
        {
            $this->customer = $newCustomer;
        }
    }
?>
