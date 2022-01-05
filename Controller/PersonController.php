<?php
namespace Pedram_Behnam_CRUD\Controller;

use Pedram_Behnam_CRUD\Model\Actions;
use Pedram_Behnam_CRUD\Model\Person;
use Pedram_Behnam_CRUD\Helper\PersonHelper;

class PersonController
{
 public function switcher($method,$request, $tableName,$host, $username, $password, $db, $port = NULL){
  switch ($method)
   {
    case Actions::CREATE:
      $this->createAction($request, $tableName,$host, $username, $password, $db, $port = NULL);
      break;
    case Actions::UPDATE:
      $this->updateAction($request, $tableName,$host, $username, $password, $db, $port = NULL);
      break;
    case Actions::READ:
      $this->readAction($request, $tableName,$host, $username, $password, $db, $port = NULL);
      break;
    case Actions::READ_ALL:
      $this->readAllAction($request, $tableName,$host, $username, $password, $db, $port = NULL);
      break;
    case Actions::DELETE:
      $this->deleteAction($request, $tableName,$host, $username, $password, $db, $port = NULL);
      break;
    default:
      break;
   }
 }



 public function createAction($request , $tableName,$host, $username, $password, $db, $port = NULL)
 {
   $helper = new PersonHelper($host, $username, $password, $db, $port = NULL);
   $person = new Person();
   $col = ['firstName','lastName','userName'];
   $person->setFirstName($request["firstName"]);
   $person->setLastName($request["lastName"]);
   $person->setUsername($request["userName"]);
   if($helper->insert($person ,$tableName , $col )){
     echo "success";
   }else
     echo "error";
  }

  public function updateAction($request,$tableName,$host, $username, $password, $db,$port = NULL)
  {
   $helper = new PersonHelper($host, $username, $password, $db,$port = NULL);
   $person = new Person();

   $person->setId($request["id"]);
   $person->setFirstName($request["firstName"]);
   $person->setLastName($request["lastName"]);
   $person->setUsername($request["userName"]);

   if($helper->update($person ,$tableName )){
    echo "Record updated successfully";
  }else
    echo "Error updating record: " . $helper->_mysqli->error;

    
  }

  public function readAction($request ,$tableName,$host, $username, $password, $db, $port = NULL){
    $helper = new PersonHelper($host, $username, $password, $db, $port = NULL);

    $person = new Person();
    $person->setId($request["id"]);

    if(!$helper->fetch($person->getId() ,$tableName )){
      echo "rows: 0";
    }
  }

  public function readAllAction($request,$tableName,$host, $username, $password, $db, $port = NULL)
  {
    $helper = new PersonHelper($host, $username, $password, $db, $port = NULL);
    if(!$helper->fetchAll($tableName)){
      echo "rows: 0";
    }
  }

  public function deleteAction($request,$tableName,$host, $username, $password, $db, $port = NULL)
  {
    $helper = new PersonHelper($host, $username, $password, $db, $port = NULL);

    $person = new Person();
    $person->setId($request["id"]);

    if($helper->delete($person,$tableName)){
      echo "Record deleted successfully";
    }else {
      echo "Error deleting  record: " . $helper->_mysqli->error;
    }
  }
}






?>