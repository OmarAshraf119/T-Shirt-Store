<?php
          if(!isset($_SESSION)) 
            { 
                session_start();
                session_unset(); 
                session_destroy(); 
          }     
    include "page1.php";
?>