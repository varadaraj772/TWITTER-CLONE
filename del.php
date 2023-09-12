<?php
$conn = mysqli_connect("localhost", "root", "", "userinfo");
$na = array_keys($_POST);
$id = substr($na[0], 2);
$sql = mysqli_query($conn, "DELETE from tweets where id='$id'");
echo '<script>
window.location.replace("showprofile.php")
</script>';
?>