<?php 

//Destruction de la session
session_destroy();

session_start();
session_regenerate_id();

addFlash("Vous êtes déconnecté");

//Redirection
header("location:index.php?page=home");