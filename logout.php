<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 2018-12-15
 * Time: 19:54
 */
session_start();

if(session_destroy()) {
    header("Location: /index.php");
}
?>