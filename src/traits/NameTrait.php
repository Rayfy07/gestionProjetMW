<?php

namespace App\traits;

trait NameTrait
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $newName): void
    {
        $this->name = $newName;
    }
}