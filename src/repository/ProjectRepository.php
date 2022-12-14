<?php

namespace App\repository;

use App\
{
    class\Project,
    class\Customer,
    class\Host,
    repository\CustomerRepository,
    repository\HostRepository,
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

                if($project->getManagedServer()) {
                    $managedServer = 1;
                } else {
                    $managedServer = 0;
                }

                $insert->execute(array(
                        $project->getName(), 
                        $project->getCode(),
                        $project->getLastPassFolder(),
                        $project->getLinkMockUps(),
                        $managedServer,
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
                    WHERE id = ?"
                );

                if($project->getManagedServer()) {
                    $managedServer = 1;
                } else {
                    $managedServer = 0;
                }
                
                $update->execute(array(
                        $project->getName(), 
                        $project->getCode(),
                        $project->getLastPassFolder(),
                        $project->getLinkMockUps(),
                        $managedServer,
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
                //?? remplacer quand CRUD environnement sera fait
                $deleteEnv = $database->prepare(
                    "DELETE FROM environment WHERE project_id = ?"
                );
                $deleteEnv->execute(array($project->getId()));

                $delete = $database->prepare(
                    "DELETE FROM project WHERE id = ?"
                );
                $delete->execute(array($project->getId()));


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
                    $project = new Project(
                        $rowSelect['id'],
                        $rowSelect['name'],
                        $rowSelect['code'],
                        $rowSelect['lastpass_folder'],
                        $rowSelect['link_mock_ups'],
                        $rowSelect['managed_server'],
                        $rowSelect['notes'],
                        HostRepository::selectById($rowSelect['host_id']),
                        CustomerRepository::selectById($rowSelect['customer_id'])
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
                    $project = new Project(
                        $rowSelect['id'],
                        $rowSelect['name'],
                        $rowSelect['code'],
                        $rowSelect['lastpass_folder'],
                        $rowSelect['link_mock_ups'],
                        $rowSelect['managed_server'],
                        $rowSelect['notes'],
                        HostRepository::selectById($rowSelect['host_id']),
                        CustomerRepository::selectById($rowSelect['customer_id'])
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