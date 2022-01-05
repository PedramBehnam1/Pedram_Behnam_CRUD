<?php

namespace CRUD\Helper;
use Pedram_Behnam_CRUD\Controller\PersonController;
use Pedram_Behnam_CRUD\Helper\DBConnector;
class PersonHelper extends DBConnector
{



    public function insert($person , $tableName , $col):bool
    {   
        try {
            $this->connect();
        } catch (Exeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        $query = "INSERT INTO $tableName(";
        for ($i=0; $i <sizeof($col) ; $i++) { 
            
            if ($i ==0) {
                $query=".$col[i],.";
            }elseif ($i == sizeof($col)-1) {
                $query="$col[i]) VALUES ('$person->getFirstName()', '$person->getLastName()', '$person->getUsername()')";
            }else {
                $query="$col[i],.";
            }
        }
        
        $result = $this->insert($query);
        return $result;
    }   

    public function fetch(int $id,$tableName ):bool
    {
        try {
            $this->connect();
        } catch (Exeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        $query = "SELECT * FROM $tableName WHERE id == $id";
        $result = $this->get($query);
        return $result;
    }

    public function fetchAll($tableName):bool
    {

        try {
            $this->connect();
        } catch (Exeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $query = "SELECT * FROM $tableName";
        $result = $this->get($query);
        return $result;
    }

    public function update($person,$tableName,):bool
    {
        try {
            $this->connect();
        } catch (Exeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }
       
            $query = "UPDATE $tableName SET firstName='$person->getFirstName()',lastName='$person->getLastName()',userName='$person->getUsername() ' WHERE id=$person->getId()";
        
       
        $result = $this->update($query);
        return $result;
    }

    public function delete($person,$tableName):bool
    {
        try {
            $this->connect();
        } catch (Exeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }
       
        $query = "DELETE FROM $tableName WHERE id=$person->getId()";
        $result = $this->delete($query);
        return $result;
    }

}