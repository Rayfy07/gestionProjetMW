<?php

namespace App\validators;

use App\{
    class\Project,
    repository\CustomerRepository,
    repository\HostRepository
};

class ProjectValidation
{
    public static function isValid(Project $project): bool
    {
        function verifyString(string $input): string
        {
            $input = htmlspecialchars($input);
            $input = stripcslashes($input);
            $input = trim($input);
            return $input;
        }

        if (
            !empty(verifyString($project->getName()))
            && !empty($project->getHost())
            && !empty($project->getCustomer())
            && is_numeric($project->getHost())
            && is_numeric($project->getCustomer())
            && HostRepository::hostExist($project->getHost())
            && CustomerRepository::customerExist($project->getCustomer())
        ) {
            $projet->setName(verifyString($projet->getName()));
            $projet->setCode(str_replace(
                " ",
                "_",
                strtoupper("PROJECT_".verifyString($projet->getCode()))
            ));
            $projet->setLastPassFolder(verifyString($projet->getLastPassFolder()));
            $projet->setLinkMockUps(verifyString($projet->getLinkMockUps()));
            $projet->setManagedServer(verifyString($projet->getManagedServer()));
            $projet->setNotes(verifyString($projet->getNotes()));
            $projet->setHost($projet->getHost());
            $projet->setCustomer($projet->getCustomer());
            return true;
        } else {
            return false;
        }
    }
}