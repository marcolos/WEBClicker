<?php
// CONTROLLO ACCESSO
include ('../../session.php');
$url = dirname(__FILE__);
$array = explode('/',$url);
$count = count($array);
$folder = $array[$count-2];
if ($folder!=$_SESSION['role']){
    header("location:/index.html");
}
?>

<?php
// RESET USANDO IL FORM: E' STATO SOSTITUITO DALLA CHIAMATA AJAX
// VIENE ESEGUITA QUESTA QUERY SE PREMO RESET ANSWERS
//if(isset($_POST['SubmitReset'])) { //check if form was submitted
//    include('../../session.php');
//    $idQuestion = $_POST['idQuestion'];
//    echo $idQuestion;
//    $conn->query("UPDATE QUESTIONS SET COUNTA='0',COUNTB='0',COUNTC='0',COUNTD='0',COUNTE='0' WHERE ID_QUESTION = '$idQuestion'");
//}
//?>

<?php
// VIENE ESEGUITA QUESTA QUERY SE PREMO START
if(isset($_POST['SubmitStartAnswer'])){ //check if form was submitted
    include('../../session.php');
    $idQuestion = $_POST['idQuestion'];
    $username = $_SESSION['login_user'];

    $conn->query("UPDATE QUESTIONS SET SETTED='0' WHERE USERNAME = '$username'");
    $conn->query("UPDATE QUESTIONS SET SETTED='1' WHERE ID_QUESTION = '$idQuestion'");
}
?>

<?php
// VIENE ESEGUITA QUESTA QUERY SE PREMO STOP
if(isset($_POST['SubmitStopAnswer'])){ //check if form was submitted
    include('../../session.php');
    $username = $_SESSION['login_user'];

    $conn->query("UPDATE QUESTIONS SET SETTED='0' WHERE USERNAME = '$username'");
}
?>

<?php
// PRENDO I DATI DAL DB
$id = mysqli_real_escape_string($conn, $_REQUEST['id']);

$result = $conn->query("SELECT * FROM QUESTIONS WHERE ID_QUESTION = '$id'");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $question = $row["QUESTION"];
        $answerA = $row['ANSWERA'];
        $answerB = $row['ANSWERB'];
        $answerC = $row['ANSWERC'];
        $answerD = $row['ANSWERD'];
        $answerE = $row['ANSWERE'];
        $countA = $row['COUNTA'];
        $countB = $row['COUNTB'];
        $countC = $row['COUNTC'];
        $countD = $row['COUNTD'];
        $countE = $row['COUNTE'];
        $setted = $row['SETTED'];

        $countAnswer = 2;
        if($answerC != ''){
            $countAnswer ++;
        }
        if($answerD != ''){
            $countAnswer ++;
        }
        if($answerE != ''){
            $countAnswer ++;
        }
    }
} else {
    echo "0 results";
}
$conn->close();
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
    <link rel="stylesheet" type="text/css" href="../../css/mycss/viewQuestion.css">


</head>
<body>

<div id="container">
    <div id="wrapperConteiner">
        <div class="form-group row">
            <div class="col-11" id="viewQuestion">
                <h1><?php echo $question; ?></h1>
            </div>
        </div>

        <br>
        <!-- parte di elenco risposte e di inserimento immagine -->
        <div class="row">
            <div id="blockAnswer">
                <div class="form-group row">
                    <h3>A.</h3>
                    <div class="col-10">
                        <h4><?php echo $answerA; ?> </h4>
                    </div>
                </div>
                <div class="form-group row">
                    <h3>B.</h3>
                    <div class="col-10">
                        <h4><?php echo $answerB; ?> </h4>
                    </div>
                </div>

                <?php
                    if($countAnswer == 3 || $countAnswer ==4 || $countAnswer == 5) {
                        ?>

                        <div class="form-group row">
                            <h3>C.</h3>
                            <div class="col-10">
                                <h4><?php echo $answerC; ?> </h4>
                            </div>
                        </div>

                        <?php
                    }
                ?>

                <?php
                    if($countAnswer ==4 || $countAnswer == 5) {
                        ?>

                        <div class="form-group row">
                            <h3>D.</h3>
                            <div class="col-10">
                                <h4><?php echo $answerD; ?> </h4>
                            </div>
                        </div>

                        <?php
                    }
                ?>

                <?php
                     if($countAnswer == 5) {
                         ?>

                         <div class="form-group row">
                             <h3>E.</h3>
                             <div class="col-10">
                                 <h4><?php echo $answerE; ?> </h4>
                             </div>
                         </div>

                         <?php
                     }
                ?>

            </div>
            <div id="addImage">

            </div>
        </div>
    </div>
    <!-- parte dell'invio dei dati -->
    <div id="footer">
        <div class="row">
            <div class="col" id="myResetDiv">
                <!--One of three columns -->
                <button id="resetbtn" class="btn btn-primary btn-lg text-uppercase resetButton" onclick="reset(<?php echo $id; ?>)"> Reset Answers </button>
                <div style="display: none" id="showalertdiv" class="alert alert-success" role="alert">
                    <p><strong>Reset is been done correctly.</strong> </p>
                </div>
<!--                RESET USANDO IL FORM: E' STATO SOSTITUITO DALLA CHIAMATA AJAX-->
<!--                <form action="" method="post">-->
<!--                    <input type="hidden" name="idQuestion" value="--><?php //echo $id ?><!--">-->
<!--                    <input type="submit" id="resetbtn" name="SubmitReset" value="Reset Answers" class="btn btn-primary btn-lg text-uppercase resetButton">-->
<!--                    PER IL DIALOG A SCOMPARSA-->
<!--                    <div id="dialog" style="display: none">-->
<!--                        This dialog will automatically close in 5 seconds.-->
<!--                    </div>-->
<!--                </form>-->
            </div>
            <div class="col" id="myStartStopDiv">
                <!--Second of three columns -->
                <div id="start" style="display: none">
                    <form action="" method="post">
                        <!-- La uso per passare l'idQuestion-->
                        <input type="hidden" name="idQuestion" value="<?php echo $id ?>">
                        <input type="submit" name="SubmitStartAnswer" value="Start" class="btn btn-success btn-lg text-uppercase myStartStopButton">
                    </form>
                </div>
                <div id="stop" style="display: none">
                    <form action="" method="post">
                        <!-- La uso per passare l'idQuestion-->
                        <input type="hidden" name="idQuestion" value="<?php echo $id ?>">
                        <input type="submit" name="SubmitStopAnswer" value="Stop" class="btn btn-danger btn-lg text-uppercase myStartStopButton">
                    </form>
                </div>
            </div>

            <div class="col" id="myResultDiv">
                <!--Third of three columns -->
                <form action="results.php" target="_blank">
                    <input type="hidden" name="idQuestion" value="<?php echo $id ?>">
                    <input type="submit" value="Results" class="btn btn-success btn-lg text-uppercase myResultButton">
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- SCRIPTS -->
    <!-- JQuery --> <!--Popper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap css-->
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>

<!-- SAREBBE PER FAR APPARIRE IL DIALOG PER 5SEC QUANDO PREMO RESET. PERO QUANDO PREMO MI RICARICA LA PAGINA E QUINDI NON FUNZIONA-->
<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<!--    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>-->
<!--    <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />-->
<!--    <script type="text/javascript">-->
<!--        $(function () {-->
<!--            $("#resetbtn").click(function () {-->
<!--                $("#dialog").dialog({-->
<!--                    modal: true,-->
<!--                    title: "jQuery Dialog",-->
<!--                    width: 300,-->
<!--                    height: 150,-->
<!--                    open: function (event, ui) {-->
<!--                        setTimeout(function () {-->
<!--                            $("#dialog").dialog("close");-->
<!--                        }, 5000);-->
<!--                    }-->
<!--                });-->
<!--            });-->
<!--        });-->
<!--    </script>-->

<!--    PER FAR APPARIRE START E STOP-->
    <script type="text/javascript">
        var setted = <?php echo $setted; ?>;
        var count=0;
        // document.write(setted);
        // document.write(count);

        if (setted==0 ) {
            document.getElementById('start').style.display = 'block';
            count =1;
        }

        if (setted==1 ) {
            document.getElementById('stop').style.display = 'block';
            count=1;
        }
    </script>

<!--    AJAX USANDO LA reset.php-->
    <script type="text/javascript">
        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }

        function reset(id)
        {
            $.ajax({
                url: "reset.php",
                type: "POST",
                data: { 'id': id },
                success: function()
                {
                    document.getElementById("showalertdiv").style.display='block';
                    sleep(1500).then(() => {
                        // Do something after the sleep!
                        document.getElementById("showalertdiv").style.display='none';
                    });
                    // alert("ok");
                }
            });
        }
    </script>
</body>
</html>