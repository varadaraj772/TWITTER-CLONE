<?php
$conn = mysqli_connect("localhost", "root", "", "userinfo");
session_start();
$ac = $_SESSION['AccountCreated'];
if (!isset($ac)) {
  echo ("<script>
  window.location.replace('index.html');
  </script>
  ");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    body {
      height: 100vh;
      width: 100vw;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    label {
      font-weight: bolder;
    }

    .container {
      background: #f2f2f2;
    }

    img {
      height: 20vh;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container rounded-4">
    <div class="row">
      <div class="text-center">
        <img src="profile/pngwing.com.png">
      </div>
    </div>
    <div class="row">
      <form action="profile.php" method="post" class="text-center" enctype="multipart/form-data">
        <label for="img" class="form-label">Upload profile image here</label>
        <br />
        <input type="file" name="image" class="form-control" />
        <button type="submit" class="btn btn-outline-success w-50 my-4" name="upload">
          UPLOAD
        </button>
      </form>
    </div>
  </div>
</body>

</html>
<?php
//MAKE CONNECTION
$conn = mysqli_connect("localhost", "root", "", "userinfo");

if (isset($_POST['upload'])) {
  //GETTING IMAGE NAME
  $Get_image_name = $_FILES['image']['name'];

  //GIVING FOLDER PATH TO STORE IMAGE  STEP:STORE
  $image_Path = "profile/" . basename($Get_image_name);
  $username = $_SESSION['uname'];
  $email = $_SESSION['mail'];
  //UPDATING PROFILE_PATH COLUMN IN THE DATABASE OF THE CURRENT USER
  $sql = mysqli_query($conn, "UPDATE account SET  profile_path='$Get_image_name' WHERE uname='$userame' or emailid='$email'");
  //MOVING RETRIEVED IMAGE FROM THE FORM TO THE FOLDER WE SELECTED IN THE STEP:STORE
  if (move_uploaded_file($_FILES['image']['tmp_name'], $image_Path)) {
    //SESSION FOR PROFILE PHOTO UPLOADED
    $_SESSION['profile'] = "yes";
    echo ("<script>
  </script>
  ");
    //GO TO LOGIN PAGE
    header("Location:login.html");
  } else {
    //IF NOT UPLOADED REFRESHING PAGE
    echo ("<script>
    alert('SOME ERROR OCCURED')
  window.location.replace('profile.php');
  </script>
  ");
  }
}
?>