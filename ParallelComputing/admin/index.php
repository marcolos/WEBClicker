<?php
include('../../session.php');
$url = dirname(__FILE__);
$array = explode('/',$url);
$count = count($array);
$folder = $array[$count-2];
if ($folder!=$_SESSION['role']){
    header("location:/index.html");
}
?>

<?php
if($_GET['del'])
{
    $id = $_GET['del'];
    $sql = "DELETE FROM QUESTIONS WHERE ID_QUESTION = $id;";
    $sql2 = "ALTER TABLE QUESTIONS AUTO_INCREMENT = 1; ";

    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
        header('Location:index.php');
        //    echo "Question insert correctly";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <script>
            function Deleteqry(id)
            {
                window.location="index.php?del="+id;
                return false;
            }
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>WEBClicker</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link rel="stylesheet" href="../../css/mycss/admin.css">
    </head>
    <body>
        <h1>Welcome <?php echo $login_session; ?></h1>
        <h2><a href = "/logout.php">Sign Out</a></h2>
        <br>
        <?php
            include ('../../config.php');
            $myusername = $_SESSION['login_user'];
            $result = $conn->query("SELECT * FROM QUESTIONS WHERE USERNAME = '$myusername' ");
            if ($result->num_rows > 0) {
                // output data of each row
                $i=0;
                while($row = $result->fetch_assoc()) {
                    $question[$i] = $row['QUESTION'];
                    $idQuestion[$i] = $row['ID_QUESTION'];
                    $i++;
                }
                $bigArray = array_combine($idQuestion,$question);
                ?>

                <div class="container listcontainer">
                <h2>Question List</h2>
                <div class="list-group">

        <?php
                foreach ($bigArray as $id=>$question) {
//                    echo 'ID = '.$id.' ' .$question. '<br>';
        ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-1">
                                <?php echo '<h5>'. 'ID = '.$id. '</h5>';?>
                            </div>
                            <div class="col-8">
                                <?php echo '<h5>'. $question. '</h5>';?>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary text-uppercase" onclick="window.location.href = '<?php echo 'set.php?id='.$id?>'">View</button>
                                <button class="btn btn-primary text-uppercase">Edit</button>
<!--                                <button name="id" value="--><?php //echo $id;?><!--" class="btn btn-primary text-uppercase">Delete</button>-->
                                <input class="btn btn-primary text-uppercase" value="delete" type="button" name="abc" id="abc" onclick="return Deleteqry(<?php echo $id ?>);"/>
                            </div>
                    </li>
        <?php
                }
        ?>
                </ul>
                </div>
                </div>
        <?php

            } else {
                echo "0 results";
            }
        ?>

        <div class="container addItemList">
            <a class="btn btn-primary text-uppercase buttonAddItem" href="insertQuestion.php">+</a>
        </div>


        <!-- SCRIPTS -->
        <!-- JQuery --> <!--Popper-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    </body>
</html>










