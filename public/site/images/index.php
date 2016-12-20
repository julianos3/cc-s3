<?php
    $link = explode('/', $_SERVER[REQUEST_URI]);
    header('location: http://'.$_SERVER['SERVER_NAME'].'/'.$link[1]."/erro")
?>