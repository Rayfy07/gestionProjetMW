<?php

namespace App\class;

use App\
{
    class\Project,
    traits\IdTrait,
    traits\NameTrait,
    interfaces\IdInterface,
    interfaces\NameInterface
};

class Environment implements
    IdInterface,
    NameInterface
{
    use IdTrait;
    use NameTrait;

    public function __construct(int $id, string $name, private string $link, private string $ipAddress, private int $sshPort, private string $sshUserName, private string $phpMyAdminLink, private bool $ipRestriction, private Project $project)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getLink(): string
    {
        return $this->link;
    }
    public function setLink(string $newLink): void
    {
        $this->link = $newLink;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }
    public function setIpAddress(string $newIpAddress): void
    {
        $this->ipAddress = $newIpAddress;
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