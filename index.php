<?php

require_once __DIR__."/require/navbar.php";

require_once __DIR__."/vendor/autoload.php";

use App\
{
    class\Host,
    class\Customer,
    class\Contact,
    class\Project,
    class\Environment,
    connection\DataBaseConnection
};

$database = DataBaseConnection::connect();


$host1 = new Host(1, "code", "name", "sdlgvbldw!kemqbj:wdmqfl");
$host2 = new Host(2, "code", "name", "sdlgvbldw!kemqbj:wdmqfl");

$customer1 = new Customer(1, "code", "name", "noteu");
$customer2 = new Customer(2, "code", "name", "noteu");

$contact1 = new Contact(1, "@","phon","role", $host1, $customer1);

$project1 = new Project(
    1,
    "project",
    "clac",
    "pass",
    "mook",
    true,
    "noteu",
    $host2,
    $customer1
);

$environment1 = new Environment(
    1,
    "name",
    "link",
    "adresseIp",
    23,
    "sshuser",
    "myadmin",
    true,
    $project1
);

$database = DataBaseConnection::disconnect();
?>
    
<?php require_once __DIR__."/require/footer.php"; ?>