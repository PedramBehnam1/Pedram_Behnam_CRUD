<?php

namespace Helper;

use Exception;

use Model\Person;
use Pedram_Behnam_CRUD\Controller\PersonController;



class PersonHelper 
{



    public function insert($person , $tableName , $connection):void
    {   
        $firstName=$person->getFirstName();
        $lastName = $person->getLastName();
        $username = $person->getUsername();
        $query = "INSERT INTO $tableName(FirstName , LastName, UserName)
        VALUES ('$firstName','$lastName' ,'$username') " ;
        $connection = $connection->query($query);
        echo "<br />";
        if ( $connection=== TRUE) {
            echo "New record created successfully";
        } else {
            throw new Exception("Error: " . $query . "<br>" . $connection->error);
        }
        $connection->close();
    }   

    public function fetch(int $id,$tableName,$connection ):void
    {
        $query = "SELECT * FROM $tableName WHERE id = $id";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr> <td>".$row["id"]."</td> <td>".$row["FirstName"]." ".$row["LastName"]."</td> </tr>";
            }
            echo "</table>";
        }else {
        throw new Exception("rows: 0");
        }
        $connection->close();
    }

    public function fetchAll($tableName , $connection):void
    {

        echo "<br />";
        $query = "SELECT * FROM $tableName";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr> <td>".$row["id"]."</td> <td>".$row["FirstName"]." ".$row["LastName"]."</td> </tr>";
            }
            echo "</table>";
        }else {
        throw new Exception("rows: 0");
        }
        $connection->close();
    }

    public function update($person,$tableName,$connection):void
    {
            $firstName=$person->getFirstName();
            $lastName = $person->getLastName();
            $username = $person->getUsername();
            $id = $person->getId();
            
            $query = "UPDATE $tableName SET firstName='$firstName',lastName='$lastName' ,userName='$username'  WHERE id=$id";
            $result = $connection->query($query);
            echo "<br />";
            if ( $result === TRUE) {
                echo "New record created successfully";
            } else {
                throw new Exception("Error: " . $query . "<br>" . $result->error);
            }
            $connection->close();
    }

    public function delete($person,$tableName,$connection):void
    {
        $id = $person->getId();
       
        $query = "DELETE FROM $tableName WHERE id= $id";
        $result = $connection->query($query);
        echo "<br />";
        if ( $result === TRUE) {
            echo "one record deleted successfully";
        } else {
            throw new Exception("Error: " . $query . "<br>" . $result->error);
        }
        $connection->close();
    }

}