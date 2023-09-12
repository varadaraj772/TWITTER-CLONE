<?php
$conn = mysqli_connect("localhost", "root", "", "userinfo");
session_start();
$passw = $_SESSION['pass_word'];
$qry = mysqli_query($conn, "SELECT * from account where pass_word='$passw'");
$row = mysqli_fetch_array($qry);
$user = $row['uname'];
$na = array_keys($_POST);
$id = substr($na[0], 1);
$qry = mysqli_query($conn, "SELECT * from tweets where id='$id'");
$row = mysqli_fetch_array($qry);
$twt = $row['twt'];
$like = 0;
$like++;
$qry = mysqli_query($conn, "INSERT into likee(id,uname,lcount,twt) VALUES('$id','$user','$like','$twt')");
$qry = mysqli_query($conn, "SELECT lcount,uname from likee where uname='$user'");
$row = mysqli_fetch_array($qry);

?>