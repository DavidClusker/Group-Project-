<?php
function connect() {
    $con =mysqli_connect("localhost", "root", "", "giftbarks");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        return $con;
    }
}

function renderContent($con) {
    $sql = "SELECT username FROM users";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) 
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            echo $row["topic"]. "<br>";
        }
    } else {
         echo "error";
    }
