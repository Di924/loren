<?php
if (isset($_POST['searchtype']) && isset($_POST['searchterm'])){
    include 'result.php';
}else{
    include 'search.inc';
}
?>