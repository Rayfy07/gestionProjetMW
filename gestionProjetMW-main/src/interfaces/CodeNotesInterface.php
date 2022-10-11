<?php

namespace App\interfaces;

interface CodeNotesInterface
{
    public function getCode(): string;
    public function setCode(string $code): void;
}

?>