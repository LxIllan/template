<?php

    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }        
    
    require_once 'template.php';    

    head('Blank');
    body(['Blank']);        
?>

    

<?php 
    footer();
?>