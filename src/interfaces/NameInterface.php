<?php

namespace App\interfaces;

interface NameInterface
{
    public function getName(): string;
    public function setName(string $newName): void;
}

?>