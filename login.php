<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 2018-12-13
 * Time: 22:36
 */

include ('config.php');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($conn, $_REQUEST['username']);
    $mypassword = mysqli_real_escape_string($conn, $_REQUEST['password']);

    $result = $conn->query("SELECT * FROM LOGIN WHERE USERNAME = '$myusername' AND PASSWORD ='$mypassword';");

    if ($result->num_rows == 1) {
        $_SESSION['login_user'] = $myusername;
        while ($row = $result->fetch_assoc()) {
            $insegnamento = $row["INSEGNAMENTO"];
        }
        $_SESSION['role'] = $insegnamento;
        $conn->close();
        header('Location:' . $insegnamento . '/admin/index.php'); //così mi riinderizza ua un'altra pagina
        //include $insegnamento.'/admin/set.php';  così includo una pagina, ne prendo solo il codice e resto nella stessa pagina
    } else {
        echo "Your Username or Password is invalid";
    }
} else {
    echo "No POST methods";
}
?>
