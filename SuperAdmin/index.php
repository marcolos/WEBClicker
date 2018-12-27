<?php
include('../session.php');
$url = dirname(__FILE__);
$array = explode('/',$url);
$count = count($array);
$folder = $array[$count-1];
if ($folder!=$_SESSION['role']){
    header("location:/index.html");
}
?>

<?php
if(isset($_POST['submitNewCourse'])) { //check if form was submitted
    // VARIABILI bisogna usare la func per parsare i dati. Senno ad esmpio inserendo un accento darebbe errore il server
    $course = mysqli_real_escape_string($conn, $_REQUEST['course']);
    $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
    $surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
    $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
    $course2 = ucwords($course); // serve per mettere la prima lettere della parola maiuscola
    $course3 = str_replace(' ', '', $course2); // serve per rimuovere gli spazi

    $sql = "INSERT INTO LOGIN (USERNAME,NAME,SURNAME,EMAIL,PASSWORD,INSEGNAMENTO) VALUES ('$username','$name','$surname','$email','$password','$course3')";
    if ($conn->query($sql) === TRUE) {
        echo "New account create correctly";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
    $src = '../folderByClone';
    $dst = '../'.$course3;
    recurse_copy($src,$dst);
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
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Welcome <?php echo $login_session; ?></h1>
    <h2><a href = "/logout.php">Sign Out</a></h2><br>
    <div class="container">
        <div id="positionAddInsegnamento">
            <button class="btn btn-primary btn-lg text-uppercase" id="addInsegnamento" type="button" data-toggle="collapse" data-target="#collapseInsertCode" aria-expanded="false" aria-controls="collapseExample">Create new Course</button>
        </div>
        <div class="collapse" id="collapseInsertCode">
            <div class="card card-body col-sm">
                <form action="" method="post">
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="courseNameLabel"><h6>Course Name</h6></label>
                        <input name="course" type="text" class="form-control col-9" id="courseNameLabel" placeholder="Insert Course name">
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="nameLabel"><h6>Name</h6></label>
                        <input name="name" type="text" class="form-control col-9" id="nameLabel" placeholder="Insert Name">
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="surnameLabel"><h6>Surname</h6></label>
                        <input name="surname" type="text" class="form-control col-9" id="surnameLabel" placeholder="Insert Surname">
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="emailLabel"><h6>Email</h6></label>
                        <input name="email" type="text" class="form-control col-9" id="emailLabel" placeholder="Insert Email">
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="usernameLabel"><h6>Username</h6></label>
                        <input name="username" type="text" class="form-control col-9" id="usernameLabel" placeholder="Insert Username">
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="passwordLabel"><h6>Password</h6></label>
                        <input name="password" type="text" class="form-control col-9" id="passwordLabel" placeholder="Insert Password">
                    </div>
                    <br>
                    <input type="submit" value="Submit" name="submitNewCourse" class="btn btn-success btn-lg text-uppercase">
                </form>
            </div>
        </div>
    </div>


    <!-- SCRIPTS -->
    <!-- JQuery --> <!--Popper-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
</body>
</html>

