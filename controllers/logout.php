<?php 

//Destruction de la session
session_destroy();

session_start();
session_regenerate_id();

//Redirection
header("location:index.php?page=home");