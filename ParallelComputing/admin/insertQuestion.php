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
if(isset($_POST['submitInsertAnswer'])){ //check if form was submitted
    // VARIABILI bisogna usare la func per parsare i dati. Senno ad esmpio inserendo un accento darebbe errore il server
    $username = $_SESSION['login_user'];
    $question = mysqli_real_escape_string($conn, $_REQUEST['question']);
    $answerA = mysqli_real_escape_string($conn, $_REQUEST['answerA']);
    $answerB = mysqli_real_escape_string($conn, $_REQUEST['answerB']);
    $countA = 0;
    $countB = 0;

    if (mysqli_real_escape_string($conn, $_REQUEST['answerC'])==''){
        $answerC = 'NULL';
        $countC = -1;
    } else{
        $answerC = mysqli_real_escape_string($conn, $_REQUEST['answerC']);
        $countC = 0;
    }

    if (mysqli_real_escape_string($conn, $_REQUEST['answerD'])==''){
        $answerD = 'NULL';
        $countD = -1;
    } else{
        $answerD = mysqli_real_escape_string($conn, $_REQUEST['answerD']);
        $countD = 0;
    }

    if (mysqli_real_escape_string($conn, $_REQUEST['answerE'])==''){
        $answerE = 'NULL';
        $countE = -1;
    } else{
        $answerE = mysqli_real_escape_string($conn, $_REQUEST['answerE']);
        $countE = 0;
    }
//    $answerC = mysqli_real_escape_string($conn, $_REQUEST['answerC']);
//    $answerD = mysqli_real_escape_string($conn, $_REQUEST['answerD']);
//    $answerE = mysqli_real_escape_string($conn, $_REQUEST['answerE']);
//    $countA = 0;
//    $countB = 0;
//    $countC = 0;
//    $countD = 0;
//    $countE = 0;
   $setted = 0;

    $sql = "INSERT INTO QUESTIONS (USERNAME,QUESTION,ANSWERA,ANSWERB,ANSWERC,ANSWERD,ANSWERE,COUNTA,COUNTB,COUNTC,COUNTD,COUNTE,SETTED) VALUES ('$username','$question','$answerA','$answerB','$answerC','$answerD','$answerE','$countA','$countB','$countC','$countD','$countE','$setted')";
//    $sql = "INSERT INTO QUESTIONS (USERNAME,QUESTION,ANSWERA,ANSWERB,ANSWERC,ANSWERD,ANSWERE,SETTED) VALUES ('$username','$question','$answerA','$answerB','$answerC','$answerD','$answerE',$setted')";

    if ($conn->query($sql) === TRUE) {
        header('Location:index.php');
    //    echo "Question insert correctly";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<!doctype html>
<html lang="en">
<head>
    <script type="text/javascript">

        var count = 2;
        function myFunction() {
            count +=1;
            if (count == 3)
                document.getElementById('myC').style.display='block';

            if (count == 4)
                document.getElementById('myD').style.display='block';

            if (count == 5)
                document.getElementById('myE').style.display='block';

            if (count > 5)
                count = 5;
        }

        function functionSub() {
            count -=1;
            if (count == 4)
                document.getElementById('myE').style.display='none';

            if (count == 3)
                document.getElementById('myD').style.display='none';

            if (count == 2)
                document.getElementById('myC').style.display='none';

            if (count <2)
                count = 2;
        }
        
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="../../css/mycss/insertQuestion.css">

    <title>WEBClicker</title>
</head>
    <body>
        <div class="container">
            <form action="" method="post">
                <div class="form-group row">
                    <label for="questionLabel" class="col-sm-1 col-form-label"><h6>Question</h6></label>
                    <div class="col-sm-11">
                        <input name="question" type="text" class="form-control" id="questionLabel" placeholder="Insert a Question">
                    </div>
                </div>

                <label id="labelAnswer"><h6>Answer</h6></label><br>
                <!-- parte di elenco risposte e di inserimento immagine -->
                <div class="row">
                    <div id="insertAnswer">
                        <div class="form-group row">
                            <label for="answerALabel" class="col-sm-1 col-form-label"><h6>A.</h6></label>
                            <div class="col-sm-10">
                                <input name ="answerA" type="text" class="form-control" id="answerALabel" placeholder="Insert answer A">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answerBLabel" class="col-sm-1 col-form-label"><h6>B.</h6></label>
                            <div class="col-sm-10">
                                <input name="answerB" type="text" class="form-control" id="answerBLabel" placeholder="Insert answer B">
                            </div>
                        </div>

                        <div id="myC" style="display:none">
                        <div class="form-group row" >
                            <label for="answerCLabel" class="col-sm-1 col-form-label"><h6>C.</h6></label>
                            <div class="col-sm-10">
                                <input name="answerC" type="text" class="form-control" id="answerCLabel" placeholder="Insert answer C">
                            </div>
                        </div>
                        </div>

                        <div id="myD" style="display:none">
                        <div class="form-group row">
                            <label for="answerDLabel" class="col-sm-1 col-form-label"><h6>D.</h6></label>
                            <div class="col-sm-10">
                                <input name="answerD" type="text" class="form-control" id="answerDLabel" placeholder="Insert answer D">
                            </div>
                        </div>
                        </div>

                        <div id="myE" style="display:none">
                        <div class="form-group row">
                            <label for="answerELabel" class="col-sm-1 col-form-label"><h6>E.</h6></label>
                            <div class="col-sm-10">
                                <input name="answerE" type="text" class="form-control" id="answerELabel" placeholder="Insert answer E">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div id="buttonAddSub">
                        <a class="btn btn-primary text-uppercase buttonAddItem" onclick="functionSub()" >-</a> <br><br>
                        <a class="btn btn-primary text-uppercase buttonAddItem" onclick="myFunction()">+</a>
                    </div>
                 </div>

                <!-- parte dell'invio dei dati -->
                <div id="footer">
                    <div class="row">
                        <div class="col-9">
                            <!--One of three columns -->
                        </div>
                        <div class="col-2" id="sendButton"><br>
                                <input type="submit" name="submitInsertAnswer" value="Submit" class="btn btn-success btn-lg">
                        </div>
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