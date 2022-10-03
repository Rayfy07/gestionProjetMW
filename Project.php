<?php

require_once __DIR__."/Trait.php";

class Project implements EstIdInterface
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
