<?php

namespace App\class;

use App\
{
    traits\IdTrait,
    traits\NameTrait,
    traits\CodeNotesTrait,
    interfaces\IdInterface,
    interfaces\NameInterface,
    interfaces\CodeNotesInterface
};

class Customer implements
    IdInterface,
    NameInterface,
    CodeNotesInterface
{
    use IdTrait;
    use NameTrait; 
    use CodeNotesTrait;

    public function __construct(int $id, string $code, string $name, string $notes)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->notes = $notes;
    }
}