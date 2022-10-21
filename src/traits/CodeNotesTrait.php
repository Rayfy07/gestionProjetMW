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
    public function setCode(string $newCode): void
    {
        $this->code = $newCode;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
    public function setNotes(string $newNotes): void
    {
        $this->notes = $newNotes;
    }
}