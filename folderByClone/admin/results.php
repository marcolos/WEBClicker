<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 2018-12-10
 * Time: 00:40
 */
include ('../../config.php');

$id = mysqli_real_escape_string($conn, $_REQUEST['idQuestion']);

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
    }
} else {
    echo "0 results";
}
$conn->close();

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" type="text/css" href="../../css/mycss/results.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        var question = "<?php echo $question; ?>";
        var answerA = "<?php echo $answerA; ?>";
        var answerB = "<?php echo $answerB; ?>";
        var answerC = "<?php echo $answerC; ?>";
        var answerD = "<?php echo $answerD; ?>";
        var answerE = "<?php echo $answerE; ?>";
        var countA = <?php echo $countA; ?>;
        var countB = <?php echo $countB; ?>;
        var countC = <?php echo $countC; ?>;
        var countD = <?php echo $countD; ?>;
        var countE = <?php echo $countE; ?>;
        var countAnswer = 2;

        if(answerC !='')
            countAnswer++;
        if(answerD !='')
            countAnswer ++;
        if(answerE !='')
            countAnswer ++;

        function drawChart() {
            if (countAnswer == 2) {
                var data = google.visualization.arrayToDataTable([
                    ["Question", "Answer", {role: "style"}],
                    [answerA, countA, "color: #4285F4"],
                    [answerB, countB, "color: #34A853"]
                ]);
            }

            if (countAnswer == 3) {
                var data = google.visualization.arrayToDataTable([
                    ["Question", "Answer", {role: "style"}],
                    [answerA, countA, "color: #4285F4"],
                    [answerB, countB, "color: #34A853"],
                    [answerC, countC, "color: #FBBC05"]
                ]);
            }

            if (countAnswer == 4) {
                var data = google.visualization.arrayToDataTable([
                    ["Question", "Answer", {role: "style"}],
                    [answerA, countA, "color: #4285F4"],
                    [answerB, countB, "color: #34A853"],
                    [answerC, countC, "color: #FBBC05"],
                    [answerD, countD, "color: #EA4335"]
                ]);
            }

            if (countAnswer == 5) {
                var data = google.visualization.arrayToDataTable([
                    ["Question", "Answer", {role: "style"}],
                    [answerA, countA, "color: #4285F4"],
                    [answerB, countB, "color: #34A853"],
                    [answerC, countC, "color: #FBBC05"],
                    [answerD, countD, "color: #EA4335"],
                    [answerE, countE, "color: #e5e4e2"]
                ]);
            }
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" },
                2]);

            var options = {
                title: question,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("donutchart"));
            chart.draw(view, options);
        }

        // DONUT
        //google.charts.load("current", {packages:["corechart"]});
        //google.charts.setOnLoadCallback(drawChart);
        //
        //var question = "<?php //echo $question; ?>//";
        //var answerA = "<?php //echo $answerA; ?>//";
        //var answerB = "<?php //echo $answerB; ?>//";
        //var answerC = "<?php //echo $answerC; ?>//";
        //var answerD = "<?php //echo $answerD; ?>//";
        //var answerE = "<?php //echo $answerE; ?>//";
        //var countA = <?php //echo $countA; ?>//;
        //var countB = <?php //echo $countB; ?>//;
        //var countC = <?php //echo $countC; ?>//;
        //var countD = <?php //echo $countD; ?>//;
        //var countE = <?php //echo $countE; ?>//;
        //
        // function drawChart() {
        //     var data = google.visualization.arrayToDataTable([
        //             ['Task', 'Hours per Day'],
        //             [answerA,    countA],
        //             [answerB,      countB],
        //             [answerC,  countC],
        //             [answerD, countD],
        //             [answerE,    countE]
        //         ]);
        //
        //     var options = {
        //         title: question,
        //         pieHole: 0.4,
        //         sliceVisibilityThreshold: 0
        //     };
        //
        //     var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        //     chart.draw(data, options);
        // }
    </script>
    <title>WEBClicker</title>
</head>
<body>
<div id="donutchart"></div>

<!-- SCRIPTS -->
<!-- JQuery --> <!--Popper-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!-- Bootstrap css-->
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
</body>
</html>


