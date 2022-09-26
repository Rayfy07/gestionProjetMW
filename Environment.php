<?php

    require_once __DIR__."/Project.php";

    class environment
    {
        public function __construct(private int $id, private string $name, private string $link, private string $ipAdresse, private int $sshPort, private string $sshUserName, private string $phpMyAdminLink, private bool $ipRestriction, private Project $project)
        {

        }

        public function getId(): int
        {
            return $this->id;
        }

        public function setId(int $newId): void
        {
            $this->id = $newId;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function setName(string $newName): void
        {
            $this->name = $newName;
        }

        public function getLink(): string
        {
            return $this->link;
        }

        public function setLink(string $newLink): void
        {
            $this->link = $newLink;
        }

        public function getIpAdresse(): string
        {
            return $this->ipAdresse;
        }

        public function setIpAdresse(string $newIpAdresse): void
        {
            $this->ipAdresse = $newIpAdresse;
        }

        public function getSshPort(): int
        {
            return $this->sshPort;
        }

        public function setSshPort(int $newSshPort): void
        {
            $this->sshPort = $newSshPort;
        }

        public function getSshUserName(): string
        {
            return $this->sshUserName;
        }

        public function setSshUserName(string $newSshUserName): void
        {
            $this->sshUserName = $newSshUserName;
        }

        public function getPhpMyAdminLink(): string
        {
            return $this->phpMyAdminLink;
        }

        public function setPhpMyAdminLink(string $newPhpMyAdminLink): void
        {
            $this->phpMyAdminLink = $newPhpMyAdminLink;
        }

        public function getIpRestriction(): bool
        {
            return $this->ipRestriction;
        }

        public function setIpRestriction(bool $newIpRestriction): void
        {
            $this->ipRestriction = $newIpRestriction;
        }

        public function getProject(): Project
        {
            return $this->project;
        }

        public function setProject(Project $newProject): void
        {
            $this->project = $newProject;
        }
    }

?>
