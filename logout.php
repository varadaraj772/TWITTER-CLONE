<?php
//START SESSION
session_start();
//DESTORY ALL SESSION VARIABLES
session_destroy();
//GO TO INDEX PAGE
echo '<script>
window.location.replace("index.html");
</script>'
    ?>