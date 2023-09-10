<?php
// MAKE CONNECTION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect('localhost', 'root', '', 'userinfo');
}

//CHECKING CONNECTION
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//CHECKING FOR EMPTY FIELDS
if (!$_POST['mail'] | !$_POST['pass']) {
    echo ("<script>
  window.alert('Fill all the fields');
  history.back();
</script>");
    exit();
}
//GETTING THE EMAIL AND PASSWORD FROM FORM
else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $mail = $_POST["mail"];
        $password = $_POST["pass"];
        $sql = mysqli_query($conn, "SELECT * FROM account WHERE emailid = '$mail'");
    }
}
$n = mysqli_num_rows($sql);
//CHECKING FOR USER EXISTENCE
if ($n == 1) {
    $row = mysqli_fetch_assoc($sql);
    //CHECKING PASSWORD
    if ($password == $row["pass_word"]) {
        //STARTING SESSION AND STORING INFO
        session_start();
        $_SESSION['log'] = "Yes";
        $_SESSION['mail'] = $mail;
        $_SESSION['pass_word'] = $pass;
        echo ("<script>
        </script>");
        header("Location:home.php");
    } else {
        //WRONG PASSWORD
        echo ("<script>window.alert('invalid password');
        history.back();</script>");
    }
    //USER DOES NOT EXIST
} else {
    echo ("<script>window.alert('USER DOES NOT EXIST');
    history.back();</script>");
}