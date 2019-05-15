<?php
$basedir="/";
$lang = "";

if(isset($_COOKIE["pref_lang"])){
	$lang = $_COOKIE["pref_lang"];
}

if(isset($_GET["ru"])) $lang="ru";
//if(isset($_GET["fr"])) $lang="fr";

if(($lang != "ru")){// && ($lang != "fr")){
	$lang = "ru"; 
}
setcookie("pref_lang", $lang, time()+36000, "/");

if(!isset($_GET['page'])){
    $page = "about";
}else{
    $page = $_GET['page'];
}

$dict = "";
if(isset($_COOKIE["dict"])) $dict = $_COOKIE["dict"];
if($_GET["test"]){
    setcookie("test", $_GET["test"], time()+36000, "/");
}
if(isset($_GET["dict"])){
    if($_GET["dict"] == "right") $dict="right";
    if($_GET["dict"] == "back") $dict="back";
    if($_GET["dict"] == "list") $dict="list";
    if($_GET["dict"] == "stim") $dict="stim";
}
if(($dict != "right") && ($dict != "back") && ($dict != "list") && $dict != "stim"){
    $dict="right";
}
setcookie("dict", $dict, time()+36000, "/");

require_once 'include/config.php';
require_once 'include/db.php';
require_once 'include/lang_'.$lang.'.php';
require_once 'include/s_criteria_class.php';

?>
