<?php
    $func=$_GET['func'];
    $id=$_GET['id'];
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    require_once('connect.php');

    $ip=$_SERVER['REMOTE_ADDR'];

    if($func=='up'){
        //echo "Hey I wanna upvote ".$id." says ".$ip;
        $upS="INSERT INTO tbl_upvotes VALUES(null,'{$id}','{$ip}')";
        $upQ=mysqli_query($link,$upS);

        $trackS="SELECT sub_ups FROM tbl_submissions WHERE sub_id={$id}";
        $trackQ=mysqli_query($link,$trackS);
        
        $trackA=mysqli_fetch_array($trackQ);
        $ups=$trackA['sub_ups'];

        if($ups==''){$ups=0;}
        $ups++;

        $upsUS="UPDATE tbl_submissions SET sub_ups={$ups} WHERE sub_id={$id}";
        $upsUQ=mysqli_query($link,$upsUS);
    }else if($func=='down'){
        //echo "Hey I wanna downvote ".$id." says ".$ip;
        $upS="DELETE FROM tbl_upvotes WHERE up_trackId='{$id}' AND up_ip='{$ip}'"; 
        $upQ=mysqli_query($link,$upS);

        $trackS="SELECT sub_ups FROM tbl_submissions WHERE sub_id={$id}";
        $trackQ=mysqli_query($link,$trackS);
        
        $trackA=mysqli_fetch_array($trackQ);
        $ups=$trackA['sub_ups'];

        $ups--;

        $upsUS="UPDATE tbl_submissions SET sub_ups={$ups} WHERE sub_id={$id}";
        $upsUQ=mysqli_query($link,$upsUS);
    }

    if($func=='getUps'){
        $upArrS="SELECT up_trackId FROM tbl_upvotes WHERE up_ip='{$ip}'";
        $upArrQ=mysqli_query($link,$upArrS);

        $data="[";

        while($row=mysqli_fetch_array($upArrQ)){
            $data.=$row['up_trackId'].",";
        }

        $data=rtrim($data,',');
        $data.="]";

        echo $data;
    }

    mysqli_close($link);
?>