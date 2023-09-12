<!DOCTYPE html>

<head>
  <title>Profile</title>
  <link rel="stylesheet" href="profile_style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  $conn = mysqli_connect("localhost", "root", "", "userinfo");
  session_start();
  $passw = $_SESSION['pass_word'];
  $qry = mysqli_query($conn, "SELECT * from account where pass_word='$passw'");
  $row = mysqli_fetch_array($qry);
  if (isset($row)) {
    $img = $row['profile_path'];
    $user = $row['uname'];
  }
  ?>
  <div class="main">
    <div class="righthead">
      <h5>PROFILE</h5>
    </div>
    <div class="profile">
      <div id="uppershade">
        <div class="dp">
          <img src="profile/<?php echo $img ?>" id="photo" />
        </div>
      </div>
      <div class="name">
        <p>
          <?php echo $user ?>
        </p>
      </div>
      <div class="follow">
        <pre><b>0</b>Following  <b>0</b>Followers</pre>
      </div>
      <div class="editbtn">
        <button id="edit">Edit profile</button>
      </div>
      <script>
        var im1 = "<img src='images/heart.png' height='19' width='20'>";
        var im2 = "<img src='images/heart1.png' height='19' width='20'>";
      </script>
      <div class="tweetbox" style="overflow-y:scroll;">
        <?php

        $sel = mysqli_query($conn, "SELECT * from tweets where _pass_word='$passw'");
        $num_rows = mysqli_num_rows($sel);
        for ($i = 0; $i < $num_rows; $i++) {
          $row = mysqli_fetch_array($sel);
          $tweet = $row['twt'];
          $_SESSION['tweet'] = $tweet;
          $id = $row['id'];
          $src = "<img src='profile/" . $row['profile_pic'] . "' id='photo' >"
          ;
          $user = $row['uname'];
          echo '<div class="post" id="post">
            <div class="post__avatar" id="pic' . $id . '">' . $src . '</div>
            <div class="post__body">
              <div class="post__header">
                <div class="post__headertext">
                  <h3 id="h' . $id . '">' . $user . ' 
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
              <p id="tweeet' . $id . '">' . $tweet . '</p>
              <div class="post__footer" id="post__footer' . $id . '">
                <button class="material-symbols-outlined">repeat</button>
                <script>
                  var k = document.createElement("button");
                  k.id = "' . $id . '";
                  k.className = "material-symbols-outlined";
                  k.innerHTML = im1;
                  k.style.border = "none";
                  k.style.background = "transparent";
                  document.getElementById("post__footer' . $id . '").appendChild(k);
                </script>
                <script>
                  var lc = 0;
                  document.getElementById("' . $id . '").addEventListener("click", () => {
                    var like = document.getElementById("' . $id . '");
                    if (lc <= 0) {
                      like.innerHTML = im2;
                      lc++;
                    }
                    else if (lc > 0) {
                      like.innerHTML = im1;
                      lc--;
                    }
                  });
                </script>
                <form action="del.php" method="post" >
                <button class="material-symbols-outlined" name="dl' . $id . '" type="submit">delete</button>
                </form>
              </div>
            </div>
          </div>';

        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>