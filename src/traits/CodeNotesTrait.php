<?php

namespace App\traits;

trait CodeNotesTrait
{
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

?>