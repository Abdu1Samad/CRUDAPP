    <?php
// Create the database in php 

    $server = "localhost";
    $username = "root";
    $password = "";
    $Database = "CRUDAPP";

    $connection = mysqli_connect($server,$username,$password,$Database);
    
    // if($connection){
    //   echo "Connection succesfull";
    // }
    // else{
    //   echo "connection failed";
    // }

    ?> 