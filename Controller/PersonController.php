<?php
namespace Controller;

use Exception;
use Model\Actions;
use Helper\PersonHelper;
use Model\Person as person;
class PersonController
{
 public function switcher($method,$request, $connection){
  switch ($method)
   {
    case Actions::CREATE:
      $this->createAction($request, $connection);
      break;
    case Actions::UPDATE:
      $this->updateAction($request, $connection);
      break;
    case Actions::READ:
      $this->readAction($request,$connection);
      break;
    case Actions::READ_ALL:
      $this->readAllAction($request, $connection);
      break;
    case Actions::DELETE:
      $this->deleteAction($request, $connection);
      break;
    default:
      break;
   }
 }



 public function createAction($request ,$connection)
 {
   $helper = new PersonHelper();
   $person = new person();
   
   $person->setFirstName($request["firstName"]);
   $person->setLastName($request["lastName"]);
   $person->setUsername($request["userName"]);
   try {
    $helper->insert($person ,"person",$connection);
   } catch (Exception $e) {
    echo $e->getMessage();
   }
  }

  public function updateAction($request,$connection)
  {
   $helper = new PersonHelper();
   $person = new Person();

   $person->setId($request["id"]);
   $person->setFirstName($request["firstName"]);
   $person->setLastName($request["lastName"]);
   $person->setUsername($request["userName"]);
   try {
    $helper->update($person ,"person",$connection );
   } catch (Exception $e) {
    echo $e->getMessage();
   }
  }

  public function readAction($request ,$connection){
    $helper = new PersonHelper();

    $person = new Person();
    $person->setId($request["id"]);

    try {
      $helper->fetch($person->getId() ,"person",$connection );
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function readAllAction($connection)
  {
    $helper = new PersonHelper();
    try {
      $helper->fetchAll("person",$connection);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function deleteAction($request,$connection)
  {
    $helper = new PersonHelper();

    $person = new Person();
    $person->setId($request["id"]);
    try {
      $helper->delete($person,"person",$connection);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}






?>