<?php
include './function.php';
include './Article.class.php';
$method=isset($_GET['m'])?$_GET['m']:'index';
$obj=new Article();
$obj->$method();
?>