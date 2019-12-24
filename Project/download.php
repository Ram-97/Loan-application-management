<?php
include('config.php');

if(isset($_GET['dow'])){

    $path=$_GET['dow'];
    $sql="select * from policies where path='$path'";
    $res = mysqli_query($db,$sql);

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($path).'"');
    header('Content-Length:'.filesize($path));
    readfile($path);
}

?>
