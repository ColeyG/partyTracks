<?php
    $title=$_GET['title'];
    $id=$_GET['id'];

    require_once('connect.php');

    $title=str_replace("'","''",$title);
    $title=str_replace("\"","",$title);

    $subS="INSERT INTO tbl_submissions VALUES(null,'{$title}','{$id}',0)";
    $subQ=mysqli_query($link,$subS);

    //echo $subS;

    if($subQ){
        echo 'success';
    }else{
        echo 'failure';
    }

    mysqli_close($link);
?>