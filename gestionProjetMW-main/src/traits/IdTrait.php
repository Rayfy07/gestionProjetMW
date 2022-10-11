<?php

namespace App\traits;

trait IdTrait
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $newId): void
    {
        $this->id = $newId;
    }
}

?>