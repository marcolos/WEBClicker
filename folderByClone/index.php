<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 2018-12-09
 * Time: 16:11
 */

//SEND ANSWER

if(isset($_POST['SubmitSendAnswer'])){ //check if form was submitted
    $id = $_POST["questionID"];
    $test = $_POST["test"];

    echo $id;
    echo $test;
    include ('../config.php');

    //$id = mysqli_real_escape_string($conn, $_REQUEST['idQuestion']);

    $tmp = 0;
    $conn->query("LOCK TABLES QUESTIONS WRITE;");
    $result = $conn->query("SELECT * FROM QUESTIONS WHERE ID_QUESTION = '$id'");
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($test == 'A') {
                $tmp = $row['COUNTA'] + 1;
                $conn->query("UPDATE QUESTIONS SET COUNTA='$tmp' WHERE ID_QUESTION = '$id'");
            }

            if ($test == 'B') {
                $tmp = $row['COUNTB'] + 1;
                $conn->query("UPDATE QUESTIONS SET COUNTB='$tmp' WHERE ID_QUESTION = '$id'");

            }

            if ($test == 'C') {
                $tmp = $row['COUNTC'] + 1;
                $conn->query("UPDATE QUESTIONS SET COUNTC='$tmp' WHERE ID_QUESTION = '$id'");
            }

            if ($test == 'D') {
                $tmp = $row['COUNTD'] + 1;
                $conn->query("UPDATE QUESTIONS SET COUNTD='$tmp' WHERE ID_QUESTION = '$id'");
            }

            if ($test == 'E') {
                $tmp = $row['COUNTE'] + 1;
                $conn->query("UPDATE QUESTIONS SET COUNTE='$tmp' WHERE ID_QUESTION = '$id'");
            }
            $conn->query("UNLOCK TABLES;");
            header("location:ok_sendAnswer.html");
        }
    } else {
        $conn->query("UNLOCK TABLES");
        echo "No result";
    }
    $conn->close();
}
// else{
//    echo "Non entra nel form";
// }

?>

<?php
    include ('../config.php');
    $url = dirname(__FILE__);
    $array = explode('/',$url);
    $count = count($array);
    $folder = $array[$count-1];
    $result = $conn->query("SELECT QUESTIONS.* FROM QUESTIONS,LOGIN WHERE QUESTIONS.USERNAME = LOGIN.USERNAME AND QUESTIONS.SETTED=1 AND LOGIN.INSEGNAMENTO = '$folder'");

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $id = $row["ID_QUESTION"];
            $answerC = $row['ANSWERC'];
            $answerD = $row['ANSWERD'];
            $answerE = $row['ANSWERE'];
            $numAnswer = 2;
            if ($answerC != ''){
                $numAnswer ++;
            }
            if ($answerD != ''){
                $numAnswer ++;
            }
            if ($answerE != ''){
                $numAnswer ++;
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title>WEBClicker</title>

            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- Bootstrap core CSS -->
            <link href="../../css/bootstrap.min.css" rel="stylesheet">
            <!-- Your custom styles (optional) -->
            <link rel="stylesheet" href="../css/mycss/userInterface.css">


        </head>
        <body>
        <div id="container">
            <form action="" method="post" id="radioAnswer">
                <!--La uso per passare il questionID alla pagina sendAnswer.php-->
                <input type="hidden" name="questionID" value="<?php echo $id ?>">
                <div class="row">
                    <div class="col-sm">
                        <!--One of three columns -->
                    </div>
                    <div class="col-sm mycol-sm">

                <?php
                    switch ($numAnswer) {
                        case 5:
                            ?>

                            <label>
                                <input type="radio" name="test" value="A" checked>
                                <img src="http://placehold.it/80x80/0000FF/fff&text=A">
                            </label>

                            <label>
                                <input type="radio" name="test" value="B">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=B">
                            </label>

                            <label>
                                <input type="radio" name="test" value="C">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=C">
                            </label>

                            <label>
                                <input type="radio" name="test" value="D">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=D">
                            </label>

                            <label>
                                <input type="radio" name="test" value="E">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=E">
                            </label>

                        <?php
                            break;
                        case 4:
                            ?>

                            <label>
                                <input type="radio" name="test" value="A" checked>
                                <img src="http://placehold.it/80x80/0000FF/fff&text=A">
                            </label>

                            <label>
                                <input type="radio" name="test" value="B">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=B">
                            </label>

                            <label>
                                <input type="radio" name="test" value="C">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=C">
                            </label>

                            <label>
                                <input type="radio" name="test" value="D">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=D">
                            </label>

                        <?php
                            break;
                        case 3:
                            ?>

                            <label>
                                <input type="radio" name="test" value="A" checked>
                                <img src="http://placehold.it/80x80/0000FF/fff&text=A">
                            </label>

                            <label>
                                <input type="radio" name="test" value="B">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=B">
                            </label>

                            <label>
                                <input type="radio" name="test" value="C">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=C">
                            </label>

                        <?php
                            break;
                        case 2:
                            ?>

                            <label>
                                <input type="radio" name="test" value="A" checked>
                                <img src="http://placehold.it/80x80/0000FF/fff&text=A">
                            </label>

                            <label>
                                <input type="radio" name="test" value="B">
                                <img src="http://placehold.it/80x80/0000FF/fff&text=B">
                            </label>

                <?php
                    }
                ?>


                    </div>
                    <div class="col-sm" id="sendButton">
                        <input type="submit" value="Submit" name="SubmitSendAnswer" class="btn btn-success btn-lg" id="mySubmit">
                    </div>
                </div>
            </form>
        </div>


        <!-- SCRIPTS -->
        <!-- JQuery --> <!--Popper-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        </body>
        </html>

        <?php
    } else {
        echo "<div class=nessDom><h1>Nessuna domanda a cui rispondere</h1></div>";
    }
    $conn->close();

?>








