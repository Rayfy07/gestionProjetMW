<?php

require_once __DIR__."/Host.php";
require_once __DIR__."/Customer.php";

trait IdTrait {
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(string $newId): void
    {
        $this->id = $newId;
    }
}

trait NameTrait {
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

trait CodeNotesTrait {
    private string $code;
    private string $notes;

    public function getCode(): string
    {
        return $this->code;
    }
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}

trait HostCustomerTrait {
    private Host $host;
    private Customer $customer;

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

interface EstIdInterface
{
    public function getId(): int;
    public function setId(string $newId): void;
}