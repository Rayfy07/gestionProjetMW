<?php

namespace App\validators;

use App\{
    class\Contact,
    repository\CustomerRepository,
    repository\HostRepository
};
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

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

        $emailValidator = new EmailValidator();

        if (
            (
                !empty($project->getHost())
                && is_numeric($project->getHost()->getId())
                && HostRepository::hostExist($project->getHost())
            ) XOR (
                !empty($project->getCustomer())
                && is_numeric($project->getCustomer()->getId())
                && CustomerRepository::customerExist($project->getCustomer())
            ) && $emailValidator->isValid($contact->getEmail(), new RFCValidation())
        ) {
            $contact->setEmail(verifyString($contact->getEmail()));
            $contact->setPhoneNumber(verifyString($contact->getPhoneNumber()));
            $contact->setRole(verifyString($contact->getRole()));
            $contact->setHost($contact->getHost());
            $contact->setCustomer($contact->getCustomer());
            return true;
        } else {
            //host et customer renseigné, ou aucun renseigné, ou 1 seul mais prbl dans l'id, ou email pas valide
            return false;
        }
    }
}