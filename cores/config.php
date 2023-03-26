<?php 

    $sys_link="http://localhost/minor_project/Minor-Project-2/";

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'virass';

    $link = mysqli_connect($hostname,$username,$password,$database);

    if (!$link) {
        die("Could not connect to database.");
    }
    $sys_session = 'virass_session';
    ?>