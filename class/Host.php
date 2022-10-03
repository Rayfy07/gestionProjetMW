<?php

require_once __DIR__."/Trait.php";

class Host implements EstIdInterface
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

?>
