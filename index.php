<?php
include ('Helper/DBConnector.php');
use Helper\DBConnector as DB;

include ('Helper/PersonHelper.php');
use Helper\PersonHelper as helper;

include ('Model/Person.php');
use Model\Person as person;

include ('Controller/PersonController.php');
use Controller\PersonController as controller;

$host = "localhost";
$username = "Pedram";
$password = "Pedram.Behnam1";
$db = "person";

$conection = new DB($host, $username, $password, $db);

$conection->connect();

$helper1 = new helper();

$person1 = new person();
/*
$person1->setId(1);
$helper1->delete($person1,"person",$conection->getMysqli());

$person1->setFirstName("Parnia");
$person1->setLastName("Behnam");
$person1->setUsername("ped");
$person1->setId(1);
$helper1->update1($person1,"person",$conection->getMysqli());


$helper1->insert($person1,"person",$conection->getMysqli());

try {
 $helper1->fetchAll("person",$conection->getMysqli());
} catch (Exception $e) {
 echo $e->getMessage();
}
*/
var_dump($_SERVER);

$host1 = "localhost";

if ($_SERVER['REQUEST_URI'] === '/person') {
 $controller = new controller();
 $controller->switcher($_SERVER['REQUEST_METHOD'],$_REQUEST,$conection->getMysqli()); 
}else {
 echo "wrong recource";
}