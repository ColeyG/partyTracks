<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include('php/config.php');
require_once('php/connect.php');

$ip=$_SERVER['REMOTE_ADDR'];

$trackS='SELECT * FROM tbl_submissions ORDER BY sub_ups DESC';
$trackQ=mysqli_query($link,$trackS);

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Coley Party Playlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel='stylesheet' href='css/cole.css'>
    <link rel='stylesheet' href='css/main.css'>
</head>
<body class='cFlexInCol bodyIns'>
    <p>Link:</p>
    <input type="text" class='input'>
    <p class='hidden name'>Missed a field!</p>
    <a href="#" class='submitTrack'><button type="button" class="btn btn-primary m-2"><p>Submit</p></button></a>
    <div class="alert alert-success" role="alert">
        Success!
    </div>
    <div class="alert alert-danger" role="alert">
        Failure!
    </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col"><p>#</p></th>
      <th scope="col"><p>Thumbnail</p></th>
      <th scope="col"><p>Name</p></th>
      <th scope="col"><p>Upvotes</p></th>
      <th scope="col"><p>Link</p></th>
    </tr>
  </thead>
  <tbody>
    <?php
        $num=1;
        while($row = mysqli_fetch_array($trackQ)){
            echo "<tr>";
            echo "<th scope='row'><p>".$num."</p></th>";
            echo "<td><img class='thumb' src=\"https://img.youtube.com/vi/".$row['sub_content']."/default.jpg\" ></td>";
            echo "<td><p>".$row['sub_title']."</p></td>";
            echo "<td><p class='upNum' id='p".$row['sub_id']."'>".$row['sub_ups']."</p><a href='#' class='starButton' id=".$row['sub_id']."><img src='images/star_off.svg' data-state='unchecked' id='s".$row['sub_id']."' alt='star' class='starOff'></a></td>";
            echo "<td><a href='https://www.youtube.com/watch?v=".$row['sub_content']."'><p>".$row['sub_content']."</p></a></td>";
            echo "</tr>";
            $num++;
        }
    ?>
  </tbody>
</table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src='js/coldAjax.js'></script>
    <script src='js/main.js'></script>
    <script src='js/upvotes.js'></script>
</body>
</html>
