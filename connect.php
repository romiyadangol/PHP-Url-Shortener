<?php
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $database = "url_shortner";

    $conn = mysqli_connect($hostname, $username, $password, $database);  
    echo "Connection Established";