<?php
    require_once __DIR__."/Host.php";
    require_once __DIR__."/Customer.php";
    require_once __DIR__."/Contact.php";
    require_once __DIR__."/Project.php";
    require_once __DIR__."/Environment.php";

    $host1 = new Host(1,"code","name","sdlgvbldw!kemqbj:wdmqfl");
    $host2 = new Host(2,"code","name","sdlgvbldw!kemqbj:wdmqfl");
    $customer1 = new Customer(1,"code","name","noteu");
    $customer2 = new Customer(2,"code","name","noteu");
    $contact1 = new Contact(1,"@","phon","role",$host1,$customer1);
    $project1 = new Project(1,"name","code","pass","mook",true,"noteuuu",$host1,$customer1);
    $environment1 = new Environment(1,"name","link","adresseIp",23,"sshuser","myadmin",true,$project1);

?>
