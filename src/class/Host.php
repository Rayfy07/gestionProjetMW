<?php

namespace App\class;

use App\traits\IdTrait, App\traits\NameTrait, App\traits\CodeNotesTrait;
use App\interfaces\IdInterface, App\interfaces\NameInterface, 
App\interfaces\CodeNotesInterface;

class Host implements IdInterface, NameInterface, CodeNotesInterface
{
    use IdTrait, NameTrait, CodeNotesTrait;

    public function __construct(int $id, string $code, string $name, string $notes)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->notes = $notes;
    }
}

?>
