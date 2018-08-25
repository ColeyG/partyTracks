<?php
    $id=$_GET[id];
    require_once('connect.php');

    //$subS="INSERT INTO tbl_submissions VALUES(null,'{$title}','{$id}')";
    //$subQ=mysqli_query($link,$subS);

    $json = file_get_contents('http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=' . $id . '&format=json'); //get JSON video details
    $details = json_decode($json, true); //parse the JSON into an array
    echo json_encode($details);

    mysqli_close($link);
?>