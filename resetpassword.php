<?php
//MAKE CONNECTION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = mysqli_connect('localhost', 'root', '', 'userinfo');
  //CHECKING CONNECTION
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //GETTING INFO FROM FORM
  $squestion1 = $_POST['sq1'];
  $squestion2 = $_POST['sq2'];
  $newpassword = $_POST['newpass'];
  $email = $_POST['mail'];

  //CHECKING FOR EMPTY FIELDS
  if (!$_POST['sq1'] | !$_POST['sq2'] | !$_POST['newpass'] | !$_POST['mail']) {
    echo ("<script>
    window.alert('Fill all the fields');
    history.back();
</script>");
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //GETTING INFO FROM FORM
    $squestion1 = $_POST['sq1'];
    $squestion2 = $_POST['sq2'];
    $newpassword = $_POST['newpass'];
    $email = $_POST['mail'];

    //CHECKING IF THE ANSWERS ARE CORRECT IN THE DATABASE OF THE USER
    $sql = mysqli_query($conn, "SELECT * FROM account WHERE emailid = '$email' AND sq1='$squestion1' and sq2='$squestion2'");

    //CHECKING FOR USER EXISTENCE
    if (mysqli_num_rows($sql) == 1) {
      //UPDATING PASSWORD IN THE DATABASE
      $sql = mysqli_query($conn, "UPDATE account SET pass_word='$newpassword' WHERE emailid = '$email' ");
      $sql = mysqli_query($conn, "UPDATE account SET cpassword='$newpassword' WHERE emailid = '$email' ");
      //STARTING SESSION AND UPDATING IT WITH NEW PASSWORD
      session_start();
      $_SESSION['log'] = "Yes";
      $_SESSION['mail'] = '$mail';
      $_SESSION['pass_word'] = '$newpassword';
      echo ("<script>
        window.alert('PASSWORD HAS BEEN UPDATED SUCESSFULLY');
       </script>");
      //GO TO LOGIN PAGE
      header("Location:login.html");

    }
    //GO BACK TO RESET PASSWORD PAGE WHEN INFO IS WRONG
    else {
      echo ("<script>window.alert('Please enter the correct information');
        history.back();</script>");
    }
  }
}