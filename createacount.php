<?php
// MAKE CONNECTION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = mysqli_connect('localhost', 'root', '', 'userinfo');

  //CHECK CONNECTION
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //GET INFO FROM FORM
  $username = $_POST['uname'];
  $mno = $_POST['mnumber'];
  $email = $_POST['mail'];
  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];
  $squestion1 = $_POST['sq1'];
  $squestion2 = $_POST['sq2'];
  // CHECKING FOR EMPTY FIELDS
  if (!$_POST['uname'] | !$_POST['mnumber'] | !$_POST['mail'] | !$_POST['pass'] | !$_POST['cpass'] | !$_POST['sq1'] | !$_POST['sq2']) {
    echo ("<script>
    window.alert('Fill all the fields');
    history.back();
</script>");
    exit();
  }
  //CHECKING FOR PASSWORD AND CONFIRM PASSWORD MATCH
  if ($pass != $cpass) {
    echo ("<script>
    window.alert('PASSWORDS DO NOT MATCH');
    history.back();
</script>");
    exit();
  }
  //INSERTING THE INFORMATION TO DATABASE
  $r = mysqli_query($conn, "SELECT * FROM account");
  $sql = "INSERT INTO account (uname ,mobileno,emailid,pass_word,cpassword,sq1,sq2) VALUES ('$username','$mno', '$email','$pass','$cpass','$squestion1','$squestion2')";
  $pno = trim(stripslashes($_POST['mnumber']));
  // STARTING SESSION AND STORING INFO ON A SUCESSFULL INSERT
  if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['AccountCreated'] = "yes";
    $_SESSION['uname'] = $username;
    $_SESSION['mail'] = $email;
    $_SESSION['pass_word'] = $pass;
    echo ("<script>
    window.alert('sucessfull');
    </script>");
    // GO TO PROFILE PAGE TO UPLOAD PROFILE PHOTO
    header("Location:profile.php");

  }
  // DISPLAY ERROR IF NOT INSERTED
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  //CLOSING CONNECTION
  mysqli_close($conn);
}