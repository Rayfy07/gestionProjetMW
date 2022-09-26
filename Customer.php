<?php

    class Customer 
    {
        private int $id;
        private string $code;
        private string $name;
        private string $notes;

        public function getId(): int
        {
            return $this->id;
        }
        public function setId(string $newId): void
        {
            $this->id = $newId;
        }

        public function getCode(): string
        {
            return $this->code;
        }
        public function setCode(string $newCode): void
        {
            $this->code = $newCode;
        }

        public function getName(): string
        {
            return $this->name;
        }
        public function setName(string $newName): void
        {
            $this->name = $newName;
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
?>
