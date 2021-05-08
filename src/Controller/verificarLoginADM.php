<?php
if(($_SESSION['Tipo']) != 1)
{
    header('location:../index.php');
    exit();
}
