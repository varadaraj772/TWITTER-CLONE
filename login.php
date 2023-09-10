<?php
// MAKE CONNECTION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $conn = mysqli_connect('localhost', 'root', '', 'userinfo');
}

// CHECKING CONNECTION
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// RETRIEVING INFO FROM FORM
$un = $_POST["u"];
$pd = $_POST["p"];

// CHECKING FOR EMPTY FIELDS
if (!$_POST['u'] | !$_POST['p']) {
  echo ("<script>
  window.alert('FILL ALL THE FIELDS');
  history.back();
</script>");
  exit();
}
$un = $_POST["u"];
$pd = $_POST["p"];
// RETRIEVING LOGIN INFO
$sql = mysqli_query($conn, "SELECT * FROM account WHERE uname = '$un'");
// CHECKING FOR USER EXISTENCE
if (mysqli_num_rows($sql) == 1) {

  $row = mysqli_fetch_assoc($sql);
  //VERIFYING THE PASSWORD
  if ($pd == $row["pass_word"]) {
    // STARTING A NEW SESSION AND STORING INFO
    session_start();
    $_SESSION['log'] = "Yes";
    $_SESSION['uname'] = $un;
    $_SESSION['pass_word'] = $pd;
    header("Location:home.php");
  } else {
    // GOING BACK FOR WRONG PASSWORD
    echo ("<script>window.alert('WRONG PASSWORD');</script>");
    echo ("<script>
    window.location.replace('login.html');
    </script>");
  }
  //USER DOES NOT EXIST
} else {
  echo ("<script>window.alert('USER DOES NOT EXIST');</script>");
  echo ("<script>
    window.location.replace('login.html');
    </script>");
}