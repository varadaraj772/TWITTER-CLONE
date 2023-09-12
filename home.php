<?php
// STARTING SESSION AND ESTABLISH DATABASE CONNECTION
session_start();
$conn = mysqli_connect("localhost", "root", "", "userinfo");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HOME</title>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css" />
  <script src="twitter.js"></script>
  <script>
    const ele = document.querySelectorAll('div.post_avatar')
    ele.forEach(element => {
      element.addEventListener('active', () => {
        document.getElementById('root').style = 'fliter:blur(5px);';
      })
    });
  </script>
  <style>
    .post__avatar:active {
      margin-left: 45%;
    }

    #photo:active {
      border-radius: 0%;
      margin-left: 30%;
      scale: 5;
      transition: ease-in-out 0.7s;
    }
  </style>
</head>

<body style=" height:100vh;" id="root">

  <div class="container my-3" id="cont">
    <div class="row">
      <div class="col-lg-10 col-md-10">
        <img src="images/Twitter X.png" alt="" srcset="" style="height: 5vh" />
      </div>
      <div class="col-lg-2 col-md-2"><strong>HOME</strong></div>
    </div>
    <div class="row">
      <!--sidebar start-->
      <div class="sidebar col-6">
        <div class="sidebaroption active">
          <span class="material-symbols-outlined">home</span>
          <h2>Home</h2>
        </div>

        <div class="sidebaroption">
          <span class="material-symbols-outlined">search</span>
          <h2>Search</h2>
        </div>

        <div class="sidebaroption">
          <span class="material-symbols-outlined">notifications</span>
          <h2>Notification</h2>
        </div>

        <div class="sidebaroption">
          <span class="material-symbols-outlined">mail</span>
          <h2>Messages</h2>
        </div>

        <div class="sidebaroption">
          <span class="material-symbols-outlined">bookmark</span>
          <h2>Bookmarks</h2>
        </div>

        <div class="sidebaroption">
          <button class="material-symbols-outlined" onclick="window.open('showprofile.php')">account_circle</button>
          <h2 onclick="window.open('showprofile.php')">Profile</h2>
        </div>
        <button class="sidebar__tweet" onclick="logout();">
          Logout
        </button>
      </div>
      <!--sidebar ends-->
      <div class="tweetbox col-8" style="overflow-y:scroll;">
        <form action="home.php" method="post">
          <span class="input-group-text">
            <?php // RETRIEVE PROFILE PHOTO OF CURRENT USER
            echo profile() ?>
            <input type="text" name="tprompt" class="form-control" id="floatingInputGroup1" placeholder="Tweet here"
              required>
          </span>
          <button type="submit" class="sidebar__tweet">
            Tweet
          </button>
        </form>
        <script>
          var im1 = "<img src='images/heart.png' height='19' width='20'>";
          var im2 = "<img src='images/heart1.png' height='19' width='20'>";
        </script>
        <!--post starts-->
        <?php
        // MAKE CONNECTION
        $conn = mysqli_connect('localhost', 'root', '', 'userinfo');
        //CHECKING CONNECTION
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        //GETTING PASSWORD FROM SESSION
        $passw = $_SESSION['pass_word'];
        //CHECKING IF THE USER LOGGED IN USING USERNAME OR EMAIL
        if (isset($_SESSION['uname'])) {
          $username = $_SESSION['uname'];
          $sql2 = mysqli_query($conn, "SELECT  * from account where uname='$username'");
          $row = mysqli_fetch_array($sql2);
          $profile_pic = $row['profile_path'];
          $user = $row['uname'];
        } else {
          $mail = $_SESSION['mail'];
          $sql2 = mysqli_query($conn, "SELECT * from account where emailid='$mail'");
          $row = mysqli_fetch_array($sql2);
          $profile_pic = $row['profile_path'];
          $user = $row['uname'];
        }
        //CHECKING IF THE INPUT IS EMPTY
        if (isset($_POST['tprompt'])) {
          //INSERTING TWEETS,PASSWORD,USERNAME,PROFILE_PATH INTO DATABASE
          $prm = $_POST['tprompt'];
          $qry = mysqli_query($conn, "INSERT into tweets(twt,_pass_word,uname,profile_pic) VALUES('$prm','$passw','$user','$profile_pic')");
        } else {
          //DO NOTHING
        }
        //FUNCTION TO RETRIEVE PROFILE PHOTO OF CURRENT USER
        function profile()
        {
          $conn = mysqli_connect("localhost", "root", "", "userinfo");
          if (isset($_SESSION['uname'])) {
            $username = $_SESSION['uname'];
            $img = mysqli_query($conn, "SELECT * FROM account where uname='$username'");
          } else {
            $email = $_SESSION['mail'];
            $img = mysqli_query($conn, "SELECT * FROM account where emailid='$email'");
          }
          $row = mysqli_fetch_array($img);
          $src = "<img src='profile/" . $row['profile_path'] . "' class=" . "'form-control img-fluid'>";
          //RETURNING IMAGE TAG WITH CURRENT USER'S PROFILE IMAGE
          return $src;
        }
        //RETRIEVING ALL INFO FROM TWEETS TABLE
        $sel = mysqli_query($conn, "SELECT * from tweets");
        $num_rows = mysqli_num_rows($sel);
        $like = 0;
        //GENERATING TWEETBOXES WITH TWEET,USERNAME AND PROFILE PHOTO OF TWEETED PERSON
        for ($i = 0; $i < $num_rows; $i++) {
          $n = $num_rows;
          $row = mysqli_fetch_assoc($sel);
          $tweet = $row['twt'];
          $_SESSION['tweet'] = $tweet;
          $id = $row['id'];
          $src = "<img src='profile/" . $row['profile_pic'] . "' id='photo' >";
          $user = $row['uname'];
          echo '
          <script>
          </script>';
          echo '<div class="post" id="post">
            <div class="post__avatar" id="pic' . $id . '">'
            . $src .
            '</div>
            <div class="post__body">
              <div class="post__header">
                <div class="post__headertext">
                  <h3 id="h' . $id . '">'
            . $user . ' 
                    <span class="post__headerspecial">
                       <span class="material-symbols-outlined post__badge"
                      >verified</span
                    >
                  </span> 
                  </h3>
                </div>
                <div class="post__headerdescription">
                  <p></p>
                </div>
              </div>
              <p>' . $tweet . '</p>
              <div class="post__footer" id="post__footer' . $id . '">
                <button class="material-symbols-outlined">repeat</button>
                <form action="like.php" method="post">
                <script>if(lc<=0){
                  like.innerHTML =im2;
                   }
                   else if(lc>0){
                     like.innerHTML =im1;
                   }</script>
                <button class="material-symbols-outlined" type="submit" name="l' . $id . '"><img src="images/heart.png" height="19" width="20"></button></form>
                <button class="material-symbols-outlined" id="dl">repeat</button>
              </div>
            </div>
          </div>';
        }
        ?>
      </div>
      <!--post ends-->
      <!--widgets start-->
    </div>
  </div>
</body>

</html>