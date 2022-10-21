<?php

namespace App\interfaces;

interface IdInterface
{
    public function getId(): int;
    public function setId(int $newId): void;
}

?>