<?php

namespace App\class;

use App\class\Host;
use App\class\Customer;

use App\traits\IdTrait, App\traits\NameTrait, App\traits\CodeNotesTrait, App\traits\HostCustomerTrait;
use App\interfaces\IdInterface, App\interfaces\NameInterface, App\interfaces\CodeNotesInterface, App\interfaces\HostCustomerInterface;

class Project implements IdInterface, NameInterface, CodeNotesInterface, HostCustomerInterface
{
    use IdTrait;
    use NameTrait;
    use CodeNotesTrait;
    use HostCustomerTrait;

    public function __construct(int $id, string $name, string $code, private string $lastPassFolder, private string $linkMockUps, private bool $managedServer, string $notes, Host $host, Customer $customer)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->notes = $notes;
        $this->host = $host;
        $this->customer = $customer;
    }

    public function getLastPassFolder(): string
    {
        return $this->lastPassFolder;
    }
    public function setLastPassFolder(string $newLastPassFolder): void
    {
        $this->lastPassFolder = $newLastPassFolder;
    }
    
    public function getLinkMockUps(): string
    {
        return $this->linkMockUps;
    }
    public function setLinkMockUps(string $newLinkMockUps): void
    {
        $this->linkMockUps = $newLinkMockUps;
    }

    public function getManagedServer(): bool
    {
        return $this->managedServer;
    }
    public function setManagedServer(bool $newManagedServer): void
    {
        $this->managedServer = $newManagedServer;
    }
}
?>
