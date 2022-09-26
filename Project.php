<?php

    require_once __DIR__."/Custommer.php";
    require_once __DIR__."/Host.php";

    class Project
    {
        public function __construct(private int $id, private string $code, private string $lastPassFolder, private string $linkMockUps, private bool $managedServer, private string $notes, private Host $hostId, private Customer $customerId)
        {

        }

        public function getId(): int
        {
            return $this->id;
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

        public function getHostId(): Host
        {
            return $this->hostId;
        }

        public function getCustomerId(): Customer
        {
            return $this->customerId;
        }

        public function setId(int $newId): void
        {
            $this->id = $newId;
        }

        public function setCode(string $newCode): void
        {
            $this->code = $newCode
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
        public function setHostId(Host $newHostId): void
        {
            $this->hostId = $hostId;
        }
        public function setCustomerId(Customer $newCustomerId): void
        {
            $this->customerId = $newCustomerId;
        }
    }
?>