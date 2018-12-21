<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 2018-12-15
 * Time: 19:41
 */

   //La uso nei file che richiamano(includono) questo php
//   function controllFolderPermission(){
//       $url = dirname(__FILE__);
//       $array = explode('/',$url);
//       $count = count($array);
//       $folder = $array[$count-2];
//       if ($folder!=$_SESSION['role']){
//           header("location:/index.html");
//       }
//   }


   include('config.php');
   session_start();

//   echo 'La variabile login_user della sessione è: '.$_SESSION['login_user'];
   $user_check = $_SESSION['login_user'];
   $role_check = $_SESSION['role'];

   $ses_sql = mysqli_query($conn,"select USERNAME from LOGIN where USERNAME = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['USERNAME'];

   if(!isset($_SESSION['login_user'])){
      header("location:/index.html");
   }
?>
