<?php

// connect to database
$conn = mysqli_connect('localhost', 'sumit', 'test123', 'ninja_pizza', '3307');

// check connection 
if (!$conn) {
    echo 'connection error: ' . mysqli_connect_error();
}
