<?php

namespace App\repository;

use App\
{
    class\Project,
    class\Customer,
    class\Host,
    connection\DataBaseConnection
};

class ProjectRepository
{
    public static function insert(Project $project): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $insert = $database->prepare(
                    "INSERT INTO project(
                        name, 
                        code, 
                        lastpass_folder, 
                        link_mock_ups, 
                        managed_server, 
                        notes, 
                        host_id, 
                        customer_id
                    )
                    VALUES (?,?,?,?,?,?,?,?)"
                );
                $insert->execute(array(
                        $project->getName(), 
                        $project->getCode(),
                        $project->getLastPassFolder(),
                        $project->getLinkMockUps(),
                        $project->getManagedServer(),
                        $project->getNotes(),
                        $project->getHost()->getId(),
                        $project->getCustomer()->getId()
                ));

                $select = $database->prepare(
                    "SELECT LAST_INSERT_ID() as id FROM project"
                );
                $select->execute();
                $newId = $select->fetch();

                $project->setId($newId['id']);

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function update(Project $project): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $update = $database->prepare(
                    "UPDATE project SET
                        name = ?,
                        code = ?,
                        lastpass_folder = ?,
                        link_mock_ups = ?,
                        managed_server = ?,
                        notes = ?,
                        host_id = ?,
                        customer_id = ?
                    WHERE id=?"
                );
                $update->execute(array(
                        $project->getName(), 
                        $project->getCode(),
                        $project->getLastPassFolder(),
                        $project->getLinkMockUps(),
                        $project->getManagedServer(),
                        $project->getNotes(),
                        $project->getHost()->getId(),
                        $project->getCustomer()->getId(),
                        $project->getId()
                ));

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function delete(Project $project): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $update = $database->prepare(
                    "DELETE FROM project WHERE id=?"
                );
                $update->execute(array($project->getId()));


                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function selectAll(): ?array
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM project"
                );
                $select->execute();
                $projects = array();
                while ($rowSelect = $select->fetch()) {
                    $selectHostName = $database->prepare(
                        "SELECT name FROM host WHERE id = ?"
                    );
                    $selectHostName->execute(array($rowSelect['host_id']));
                    $rowSelectHostName = $selectHostName->fetch();

                    $selectCustomerName = $database->prepare(
                        "SELECT name FROM customer WHERE id = ?"
                    );
                    $selectCustomerName->execute(array($rowSelect['customer_id']));
                    $rowSelectCustomerName = $selectHostName->fetch();

                    $project = new Project(
                        $rowSelect['id'],
                        $rowSelect['name'],
                        $rowSelect['code'],
                        $rowSelect['lastpass_folder'],
                        $rowSelect['link_mock_ups'],
                        $rowSelect['managed_server'],
                        $rowSelect['notes'],
                        $rowSelectHostName['name'],
                        $rowSelectCustomerName['name']
                    );
                    array_push(
                        $projects,
                        $project
                    );
                }

                $database = DataBaseConnection::disconnect();
                return $projects;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function selectById(int $int): ?Project
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM project WHERE id = ?"
                );
                $select->execute(array($int));

                if ($rowSelect = $select->fetch()) {
                    $selectHostName = $database->prepare(
                        "SELECT name FROM host WHERE id = ?"
                    );
                    $selectHostName->execute(array($rowSelect['host_id']));
                    $rowSelectHostName = $selectHostName->fetch();

                    $selectCustomerName = $database->prepare(
                        "SELECT name FROM customer WHERE id = ?"
                    );
                    $selectCustomerName->execute(array($rowSelect['customer_id']));
                    $rowSelectCustomerName = $selectHostName->fetch();

                    $project = new Project(
                        $rowSelect['id'],
                        $rowSelect['name'],
                        $rowSelect['code'],
                        $rowSelect['lastpass_folder'],
                        $rowSelect['link_mock_ups'],
                        $rowSelect['managed_server'],
                        $rowSelect['notes'],
                        $rowSelectHostName['name'],
                        $rowSelectCustomerName['name']
                    );

                    $database = DataBaseConnection::disconnect();
                    return $project;
                } else {
                    return null;
                }
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
                    "SELECT COUNT(*) as total FROM project"
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
}