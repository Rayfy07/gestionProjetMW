<?php

namespace App\validators;

use App\class\Project;

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

        //A COMPLETER AVEC TEST

        if (
            !empty(verifyString($project->getName()))
            && !empty(verifyInt($project->getHost()))
            && !empty(verifyInt($project->getCustomer()))
        ) {
            $projet->setName(verifyString($projet->getName()));
            $projet->setCode(str_replace(
                " ",
                "_",
                strtoupper("CUST_".verifyString($projet->getCode()))
            ));
            $projet->setLastPassFolder(verifyString($projet->getLastPassFolder()));
            $projet->setLinkMockUps(verifyString($projet->getLinkMockUps()));
            $projet->setManagedServer(verifyString($projet->getManagedServer()));
            $projet->setNotes(verifyString($projet->getNotes()));
            $projet->setHost(verifyInt($projet->getHost()));
            $projet->setCustomer(verifyInt($projet->getCustomer()));
            return true;
        } else {
            return false;
        }
    }
}