<?php
if(!isset ($_SESSION['User']) == true)
{
    header('location:../index.php');
    exit();
}


