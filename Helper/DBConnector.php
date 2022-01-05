<?php

namespace Pedram_Behnam_CRUD\Helper;

class DBConnector
{
/**
 * Static instance of self
 *
 * @var MysqliDb
 */
protected static $_instance;

 /**
  * MySQLi instance
  *
  * @var mysqli
  */
 protected $_mysqli = NULL;


 /** @var mixed $db */
 private $db;
 private $host;
 private $username;
 private $password;
 private $port;

 public function __construct($host, $username, $password, $db, $port = NULL)
 {
  if ($port == NULL) {
   $this->port = ini_get('mysqli.default_port');
  }

  $this->host = $host;
  $this->username = $username;
  $this->password = $password;
  $this->db = $db;

  

  $this->_mysqli->set_charset('utf8');

  self::$_instance = $this;
 }

 /**
  * @throws \Exception
  * @return void
  */
 public function connect() : void
 {
  $this->_mysqli  = new mysqli($host, $username, $password, $db, $port);

  if ($_mysqli == NULL) {
   throw new Exception("There was a problem connecting to the database");   
  }else{
   $this->_mysqli->set_charset('utf8');
   self::$_instance = $this;
  }

 }

 /**
  * @param string $query
  * @return bool
  */
 
 
 
  public function get(string $query) : bool
 {
  $result = execQuery($query);
  return $result;
  
 }
 
 public function update(string $query) : bool
 {
  
  $result = execQuery($query);
  return $result;
 

 }
 
 
 public function delete(string $query) : bool
 {
  
  $result = execQuery($query);
  return $result;

 }
 
 public function insert(string $query) : bool
 {
  
  $result = execQuery($query);
  return $result;

 }
 
 
  public function execQuery(string $query) : bool
 { 
   $result = false;
    $sql = "";
    $values = explode(" " , $query);
    foreach($values as $value){

      if ($value == "SELECT") {
       $sql = $this->_mysqli->query($query);

       if ($sql->num_rows > 0) {
        while($rows = $sql->fetch_assoc()) {
          for ($i=0; $i <sizeof($rows) ; $i++) { 
           echo "$rows[$i]";
          }
          echo "<br />";
        }
        $result = true;
       } 

      }else if($value == "UPDATE"){
       
       if ($this->_mysqli->query($query) === TRUE) {
        $result = true;
       }

      }else if ($value == "DELETE") {
       if ($this->_mysqli->query($query) === TRUE) {
        $result = true;
       }

      }elseif ($value == "INSERT") {
       if ($this->_mysqli->query($query) === TRUE) {
        $result = true;
       } 
      }
    }
    $this->_mysqli->close();
    return $result;
 }





}
