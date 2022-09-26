<?php

    class Host
    {
        public function __construct(private int $id, private string $code, private string $name, private string $notes)
        {

        }

        public function getId(): int
        {
            return $this->id;
        }

        public function setId(int $nouvId): void
        {
            $this->id = $nouvId;
        }

        public function getCode(): int
        {
            return $this->code;
        }

        public function setCode(int $nouvCode): void
        {
            $this->code = $nouvCode;
        }

        public function getName(): int
        {
            return $this->name;
        }

        public function setName(int $nouvName): void
        {
            $this->name = $nouvName;
        }

        public function getNotes(): int
        {
            return $this->notes;
        }

        public function setNotes(int $nouvNotes): void
        {
            $this->notes = $nouvNotes;
        }
    }

?>