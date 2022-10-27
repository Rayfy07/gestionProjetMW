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
            && is_numeric($project->getHost()->getId())
            && is_numeric($project->getCustomer()->getId())
            && HostRepository::hostExist($project->getHost())
            && CustomerRepository::customerExist($project->getCustomer())
        ) {
            $project->setName(verifyString($project->getName()));
            $project->setCode(str_replace(
                " ",
                "_",
                strtoupper("PROJECT_".verifyString($project->getCode()))
            ));
            $project->setLastPassFolder(verifyString($project->getLastPassFolder()));
            $project->setLinkMockUps(verifyString($project->getLinkMockUps()));
            $project->setManagedServer(verifyString($project->getManagedServer()));
            $project->setNotes(verifyString($project->getNotes()));
            $project->setHost($project->getHost());
            $project->setCustomer($project->getCustomer());
            return true;
        } else {
            return false;
        }
    }
}