<?php

namespace App\repository;

use App\
{
    class\Contact,
    class\Customer,
    class\Host,
    connection\DataBaseConnection
};

class CustomerRepository
{
    public static function insert(Contact $contact): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $insert = $database->prepare(
                    "INSERT INTO contact(
                        email,
                        phone_number,
                        role,
                        host_id,
                        customer_id
                    ) 
                    VALUES (?,?,?,?,?)"
                );
                $insert->execute(array(
                    $contact->getEmail(),
                    $contact->getPhoneNumber(),
                    $contact->getRole(),
                    $contact->getHost()->getId(),
                    $contact->getCustomer()->getId()
                ));

                $select = $database->prepare(
                    "SELECT LAST_INSERT_ID() as id FROM contact"
                );
                $select->execute();
                $newId = $select->fetch();

                $contact->setId($newId['id']);

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function update(Contact $contact): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $update = $database->prepare(
                    "UPDATE contact SET 
                        email = ?,
                        phone_number = ?,
                        role = ?,
                        host_id = ?,
                        customer_id = ?
                    WHERE id = ?"
                );

                $update->execute(array(
                    $contact->getEmail(),
                    $contact->getPhoneNumber(),
                    $contact->getRole(),
                    $contact->getHost()->getId(),
                    $contact->getCustomer()->getId() 
                ));

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch(\Exception) {
            return false;
        }
    }

    public static function delete(Contact $contact): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $delete = $database->prepare(
                    "DELETE FROM contact WHERE id = ?"
                );
                $delete->execute(array($contact->getId()));

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function selectByHostId(int $int): ?array
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM contact WHERE host_id = ?"
                );
                $select->execute(array($int));

                $contacts = array();

                while ($rowSelect = $select->fetch()) {
                    $contact = new Contact(
                        $rowSelect['id'],
                        $rowSelect['email'],
                        $rowSelect['phone_number'],
                        $rowSelect['role'],
                        $rowSelect['host_id'],
                        $rowSelect['customer_id']
                    );
                    $contacts.add($contact);
                }
                $database = DataBaseConnection::disconnect();
                return $contacts;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function selectByCustomerId(int $int): ?array
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM contact WHERE customer_id = ?"
                );
                $select->execute(array($int));

                $contacts = array();

                while ($rowSelect = $select->fetch()) {
                    $contact = new Contact(
                        $rowSelect['id'],
                        $rowSelect['email'],
                        $rowSelect['phone_number'],
                        $rowSelect['role'],
                        $rowSelect['host_id'],
                        $rowSelect['customer_id']
                    );
                    $contacts.add($contact);
                }
                $database = DataBaseConnection::disconnect();
                return $contacts;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function count(): ?int
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT COUNT(*) as total FROM contact"
                );
                $select->execute();
                $rowSelect = $select->fetch();
                $count = $rowSelect['total'];
                $database = DataBaseConnection::disconnect();
                return $count;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function countByHostId(int $id): ?int
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT COUNT(*) as total 
                    FROM contact 
                    WHERE host_id = ?"
                );
                $select->execute(array($id));
                $rowSelect = $select->fetch();
                $count = $rowSelect['total'];
                $database = DataBaseConnection::disconnect();
                return $count;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function countByCustomerId(int $id): ?int
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT COUNT(*) as total 
                    FROM contact 
                    WHERE customer_id = ?"
                );
                $select->execute(array($id));
                $rowSelect = $select->fetch();
                $count = $rowSelect['total'];
                $database = DataBaseConnection::disconnect();
                return $count;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }
}